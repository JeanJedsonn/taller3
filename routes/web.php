<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;


// ==========================================
// RUTAS DE AUTENTICACIÓN (Práctica Manual)
// ==========================================

// 1. Grupo 'guest' (Invitados):
// Si el usuario ya inició sesión, será redirigido al home "/" automáticamente 
// para que no vea de nuevo Login o Registro. (Ver app/Http/Middleware/RedirectIfAuthenticated.php)
Route::middleware('guest')->group(function () {
    Route::get('/registro', [AuthController::class, 'showRegister'])->name('registro.show');
    Route::post('/registro', [AuthController::class, 'register'])->name('registro');
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
    // POST /login se encarga de procesar el inicio de sesión
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // Recuperación de Contraseña Manual
    Route::get('/recuperar-cuenta', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
    Route::post('/recuperar-cuenta', [AuthController::class, 'verifyEmailAndShowQuestions']);
    Route::post('/restablecer-password', [AuthController::class, 'resetPasswordWithAnswers']);
});

// 2. Grupo 'auth' (Autenticados):
// Rutas donde DEBES haber iniciado sesión para poder entrar.
Route::middleware('auth')->group(function () {
    // === Rutas Principales del Taller (Protegidas) ===
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

    Route::resource('contactos', ContactoController::class)->names([
        'index' => 'contacto'
    ]);
    // ===============================================

    // Nota: El botón para cerrar sesión en la vista suele ser un <form method="POST">
    // para estar protegidos con @csrf y evitar que un link te cierre la sesión accidentalmente.
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
