<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logi extends Model
{
     protected $fillable = [
        'user_id', 'status', 'name'
    ];
}
