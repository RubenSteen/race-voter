<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\SuggestController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect::route('suggest.index');
})->name('home');

Route::group(['middleware' => ['guest']], function () {
    // Login/Logout routes
    Route::get('login/discord', [LoginController::class, 'discordLogin'])->name('login.discord');
    Route::get('login/discord/callback', [LoginController::class, 'discordCallback'])->name('login.discord.callback');
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('suggestions', [SuggestController::class, 'index'])->name('suggest.index');

    Route::get('tracks', [TrackController::class, 'index'])->name('track.index');
    Route::get('track/create', [TrackController::class, 'create'])->name('track.create');
    Route::post('track', [TrackController::class, 'store'])->name('track.store');
    Route::get('track/{track}/edit', [TrackController::class, 'edit'])->name('track.edit');
    Route::put('track/{track}', [TrackController::class, 'update'])->name('track.update');
    Route::delete('track/{track}', [TrackController::class, 'destroy'])->name('track.destroy');

    Route::get('cars', [CarController::class, 'index'])->name('car.index');
    Route::get('car/create', [CarController::class, 'create'])->name('car.create');
    Route::post('car', [CarController::class, 'store'])->name('car.store');
    Route::get('car/{car}/edit', [CarController::class, 'edit'])->name('car.edit');
    Route::put('car/{car}', [CarController::class, 'update'])->name('car.update');
    Route::delete('car/{car}', [CarController::class, 'destroy'])->name('car.destroy');

    Route::put('vote/{suggest}', [VoteController::class, 'store'])->name('vote.store');
    Route::delete('vote', [VoteController::class, 'destroy'])->name('vote.destroy');

    Route::group(['middleware' => ['user.is.admin']], function () {

    });
});
