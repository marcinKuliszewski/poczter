<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\UserData;
use App\Odbiory;
use App\Logi;
use App\Firmy;
use App\Mail\OrderControllers;
use Illuminate\Support\Facades\Storage;


    /**
     * Odpowiada za obsłógę dashboard panelu administratora.
     */


class DashboardController extends Controller
{
    protected $user;
    protected $user_data;
     
    public function __construct()
    {
        $this->middleware('auth');
        $this->user=new User;
        $this->user_data=new UserData;
        $this->odbiory=new Odbiory;
        $this->logi=new Logi;
        $this->firmy=new Firmy;
    }
    
    /**
     * Wyświetla widok dasboard dla Administratora i superadministratora  .
     * @param 
     * 
     * access public
     * @return view dashboard
     */
    
    public function dashboard() 
    {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
             return view('admin.dashboard',['menu'=>'true']);
        }
        elseif(Auth::user()->admin=='klient')
        {
            $person_id = Auth::user()->id;
            return redirect()->route('klient_poczta',['klient'=>$person_id,'nr_strony'=>'0']);
        }
        else 
        {
             return view('welcome');
        }
    }
}
