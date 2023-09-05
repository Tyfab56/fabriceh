<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressRelease extends Model
{
    protected $fillable = ['title', 'description', 'language', 'pdf_path'];
}
