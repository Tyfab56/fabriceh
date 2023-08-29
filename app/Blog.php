<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id','title','description','image', 'name', 'email', 'seo_keywords', 'seo_desc'
    ];
}
