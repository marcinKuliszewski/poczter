<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Odbiory extends Model
{
      protected $fillable = [
        'user_id','user_name', 'kod', 'status', 'name', 'data_odbioru'
    ];
      
    public function dodaj_kod($dane) {
        Odbiory::create([
            'user_id'=>$dane['user_id'],
            'user_name'=>$dane['user_name'],
            'kod'=>$dane['kod'],
            'status'=>$dane['status'],
            'name'=>$dane['name'],
            'data_odbioru'=>$dane['data_odbioru']
            
            
        ]);
    }
    
    public function dodaj_odbior($dane){
        Odbiory::where('user_id',$dane['user_id'])->update([
            'name'=>$dane['name'],
            'data_odbioru'=>$dane['data_odbioru']
        ]);
    }
}
