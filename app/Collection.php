<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;


    protected $table = 'collections'; // Nom de la table correspondante

    protected $fillable = [
        'collection',
        'Images', // Nom du champ de clé étrangère vers la table "images"
        'nom',
    ];

    // Définissez la relation avec le modèle "Image"
    public function images()
    {
        return $this->hasMany(Image::class, 'collection_id');
    }
}
