<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InstaInteractionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(InstaInteractionController::class)->group(function () {
    // Récupérer les followers éligibles pour une interaction
    Route::get('/followers/eligible', 'getEligibleFollowers');
    // Enregistrer une interaction
    Route::post('/interactions', 'recordInteraction');
    // Obtenir les statistiques d'un follower
    Route::get('/followers/{id}/stats', 'getFollowerStats');

    Route::post('/update-likes', 'updateLikes');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
