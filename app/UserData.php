<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $fillable = [
        'user_id','name','slug','status','typ','email','tel','adres','poczta_info','description'
    ];
}
