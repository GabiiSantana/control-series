<?php

use App\Http\Controllers\Api\EpisodesController;
use App\Http\Controllers\Api\SeasonsController;
use App\Http\Controllers\Api\SeriesController;
use App\Models\Episode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request){return $request->user();});

Route::middleware('auth:sanctum')->group(function () {
    Route::name('api.')->apiResource('/series', SeriesController::class);
    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('api.seasons.index'); 
    Route::get('/series/{series}/episodes', [EpisodesController::class, 'index'])->name('api.episodes.index');
    Route::patch('/episodes/{episode}', function (Episode $episode, Request $request) {
        $episode->watched = $request->watched;
        $episode->save();
        return $episode;
    });
});

// Request-> informações que vem do cliente.
Route::post('/login', function (Request $request) {
    $credentials = $request->only(['email', 'password']);

    if (Auth::attempt($credentials) === false){
        return response()->json('Unauthorized', 401);
    }
    $user = Auth::User();
    $user->tokens()->delete(); // para deletar tokens anteriores
    $token = $user->createToken('token', ['is_admin']);

    return response()->json($token->plainTextToken);
});