<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CRM extends Model
{
     protected $table = 'c_r_ms';
      protected $fillable = ['nazwa','tresc','autor','kategoria','pole_a','pole_b','pole_c'];
}
