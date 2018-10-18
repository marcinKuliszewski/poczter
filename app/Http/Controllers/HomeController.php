<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Oferta;
use App\Logi;
use App\User;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CmsController;

class HomeController extends Controller
{
   
    protected $logi;
    public $sa;
  
   
    /**
     * Show the application dashboard.
     * @param  Request $request
     * 
     * access public
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $this->add_session($request);
       $person = Auth::user();
       if(!empty($person))
       {
            $ilosc_row=$person->count();
            if($person->admin =='admin' && $person->status =='aktywny')
            {
              $person->admin="admin";  
              $person_id = $person->id;
              $this->add_log($person);
              return redirect()->route('dashboard');
            }
            elseif($person->admin =='superadmin' || $ilosc_row==1)
            {
                $person_id = $person->id;
                $person->where('id',$person_id)->update(['admin'=>'superadmin']);
                $person->admin="superadmin"; 
                $this->add_log($person);
                return redirect()->route('dashboard');  
            }
            elseif($person->admin =='klient')
            {
                 $person_id = $person->id;
                 $this->add_log($person);
                 return view('layouts.klient'); 
            }
            else
            {
             $this->sa->User::where('admin','superadmin')->first();
             return view('auth.login',$this->sa);
            }
        }
        else
        {
           $this->sa=User::where('admin','superadmin')->first();
           //dd($this->sa);
           return view('auth.login',['sa'=>$this->sa]); 
        }
    }
    
    
     /**
     * Dodaj logowanie do rejestru logowań.
     ** @param  $person
     * 
     * access public
     * 
     * @return rekord w tabeli Logi
     */
    public function add_log($person) 
    {
        $logi=new Logi;
        $logi::create([
                'user_id'=>$person->id,
                'name'=>$person->name,
                'status'=>'logowanie'
                ]);
    }
    
    
     /**
     * Uruchamia treści aktywne, reklamy, banery
     * @param  Request $request
     * 
     * access public
     * @return \Illuminate\Http\Response
     */
    
    public function add_session(Request $request) 
    {
       $cms= new CmsController;
       $top_reklama=$cms->wpis(12)->tresc; 
       $request->session()->put('top_reklama', $top_reklama);
       $kod_odbioru=$cms->wpis(13)->tresc; 
       $request->session()->put('kod_odbioru', $kod_odbioru);
    }
}
