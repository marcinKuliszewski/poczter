<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use ZipArchive;
use App\UserData;
use Illuminate\Support\Facades\Storage;



 /**
 *   System kopi zapasowej plików - dokumentów .
 */
class ZipArchiveController extends Controller
{
   public $aktualny_plik;
   
   
    /**
     * Pobiera plik zip kopi zapasowej .
     * @param 
     * 
     * access public
     * @return download backup_bw.zip
     */
    public function backup_file() {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
            $user_data=UserData::all();
            foreach ($user_data as $user)
                {
                $folder=$user->direct_patch; 
                $this->ziper($folder);
                } 
                return Storage::download('backup_bw.zip','backup_bw.zip');  
        }
          else 
        {
             return view('welcome');
        }
    }
    
    
    /**
     * Wykonuje plik zip kopi zapasowej .
     * @param string $folder
     * 
     * access public
     * @return boolen true
     */
    public function ziper($folder)
    { 
        $data=date("Ymd_His");
        $public_dir=storage_path();
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