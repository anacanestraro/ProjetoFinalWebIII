<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;

Route::get('/', [HomeController::class, 'home'])->name('home')->middleware('auth');

Route::get('/cadastrarCliente', [ClienteController::class, 'create'])->name('cadastrarCliente')->middleware('auth');
Route::post('/cadastrarCliente', [ClienteController::class, 'store']);

Route::get('/listarCliente', [ClienteController::class, 'index'])->name('listarCliente');



Route::get('/socialite/google',[SocialLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback',[SocialLoginController::class, 'handleGoogleCallback'])->name('google.callback');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
