<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'taller3')->name('home');
Route::view('acerca','rutas_taller3.acerca')->name('acerca');
Route::view('tabla','rutas_taller3.tabla')->name('tabla');
Route::view('juego','rutas_taller3.juego')->name('juego');

Route::view('contacto','rutas_taller3.contacto')->name('contacto');

/* 
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});
*/


// Rutas de settings
require __DIR__.'/settings.php';
