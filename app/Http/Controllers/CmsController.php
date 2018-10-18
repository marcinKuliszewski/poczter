<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CMS;
use Illuminate\Support\Facades\DB;


 /**
 *   System zarządzania treścią .
 */

class CmsController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->cms=new CMS;
    }
    
    
    
     /**
     * Wyświetla liste wpisów w CMS .
     * @param 
     * 
     * access public
     * @return view edit_lista
     */
   public function lista() 
    {
       if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
           $wpisy=$this->cms::orderBy('id','desc')->paginate(25);
           return view('cms.edit_lista',compact('wpisy'));
        }
   }
   
   /**
     * Zapisuje / tworzy   wpis w CMS .
     * @param Request $request
     * 
     * access public
     * @return view edit_lista
     */
   public function post_save(Request $request) 
   {
       if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
           if($request->input('id')=='')
           {
               $this->cms::create([
              'nazwa'=>$request->input('nazwa'),
              'tresc'=>$request->input('tresc'),
              'autor'=>$request->input('autor'),
              'kategoria'=>$request->input('kategoria'),
               ]); 
           }
           else
           {
               $this->cms::where('id',$request->input('id'))->update([
              'nazwa'=>$request->input('nazwa'),
              'tresc'=>$request->input('tresc'),
              'autor'=>$request->input('autor'),
              'kategoria'=>$request->input('kategoria'),
               ]); 
           }
           return $this->lista();
        }
   }
   
   
   
   /**
     * Edycja wpisu w CMS .
     * @param int $id
     * 
     * access public
     * @return view edit_post
     */
    public function post_edit($id) 
    {
       if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
        {
           $wpis=$this->cms::where('id',$id)->first();
           return view('cms.edit_post',['wpis'=>$wpis]);
        }
     }
       
       
     /**
     * Usuwa wpis w CMS .
     * @param int $id
     * 
     * access public
     * @return viewedit_lista
     */  
       
       
    public function post_delete($id)
    {
       if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
            {
               $this->cms::where('id',$id)->delete();
               $wpisy=$this->cms::orderBy('id','desc')->paginate(25);
               return view('cms.edit_lista',compact('wpisy'));
            }
    }
       
       
    /**
     * Pobiera wpis w CMS .
     * @param int $id
     * 
     * access public
     * @return object cms
     */  
    public function wpis($id) 
    {
       return $this->cms::where('id',$id)->first();
    }
}
