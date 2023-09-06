<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images'; // Le nom de la table associée au modèle

    protected $fillable = [
        'titre',
        'description',
        'fichier',
        'collection_id', // Clé étrangère vers la table 'collection'
    ];

    // Définir la relation avec la table 'collection'
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

}
