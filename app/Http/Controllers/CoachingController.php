<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoachingController extends Controller
{
    public function show()
    {
        return view('frontend.coach'); // Retourne la vue "resources/views/coaching/islande.blade.php"
    }
}
