<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CRM;
use Illuminate\Support\Facades\DB;

class CrmController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->crm=new CRM;
    }
    
   public function lista() {
       if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
           $wpisy=$this->crm::orderBy('id','desc')->paginate(25);
           return view('crm.edit_lista',compact('wpisy'));
        }
   }
   
   public function post_save(Request $request) {
       if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
           if($request->input('id')=='')
           {
             
               $this->crm::create([
              'nazwa'=>$request->input('nazwa'),
              'tresc'=>$request->input('tresc'),
              'autor'=>$request->input('autor'),
              'kategoria'=>$request->input('kategoria'),
               ]); 
           }
           else
           {
               $this->crm::where('id',$request->input('id'))->update([
              'nazwa'=>$request->input('nazwa'),
              'tresc'=>$request->input('tresc'),
              'autor'=>$request->input('autor'),
              'kategoria'=>$request->input('kategoria'),
               ]); 
           }
           return $this->lista();
           
        }
   }
   
    public function post_edit($id) {
       if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
           $wpis=$this->crm::where('id',$id)->first();
           return view('crm.edit_post',['wpis'=>$wpis]);
        }
       }
       
    public function post_delete($id) {
       if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
            {
               $this->crm::where('id',$id)->delete();
               $wpisy=$this->crm::orderBy('id','desc')->paginate(25);
               return view('crm.edit_lista',compact('wpisy'));
            }
       }
       
       public function wpis($id) {
           return $this->crm::where('id',$id)->first();
       }
}
