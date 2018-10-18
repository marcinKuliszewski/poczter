<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use ZipArchive;
use App\UserData;
use Illuminate\Support\Facades\Storage;

class ZipArchiveController extends Controller
{
   public $aktualny_plik;
    public function backup_file() {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
            $user_data=UserData::all();
            foreach ($user_data as $user)
                {
                $public_dir=storage_path();
                $folder=$user->direct_patch; 
                $this->ziper($folder);
                } 
                //$url = Storage::url('backup_bw.zip'); 
               // dd($url);
                return Storage::download('backup_bw.zip','backup_bw.zip');
            
        }
          else 
        {
             return view('welcome');
        }
    }
    
    public function ziper($folder)
    { 
        $data=date("Ymd_His");
        $public_dir=storage_path();
        //dd($public_dir);
        $folder_name=$folder;
        $zip = new ZipArchive ;
            if( $zip -> open($public_dir.'/app/backup_bw.zip', ZipArchive:: CREATE) === TRUE )
               {
                $options = array( 'add_path' => 'backup_file_'.$data.'/'.$folder_name.'/' , 'remove_all_path' => TRUE ); 
                $zip -> addGlob ( $public_dir.'/app/docum/'.$folder_name.'/*.{jpg,jpeg,pdf,doc,docx}' , GLOB_BRACE , $options ); 
                $zip -> close();
                $this->aktualny_plik='backup_file_'.$data;
                return TRUE;
               } 
               else 
                {
               return FALSE;
                } 
    }
 
    
    
    
}