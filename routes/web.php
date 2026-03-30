<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/tabla', function() {
    return view('rutas_taller3.ventas');
})->name('tabla');

Route::get('/acerca', function() {
    return view('rutas_taller3.acerca');
})->name('acerca');

Route::get('/juego', function() {
    return view('rutas_taller3.juegos');
})->name('juego');

// We use the ContactoController for contact methods.
// We protect it with the 'auth' middleware provided by Laravel Breeze.
Route::middleware(['auth'])->group(function () {
    Route::resource('contactos', ContactoController::class)->names([
        'index' => 'contacto' // Rename index to match the existing 'contacto' route expectation from base.blade.php
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/* 
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});
*/


// Rutas de settings
require __DIR__.'/settings.php';
