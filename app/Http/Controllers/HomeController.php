<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Oferta;
use App\Logi;
use App\User;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CrmController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $logi;
    public $sa;
    
    public function __construct()
    {
      
    }
    
    
    public function add_session(Request $request) {
        $crm= new CrmController;
       $top_reklama=$crm->wpis(12)->tresc; 
       $request->session()->put('top_reklama', $top_reklama);
       
       $kod_odbioru=$crm->wpis(13)->tresc; 
       $request->session()->put('kod_odbioru', $kod_odbioru);
    }
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->add_session($request);
       $person = Auth::user();
       if(!empty($person))
       {
            $ilosc_row=$person->count();
            //dd($person->admin);
            if($person->admin =='admin' && $person->status =='aktywny')
            {
              $person->admin="admin";  
              $person_id = $person->id;
              $this->add_log($person);
              //return view('admin.superadmin',['person'=>$person,'komunikat'=>'Logowanie udane']);
              //$a= new AdminController ;
              //return $a ->klient_list();
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
    
    public function add_log($person) {
        //dd($person);
        $logi=new Logi;
        
        $logi::create([
            'user_id'=>$person->id,
            'name'=>$person->name,
            'status'=>'logowanie'
            ]);
    }
}
