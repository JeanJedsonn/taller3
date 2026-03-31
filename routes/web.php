<?php

use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;

// Rutas del taller 1
Route::get('/', function () {
    return view('taller3');
})->name('home');

Route::get('/tabla', function() {
    return view('rutas_taller3.tabla');
})->name('tabla');

Route::get('/acerca', function() {
    return view('rutas_taller3.acerca');
})->name('acerca');

Route::get('/juego', function() {
    return view('rutas_taller3.juego');
})->name('juego');

// Rutas del taller 2 adaptadas
// Resource controller sin Auth temporalmente para pruebas
Route::resource('contactos', ContactoController::class)->names([
    'index' => 'contacto'
]);
// Fin bloque resource


