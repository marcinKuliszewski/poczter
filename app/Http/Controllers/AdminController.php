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


class AdminController extends Controller
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
/*
 * wyswietla liste klientów - całą
 * 
 */
    public function klient_list() {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
           $person=User::orderBy('name', 'asc') ->get();
           $firmy=$this->firmy::orderBy('name', 'asc') ->get();
           return view('admin.klienci',['person'=>$person,'firmy'=>$firmy]);
        }
        else 
        {
             return view('welcome');
        }
    
    }
    
    /*
     * edytuje klienta napodstawie ID
     * 
     */
    public function klient_edit($user_id)
    {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $data=UserData::where('user_id',$user_id)->first();
        $w=compact('data');
        return view('admin.klient_edit',$w);
         }
        else 
        {
             return view('welcome');
        }
    }
    /*
     * Zapisuje zmiany po edycji klienta
     * 
     * 
     * 
     */
    public function klient_save(Request $request) {
         
          if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $slug=$this->sanitize($request->input('name'));
        $this->user_data::where('id',$request->input('id'))->update([
            'name'=>$request->input('name'),
            'slug'=>$slug,
            'typ'=>$request->input('typ'),
            'status'=>$request->input('status'),
            'email'=>$request->input('email'),
            'tel'=>$request->input('tel'),
            'adres'=>$request->input('adres'),
            'poczta_info'=>$request->input('poczta_info'),
            'description'=>$request->input('description')
              ]);
       
        
            $person=$this->user::all();
            $firmy=$this->firmy::orderBy('name', 'asc') ->get();
               return view('admin.klienci',['person'=>$person,'firmy'=>$firmy]);
     }
        else 
        {
             return view('welcome');
        }
               
        }
    /*
     * Dodaje użytkownika
     * - do tabeli user
     * - do tabeli user_data
     * - wysyła email startowy !!!!
     */
     public function klient_create(Request $request)
    {
      if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
         $czysty_email=$this->tasak($request->input('email'));
        $request->flash(); 
        $password = str_random(10);
        $slug=$this->sanitize($request->input('name'));
         $this->user::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
             'admin'=>'klient',
             'status'=>'aktywny',
            'password' => Hash::make($password),
        ]);
         
        $nowy=$this->user::where('email',$request->input('email'))->first();
        $this->user_data::create([
            'user_id'=>$nowy->id,
            'name'=>$request->input('name'),
            'email'=>$czysty_email,
            'poczta_info'=>$czysty_email,
             ]);
        $do_email['haslo']=$password;
        $do_email['email']=$czysty_email;
        
        $this->addfolder($slug,$nowy->id);
        $this->send_start_mail($do_email);
        $data=$this->user_data::where('user_id',$nowy->id)->first();
        return view('admin.klient_edit',compact('data'));
    }
        else 
        {
             return view('welcome');
        }
        
        
    }
    
    
    
     public function delete_user(Request $request)
    {
      if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
         $us=User::where('id',$request->user_id)->first();
    $em=$us['email'];
    //dd($em);
         $emm=$request->email;
            if($em == $emm)
            {
               User::where('email',$em)->update(['status'=>'usuniety']);
               return view('admin.superadmin',['komunikat'=>'Konto zostało usunięte pomyślnie !']);
            }
            else 
            {
               return view('admin.superadmin',['komunikat'=>'Błędne dane !']); 
            }
         }
        else 
        {
             return view('welcome');
        }
    }
    
      public function supsend_user(Request $request)
    {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
            $us=User::where('id',$request->id)->first();
       $em=$us['email'];
       //dd($em);
            $emm=$request->email;
            if($em == $emm)
            {
            User::where('email',$em)->update(['status'=>'zawieszony']);
               return view('admin.superadmin',['komunikat'=>'Konto zostało zawieszone pomyślnie !']);
            }
            else 
            {
               return view('admin.superadmin',['komunikat'=>'Błędne dane !']); 
            }
           }
        else 
        {
             return view('welcome');
        }
    }
    
       public function up_supsend(Request $request)
    {
         if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
         $us=User::where('id',$request->id)->first();
    $em=$us['email'];
    //dd($em);
         $emm=$request->email;
         if($em == $emm)
         {
         User::where('email',$em)->update(['status'=>'aktywny']);
            return view('admin.superadmin',['komunikat'=>'Konto zostało aktywowane pomyślnie !']);
         }
         else 
         {
            return view('admin.superadmin',['komunikat'=>'Błędne dane !']); 
         }
          }
        else 
        {
             return view('welcome');
        }
    
    }
    
    
     public function admin_create(Request $request)
    {
       if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $request->flash(); 
        $password = str_random(10);
        

         $this->user::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
             'admin'=>'admin',
             'status'=>'aktywny',
            'password' => Hash::make($password),
        ]);
         
         $nowy=$this->user::where('email',$request->input('email'))->first();
          $this->user_data::create([
              'user_id'=>$nowy->id,
              'name'=>$request->input('name'),
              'email'=>$request->input('email'),
               ]);
         
             $do_email['haslo']=$password;
            $do_email['email']=$request->input('email');

          
         
         $do_email['haslo']=$password;
        $do_email['email']=$request->input('email');
        

        $this->send_start_mail($do_email);
        $data=$this->user::where('email',$request->input('email'))->first();
        //return view('admin.admin_edit',compact('data'));
        return $this->admin_list();
         }
        else 
        {
             return view('welcome');
        }
         
    }
    
    
    
    
     public function admin_save(Request $request) {
         if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $slug=$this->sanitize($request->input('name'));
        $this->user_data::where('id',$request->input('id'))->update([
            'name'=>$request->input('name'),
            'slug'=>$slug,
            'typ'=>$request->input('typ'),
            'status'=>$request->input('status'),
            'email'=>$request->input('email'),
            'tel'=>$request->input('tel'),
            'adres'=>$request->input('adres'),
            'poczta_info'=>$request->input('poczta_info'),
            'description'=>$request->input('description')
              ]);
        $data=$this->user_data::where('id',$request->input('id'))->first();
        //dd($request);
        $w=compact('data');
       return view('admin.admin_edit',$w);
           }
        else 
        {
             return view('welcome');
        }
    }
    
    /*
     * Kieruje polecenie do wysłania startowego emaila 
     */
    public function send_start_mail(array $do_email)
    {
     if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
      {
      $user['do']=$do_email['email'];
      $user['temat']="Rejestracja użytkownika";
      $user['od_opis']="Wirtualne Biuro";
      $user['od_adres']='info@agencjainnowacji.com.pl';
      $user['haslo']=$do_email['haslo'];
      $ship= new OrderController;
      $ship->ship_start($user);
      }
      else 
        {
             return view('welcome');
        }
    }
    
    
    
      public function admin_list() {
          if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $person=$this->user->where('admin','admin')->get();

        return view('admin.admini',compact('person'));
        }
      else 
        {
             return view('welcome');
        }
    }
    
     public function admin_edit($user_id)
    {
         if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
 
        $data=UserData::where('user_id',$user_id)->first();
        $w=compact('data');
        return view('admin.admin_edit',$w);
        }
      else 
        {
             return view('welcome');
        }
    }
    
  
    
    /*
     * dodaje folder dla nowego uzytkownika 
     */
    
 
    public function addfolder($slug, $id) {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $directories = Storage::directories('dupa');
        //dd($directories);
        if(!in_array($slug,$directories))
        {
            $data=date('His');
            Storage::makeDirectory('docum/'.$slug.$data); 
            UserData::where('user_id',$id)->update(['direct_patch'=>$slug.$data]);
        }
        }
        else 
        {
           //dd($data);
        }
      
        
    }
    /*
     * 
     *  LISTA KODÓW ODBIORU WSZYSTKICH NIEODEBRANYCH 
     *
     */
    
    public function kody_lista() {
        
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $kody=$this->odbiory::where('status','!=','odebrane')->orderBy('id','desc')->paginate(25);
        return view('admin.kody_lista',['paka'=>$kody]);
        }
          else 
        {
          return view('welcome');
        }
        
    }
    
    /*
     * 
     *  LISTA KODÓW ODBIORU USERA   
     *
     */
    
    public function klient_odbior($klient_id) {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $kody=$this->odbiory::where('user_id',$klient_id)->orderBy('id','desc')->paginate(25);
        $nazwa=$this->user::where('id',$klient_id)->first();
        return view('admin.kody',['paka'=>$kody,'nazwa'=>$nazwa['name']]);
        }
      else 
        {
             return view('welcome');
        }
    }
    
    public function potwierdzenie_odbior($id,$klient_id) 
            {
                if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
                {
                    $data=date('Y-m-d H:i:s');
                    $this->odbiory::where('id',$id)->update(['status'=>'odebrane','name'=>Auth::user()->name,'data_odbioru'=>$data]);
                    $kody=$this->odbiory::where('user_id',$klient_id)->orderBy('id','desc')->paginate(25);
                    $nazwa=$this->user::where('id',$klient_id)->first();
                    return view('admin.kody',['paka'=>$kody,'nazwa'=>$nazwa['name']]);
                }
                else 
                {
                   return view('welcome');
                }
    }
    
    
    
    
    
    
    
    
    
    
    public function nowe_haslo($user_id) 
    {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
            $password = str_random(10); 
            $password_has=Hash::make($password);
            $this->user::where('id',$user_id)->update(['password'=>$password_has]);
            $klient=$this->user_data::where('user_id',$user_id)->first();
           
            $do_email['haslo']=$password;
            $do_email['email']=$klient->email;
             $this->send_nowe_haslo_mail($do_email);
             return view('admin.nowe_haslo');
        }
         else 
        {
             return view('welcome');
        }
    }
    
     public function send_nowe_haslo_mail(array $do_email)
    {
     if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
      {
      $user['do']=$do_email['email'];
      $user['temat']="Nowe Hasło";
      $user['od_opis']="Wirtualne Biuro";
      $user['od_adres']='info@agencjainnowacji.com.pl';
      $user['haslo']=$do_email['haslo'];
      $ship= new OrderController;
      $ship->ship_nowe_haslo($user);
      }
      else 
        {
             return view('welcome');
        }
    }
    
    
    
    
    
    
    
    
    
    public function logi_edyt() {
        if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
        $logi=$this->logi::orderBy('created_at','desc')->paginate(25);
        return view('admin.logi',['logi'=>$logi]);
        }
        else 
        {
             return view('welcome');
        }
    }
    
    /*
     *  Serjalizuje stringi np nazwe klienta na slug
     * 
     */
    
    public function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean1 = trim(str_replace($strip, "", strip_tags($string)));
        $clean2 = preg_replace('/\s+/', "-", $clean1);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean2) : $clean2 ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
    
    public function tasak($slowo)
    {
                
        return $slowo;
    }
   
    
}
