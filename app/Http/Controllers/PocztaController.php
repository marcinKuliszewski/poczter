<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserData;
use App\Documents;
use App\Odbiory;
use App\Logi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PocztaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->dokumenty=new Documents;
        $this->userdata=new UserData;
        $this->odbiory=new Odbiory;
        $this->logi=new Logi;
    }
    
    public function add_poczta_widok(Request $request, $klient) {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $user_data=$this->userdata::where('user_id',$klient)->first();
        $request->session()->put('klient_name', $user_data['name']);
        $request->session()->put('klient_id', $user_data['user_id']);
        return view('pages.upload',['klient'=>$klient]);
        }
          else 
        {
             return view('welcome');
        }
    }
    
    public function zobacz_poczta(Request $request,$klient) {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
         $this->dokumenty::where(['klient_id'=>$klient,'docum_stan'=>'dodany'])->update(['nadawca'=>$request->input('nadawca')]);
         $poczta=$this->dokumenty::where('klient_id',$klient)->get();
         $user_data=$this->userdata::where('user_id',$klient)->first();
         $request->session()->put('klient_name', $user_data['name']);  
         $request->session()->put('klient_id', $user_data['user_id']); 
         //dd($klient);
         $request->session()->put('nadawca', $request->input('nadawca'));
         return view('admin.edit_send_post',compact('poczta'));
          }
          else 
        {
             return view('welcome');
        }
    }
    public function delete_list($list)
    {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $dane_listu=$this->dokumenty::where('id',$list)->first();
        $this->dokumenty::where('id',$list)->update(['docum_stan'=>'delete']);
        $poczta=$this->dokumenty::where('klient_id',$dane_listu->klient_id)->get();
        $this->delete_file($list);
         return view('admin.edit_send_post',compact('poczta'));
         }
          else 
        {
             return view('welcome');
        }
    }
    
    public function delete_file($id_file)
    {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $dane_listu=$this->dokumenty::where('id',$id_file)->first();
        $user_data=$this->userdata::where('user_id',$dane_listu->klient_id)->first();
        $doc_patch=$user_data->direct_patch;
        $file='docum/'.$doc_patch.'/'.$dane_listu->filename;
        //dd($file);
        Storage::delete($file);
         }
          else 
        {
             return view('welcome');
        }
    }
    
      public function podglad_list($id_file)
    {
        $dane_listu=$this->dokumenty::where(['id'=>$id_file])->first();
        $user_data=$this->userdata::where('user_id',$dane_listu['klient_id'])->first();
        $doc_patch=$user_data['direct_patch'];
        $file='docum/'.$doc_patch.'/'.$dane_listu['filename'];
        if(Auth::user()->admin!='superadmin' && Auth::user()->admin!='admin')
        {
            $this->dokumenty::where(['id'=>$id_file])->update(['docum_stan'=>'pobrany']);
        }
        return Storage::download($file, $dane_listu['filename']);
        
    }
    
    public function wyslij_nowapoczta($klient_id) {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
                $poczta=$this->dokumenty::where(['klient_id'=>$klient_id,'docum_stan'=>'dodany'])->get();
                $user_data=$this->userdata::where('user_id',$klient_id)->first();
                foreach($poczta as $list)
                {
                   $do_email['listy'][]=$list->filename;
                }
                if(!empty($do_email['listy']))
                {
                    if($user_data['email']!=$user_data['poczta_info'])
                    {
                        $do_email['email']=$user_data['poczta_info'];
                        $this->send_nowapoczta_mail($do_email);
                    }
                    $do_email['email']=$user_data['email'];
                    $this->send_nowapoczta_mail($do_email);
                    $this->dokumenty::where(['klient_id'=>$klient_id,'docum_stan'=>'dodany'])->update(['docum_stan'=>'wyslany']);
                }
            return view('pages.upload',['klient'=>$klient_id]);
        }
          else 
        {
             return view('welcome');
        }
    }
    
     /*
     * Kieruje polecenie do wysłania  emaila - powiadomienie o nowej poczcie 
     */
    public function send_nowapoczta_mail($do_email)
    {
      if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
      {
      $data=date('Y-m-d');
      $user['do']=$do_email['email'];
      $user['temat']="Poczta z dnia: ".$data;
      $user['od_opis']="Wirtualne Biuro ".$data;
      $user['od_adres']='info@agencjainnowacji.com.pl';
      $user['panel']='https://biuro.agencjainnowacji.com.pl';
      $user['listy']=$do_email['listy'];
      $user['data']=$data;
      $ship= new OrderController;
      $ship->ship_nowapoczta($user);
       }
          else 
        {
             return view('welcome');
        }
    }
    
