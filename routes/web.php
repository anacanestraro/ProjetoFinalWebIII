<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;

Route::get('/', [HomeController::class, 'home'])->name('home')->middleware('auth');

Route::resource('cliente', ClienteController::class)->names([
    'index'=>'cliente.index',
    'create'=>'cliente.create',
    'store'=>'cliente.store',
    'show'=>'cliente.show',
    'edit'=>'cliente.edit',
    'update'=>'cliente.update',
    'destroy'=>'cliente.destroy'
]);

Route::resource('categoria', CategoriaController::class)->parameters(['categoria' => 'categoria'])->names([
    'index'=>'categoria.index',
    'create'=>'categoria.create',
    'store'=>'categoria.store',
    'show'=>'categoria.show',
    'edit'=>'categoria.edit',
    'update'=>'categoria.update',
    'destroy'=>'categoria.destroy'
]);

Route::resource('unidade', UnidadeController::class)->parameters(['unidade' => 'unidade'])->names([
    'index'=>'unidade.index',
    'create'=>'unidade.create',
    'store'=>'unidade.store',
    'show'=>'unidade.show',
    'edit'=>'unidade.edit',
    'update'=>'unidade.update',
    'destroy'=>'unidade.destroy'
]);

Route::resource('produto', ProdutoController::class)->parameters(['produto' => 'produto'])->names([
    'index'=>'produto.index',
    'create'=>'produto.create',
    'store'=>'produto.store',
    'show'=>'produto.show',
    'edit'=>'produto.edit',
    'update'=>'produto.update',
    'destroy'=>'produto.destroy'
]);


Route::get('/socialite/google',[SocialLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback',[SocialLoginController::class, 'handleGoogleCallback'])->name('google.callback');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
