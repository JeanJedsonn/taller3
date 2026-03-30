<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;

// Rutas del taller 1
Route::get('/', function () {
    return view('welcome');
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//require __DIR__.'/auth.php'; REMOVIDO TEMPORALMENTE PARA PRUEBAS

/*
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});
*/


// Rutas de settings
require __DIR__.'/settings.php';
