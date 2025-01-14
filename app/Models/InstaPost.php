<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstaPost extends Model
{
    use HasFactory;

    protected $table = 'instaPosts';

    protected $fillable = [
        'post_id',
        'caption',
        'like_count',
        'last_checked',
    ];

    public $timestamps = true; // gère created_at et updated_at automatiquement
}
