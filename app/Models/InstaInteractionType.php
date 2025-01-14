<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstaInteractionType extends Model
{
    use HasFactory;

    protected $primaryKey = 'interaction_type_id';
    protected $table = 'InstaInteractionTypes'; // Nom complet de la table avec le préfixe

    protected $fillable = [
        'name',
    ];

    public function interactions()
    {
        return $this->hasMany(InstaInteraction::class, 'interaction_type_id', 'interaction_type_id');
    }
}
