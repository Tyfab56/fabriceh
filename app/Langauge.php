<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Langauge extends Model
{
    protected $fillable = [
        'language_code','language_name','language_default'
    ];
}
