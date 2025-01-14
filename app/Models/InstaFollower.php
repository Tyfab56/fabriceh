<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstaFollower extends Model
{
    use HasFactory;

    protected $primaryKey = 'follower_id';
    protected $table = 'InstaFollowers'; // Nom complet de la table avec le préfixe

    protected $fillable = [
        'instagram_id',
        'username',
        'follow_date',
    ];

    public function interactionStats()
    {
        return $this->hasOne(InstaInteractionStat::class, 'follower_id', 'follower_id');
    }

    public function interactions()
    {
        return $this->hasMany(InstaInteraction::class, 'follower_id', 'follower_id');
    }
}
