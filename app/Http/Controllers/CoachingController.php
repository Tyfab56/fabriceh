<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoachingController extends Controller
{
    public function show()
    {
        return view('coaching.islande'); // Retourne la vue "resources/views/coaching/islande.blade.php"
    }
}
