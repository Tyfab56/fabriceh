<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Languagekeyword extends Model
{
    protected $fillable = [
        'language_code','language_keywords','language_text','created_at','updated_at'
    ];
}