public function klient_poczta($klient,$nr_strony) 
    {
    $klient_id=0;
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
           $klient_id =$klient;
        }
        else
            {
            $klient_id=Auth::user()->id;
            }
        $poczta=$this->dokumenty::where(['klient_id'=>$klient_id])->orderBy('created_at','desc')->paginate(25);
        $logi=$this->logi::where(['user_id'=>$klient_id])->orderBy('created_at','desc')->paginate(5);
        return view('klient.klient_poczta',['poczta'=>$poczta,'logi'=>$logi,'klient_id'=>$klient_id]);
        
    }
    
   
    
    public function nowa_poczta($klient_id) {
        $i=0;
        $poczta=$this->dokumenty::where(['klient_id'=>$klient_id,'docum_stan'=>'wyslany'])->orderBy('created_at','desc')->get();
        $moja_poczta=array(); 
        foreach($poczta as $list)
        {
          
            $dat=$list->created_at;
            $moja_poczta[$i]['filename']=$list->filename;
            $moja_poczta[$i]['docum_stan']=$list->docum_stan;
            $moja_poczta[$i]['id']=$list->id;
            $moja_poczta[$i]['data']=$dat;
            $moja_poczta[$i]['nadawca']=$list->nadawca;
            $i++;
        }
        //dd($moja_poczta);
             return view('klient.nowa_poczta',['nowa_poczta'=>$moja_poczta]);
 
    }
    
    
     /*
     * Kieruje polecenie do wysłania startowego emaila 
     */
    public function kod_odbioru($klient)
    {
        $klient_id=0;
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
           $klient_id =$klient;
        }
        else
        {
            $klient_id=Auth::user()->id;
        }
        $kod=$this->odbiory::where(['user_id'=>$klient_id,'status'=>'wydany'])->first();
        if(empty($kod))
        {
            $user_data=$this->userdata::where('user_id',$klient_id)->first();
            $this->zapisz_kod($klient_id,$user_data);
            return view('klient.wydano_kod_odbioru',['klient_id'=>$klient_id]);
        }
        else
        {
           return view('klient.ponowienie_kod_odbioru',['klient_id'=>$klient_id]);
        }
       
    }
    
    public function zapisz_kod($klient_id,$user_data)
    {
            $password = str_random(6);
            $do_email['email']=$user_data->poczta_info;
            $do_email['kod']=$password;
            $this->send_kod_mail($do_email);
            $dane['user_id']=$klient_id;
            $dane['user_name']=$user_data->name;
            $dane['kod']=$password;
            $dane['status']='wydany';
            $dane['name']='';
            $dane['data_odbioru']='';
            $this->odbiory->dodaj_kod($dane);
    }

    public function ponowienie_kod_odbioru($klient_id) 
    {
        $this->odbiory::where(['user_id'=>$klient_id,'status'=>'wydany'])->update(['status'=>'ponowiony']);
        return $this->kod_odbioru($klient_id);
    }
    
    /*
     * Wysyła kod odbioru przesyłek papierowych
     */
    public function send_kod_mail($do_email)
    {
        
      $dane['do']=$do_email['email'];
      $dane['temat']="Kod odbioru poczty";
      $dane['od_opis']="Wirtualne Biuro";
      $dane['od_adres']='info@agencjainnowacji.com.pl';
      $dane['kod']=$do_email['kod'];
      $ship= new OrderController;
      $ship->ship_kod_odbioru($dane);
      
    }
    public function data_odwracacz($data)
    {
        $dat_arr=explode('-',$data);
        $new_date=$dat_arr[2].'-'.$dat_arr[1].'-'.$dat_arr[0];
        return $new_date;  
    }
    
    public function poczta_wyslana(Request $request) 
    {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        //dd($request->dzien);
        $request->flash();
        $pocz=array();
        if($request->dzien_od=='')
        {
        $od=date('Y-m-d');
        }
        else
        {
            $od=$request->dzien_od;
        }
         
        
        
        if($request->dzien_do=='')
        {
          $jeden_dzien = strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +1 day");
          $jutro=date('Y-m-d', $jeden_dzien);
        }
        else
        {
          $jeden_dzien = strtotime(date("Y-m-d", strtotime($request->dzien_do)) . " +1 day");
          $jutro=date('Y-m-d', $jeden_dzien);
        //$jutro= $request->dzien_do;
        }
          
        $poczta=$this->dokumenty::where('created_at','>=',$od)->where('created_at','<',$jutro)->get();
        foreach($poczta as $list)
        {
            $user_data=$this->userdata::where('user_id',$list['klient_id'])->first();
            $po['list']=$list;
            $po['user']=$user_data;
            $pocz[]=$po;
        }
        //dd($pocz);
        return view('admin.poczta_wyslana',['poczta'=>$pocz,'od'=>$od,'do'=>$jutro]);
         }
          else 
        {
             return view('welcome');
        }
    }
}
