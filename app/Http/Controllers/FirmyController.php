<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\UserData;
use App\Firmy;

class FirmyController extends Controller
{
 
 public function __construct()
    {
        $this->middleware('auth');
        $this->firmy=new Firmy;
         $this->user=new User;
        $this->user_data=new UserData;
    }
    
    
    public function dodaj_firme($user_id) 
    {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $klient=$this->user_data::where('user_id',$user_id)->first();
         return view('admin.dodaj_firme_form',compact('klient'));
         }
          else 
        {
             return view('welcome');
        }
    }
    
    public function save_firme(Request $request) 
    {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {

       $this->firmy::create([
           'user_id'=>$request->input('user_id'),
           'name'=>$request->input('name'),
           'email'=>$request->input('email'),
           'status'=>'aktywny',
              ]);
       
        $person=$this->user::orderBy('name', 'asc') ->get();
        $firmy=$this->firmy::orderBy('name', 'asc') ->get();
        return view('admin.klienci',['person'=>$person,'firmy'=>$firmy]);
        }
          else 
        {
             return view('welcome');
        }
    }
    
    public function zawies_firme($klient)
    {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $this->firmy::where('id',$klient)->update(['status'=>'zawieszony']);
        return view('admin.superadmin',['komunikat'=>'Konto zostało zawieszone pomyślnie !']);
   }
          else 
        {
             return view('welcome');
        }
        }
    
    public function aktywuj_firme($klient)
    {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $this->firmy::where('id',$klient)->update(['status'=>'aktywny']);
        return view('admin.superadmin',['komunikat'=>'Konto zostało aktywowane pomyślnie !']);
        }
          else 
        {
             return view('welcome');
        }
    }
    
     public function usun_firme($klient)
    {
         if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $this->firmy::where('id',$klient)->update(['status'=>'usuniety']);
        return view('admin.superadmin',['komunikat'=>'Konto zostało usuniete pomyślnie !']);
        }
          else 
        {
             return view('welcome');
        }
    }
    
    public function edit_firme($klient)
    {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $data=$this->firmy::where('id',$klient)->first();
        return view('admin.edit_firme',['klient'=>$data]);
        }
          else 
        {
             return view('welcome');
        }
    }
    
     public function save_firme_edit(Request $request) 
    {
         if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
            $this->firmy::where('id',$request->input('id'))->update([
                'user_id'=>$request->input('user_id'),
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'status'=>'aktywny',
              ]);
       
        $person=$this->user::orderBy('name', 'asc') ->get();
        $firmy=$this->firmy::orderBy('name', 'asc') ->get();
        return view('admin.klienci',['person'=>$person,'firmy'=>$firmy]);
        }
          else 
        {
             return view('welcome');
        }
    }
    
}
