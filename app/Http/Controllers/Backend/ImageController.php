<?php

namespace App\Http\Controllers;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{

    public function index()
    {
        // Affiche la liste des images depuis la base de données
        $images = Image::all();
        return view('backend.images.index', compact('images'));
    }

    public function create()
    {
        // Affiche le formulaire de création d'une nouvelle image
        return view('backend.images.create');
    }

    public function store(Request $request)
    {
        // Valide et enregistre la nouvelle image dans la base de données
        // Vous devrez gérer le téléchargement de fichiers ici
        // Redirige ensuite vers la liste des images
    }

    public function edit($id)
    {
        // Affiche le formulaire d'édition d'une image existante
        $image = Image::find($id);
        return view('backend.images.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        // Valide et met à jour l'image dans la base de données
        // Redirige ensuite vers la liste des images
    }

    public function destroy($id)
    {
        // Supprime l'image de la base de données
        // Redirige ensuite vers la liste des images
    }
}
