<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firmy extends Model
{
    protected $fillable = [
        'user_id','name','status','email'
    ];
}
