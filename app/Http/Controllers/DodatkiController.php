<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserData;



    /**
     * Zbiór funkcji wolnych.
    */


class DodatkiController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->user=new User;
        $this->userdata=new UserData;
    }
    
    
     /**
     * Wysłanie wiadomości od klienta/uzytkownika.
     * @param Request $request
     * 
     * access public
     * @return view pomoc_wyslany
     */
    public function kontakt(Request $request) 
    {
      $user_data=$this->userdata::where('user_id',$request->id)->first();
      $user['do']='info@agencjainnowacji.com.pl';
      $user['temat']="Pytanie od: ".$user_data['name'];
      $user['tresc1']="Temat: ".$request->temat;
      $user['tresc2']="Treść: ".$request->tresc;
      $user['od_opis']="Wirtualne Biuro ".$user_data['name'];
      $user['od_adres']=$user_data['email'];
      $ship= new OrderController;
      $ship->ship_kontakt($user);
      return view('klient.pomoc_wyslany',['klient'=>$user_data]);
    }
    
    
    /**
     * Pobiera listę klientów i wysyła jako podpowiedz do wyszukiwarki .
     * @param 
     * 
     * access public
     * @return json $lista
     */
    public function szukaj_klienta() 
    {
        $user_data=$this->user::all();
        foreach($user_data as $user)
        {
            if($user->admin=="klient")
            {
            $lista[]=$user->name;
            }
        }
        return response()->json(['lista'=>$lista]);
        
    }
    
     /**
     * Zwraca id znalezionego klienta.
     * @param string $nazwa
     * 
     * access public
     * @return json user_id
     */
     public function szukaj_nazwa($nazwa) 
    {
        $user=$this->user::where('name',$nazwa)->first();
       $user_data=$this->userdata::where('user_id',$user->id)->first();
        //dd($user_data->user_id);
        return response()->json(['user_id'=>$user_data->user_id]);
        
    }
}
