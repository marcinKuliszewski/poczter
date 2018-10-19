<?php 
namespace App\Http\Controllers;
//use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;

class OrderController extends Controller 
{ 
    /*
     * wysyła emaile startow z hasłem do panelu klienta
     * 
     */
    public function ship_start($user) 
            {        
           Mail::send('emails.start', ['login'=>$user['do'],'haslo' => $user['haslo']],
                  function ($m) use ($user) { $m->from($user['od_adres'], $user['od_opis']);
                  $m->to($user['do'])->subject($user['temat']); });

            } 
            
     /*
     * wysyła emaile - powiadomienia o nowej poczcie
     * 
     */
    public function ship_nowapoczta($user) 
            {        
           Mail::send('emails.nowapoczta', ['login'=>$user['do'],'panel' => $user['panel'],'listy' => $user['listy'],'data' => $user['data']],
                  function ($m) use ($user) { $m->from($user['od_adres'], $user['od_opis']);
                  $m->to($user['do'])->subject($user['temat']); });

            } 
    /*
     * wysyła emaile - powiadomienia o nowej poczcie
     * 
     */
    public function ship_kod_odbioru($dane) 
            {        
           Mail::send('emails.kod_odbioru', ['login'=>$dane['do'],'kod' => $dane['kod']],
                  function ($m) use ($dane) { $m->from($dane['od_adres'], $dane['od_opis']);
                  $m->to($dane['do'])->subject($dane['temat']); });

            } 
     
            
     /*
     * wysyła emaile - zapytanie klienta (z panelu)
     * 
     */
     public function ship_kontakt($user) 
            {        
            Mail::send('emails.kontakt', ['tresc1'=>$user['tresc1'],'tresc2'=>$user['tresc2'],'od'=>$user['od_adres']],
                  function ($m) use ($user) { $m->from($user['od_adres'], $user['od_opis']);
                  $m->to($user['do'])->subject($user['temat']); });

            }  
         
            
     /*
     * wysyła emaile - nowe hasło dla klienta
     * 
     */       
     public function ship_nowe_haslo($user) 
            {        
            Mail::send('emails.nowe_haslo', ['login'=>$user['do'],'haslo' => $user['haslo']],
                  function ($m) use ($user) { $m->from($user['od_adres'], $user['od_opis']);
                  $m->to($user['do'])->subject($user['temat']); });

            } 
  }