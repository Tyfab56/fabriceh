<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstaInteraction extends Model
{
    use HasFactory;

    protected $primaryKey = 'interaction_id';
    protected $table = 'InstaInteractions'; // Nom complet de la table avec le préfixe

    protected $fillable = [
        'follower_id',
        'post_id',
        'interaction_type_id',
        'interaction_direction',
        'interaction_date',
        'comment_text',
    ];

    public function follower()
    {
        return $this->belongsTo(InstaFollower::class, 'follower_id', 'follower_id');
    }

    public function post()
    {
        return $this->belongsTo(InstaPost::class, 'post_id', 'post_id');
    }

    public function interactionType()
    {
        return $this->belongsTo(InstaInteractionType::class, 'interaction_type_id', 'interaction_type_id');
    }
}
