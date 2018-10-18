<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\UserData;
use App\Firmy;


    /**
     * Obsługa dodatkowych podmiotów klienta/ urzytkownika .
     */


class FirmyController extends Controller
{
 
 public function __construct()
    {
        $this->middleware('auth');
        $this->firmy=new Firmy;
        $this->user=new User;
        $this->user_data=new UserData;
    }
    
    
    
     /**
     * Dodawanie nowego podmiotu do urzytkownika/klienta.
     * @param int $user_id
     * 
     * access public
     * @return view dodaj_firme_form
     */
    
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
    
    
     /**
     * Zapisanie  podmiotu .
     * @param  Request $request
     * 
     * access public
     * @return view klienci
     */
    
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
    
    
     /**
     * Zawieszenie  podmiotu .
     * @param object $klient
     * 
     * access public
     * @return view superadmin
     */
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
    
        
     /**
     * Aktywowanie  podmiotu .
     * @param object $klient
     * 
     * access public
     * @return view superadmin
     */   
        
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
    
    
    
    /**
     * Zawieszenie  podmiotu .
     * @param object $klient
     * 
     * access public
     * @return view superadmin
     */
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
    
    
    /**
     * Edycja  podmiotu .
     * @param object $klient
     * 
     * access public
     * @return view edit_firme
     */
    
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
    
    
      /**
     * Zapis po edycji  podmiotu .
     * @param Request $request
     * 
     * access public
     * @return view klienci
     */
    
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
