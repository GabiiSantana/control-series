<?php
namespace App\Http\Controllers;
require __DIR__.'/auth.php';
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Authenticator;
use App\Mail\SeriesCreated;
use Illuminate\Support\Facades\Route;

// Rotas públicas
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('sign');

Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');
Route::resource('/series', SeriesController::class)->except(['show']);
Route::get('/', function () {return redirect('/series');});

Route::get('/email', function () {return new SeriesCreated('Serie teste',1,10,24);});

// Rotas protegidas
Route::middleware(Authenticator::class)->group(function () {

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])
        ->name('seasons.index');

    Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])
        ->name('episodes.index');

    Route::post('/seasons/{season}/episodes', [EpisodesController::class, 'update'])
        ->name('episodes.update');
});

