<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Muestra la vista del formulario de registro.
     */
    public function showRegister()
    {
        // Simplemente retornamos la vista que crearemos en resources/views/auth/registro.blade.php
        return view('auth.registro');
    }

    /**
     * Procesa la solicitud de registro de un nuevo usuario.
     */
    public function register(Request $request)
    {
        // 1. Validación: Nos aseguramos de que el usuario envíe datos correctos.
        // confirmed: espera un campo llamado 'password_confirmation' para compararlo.
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 2. Creación: Insertamos el usuario en la base de datos usando el Modelo.
        // Hash::make() es súper importante para no guardar contraseñas en texto plano.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Autenticación automática: Una vez creado, hacemos "login" de inmediato para que 
        // no tenga que volver a poner sus datos de ingreso.
        Auth::login($user);

        // 4. Redirección: Lo enviamos al inicio (cuyo nombre de ruta es 'home').
        return redirect()->route('home')->with('success', '¡Registro exitoso! Bienvenido.');
    }

    /**
     * Muestra la vista del formulario de inicio de sesión (Login).
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Lógica principal para ingresar al sistema manejando la sesión.
     */
    public function login(Request $request)
    {
        // 1. Validar que vengan los datos.
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Auth::attempt() hace la magia. Busca por el 'email', si lo encuentra extrae el hash,
        // y compara la variable 'password' que es texto plano con el hash guardado usando password_verify.
        if (Auth::attempt($credentials)) {
            // 3. ¡Login exitoso! Ahora debemos regenerar la sesión por razones críticas de seguridad.
            // Esto evita un ataque conocido como "Session Fixation" (Fijación de Sesión).
            $request->session()->regenerate();

            // 4. Redirige al destino deseado. "intended" lo mandará a donde quería ir antes de ser 
            // obligado a loguearse (o al Home si fue directo al login).
            return redirect()->intended('/')->with('success', '¡Has iniciado sesión!');
        }

        // 5. Si falló el Auth::attempt, devolvemos un error avisando que los datos no concuerdan.
        // Usamos ValidationException para integrarlo naturalmente con Blade con la variable @error.
        throw ValidationException::withMessages([
            'email' => 'Las credenciales proporcionadas son incorrectas o no están registradas.',
        ]);
    }

    /**
     * Proceso para destruir la sesión (Cerrar sesión).
     */
    public function logout(Request $request)
    {
        // 1. Quitamos la autenticación de la solicitud actual.
        Auth::logout();

        // 2. Destruimos absolutamente toda la información almacenada en la memoria para esa sesión.
        $request->session()->invalidate();

        // 3. Volvemos a generar el token CSRF (Cross-Site Request Forgery) para que no 
        // puedan reusar un token viejo en próximos envíos.
        $request->session()->regenerateToken();

        // 4. Finalmente, lo devolvemos a la página pública inicial.
        return redirect('/')->with('success', 'Sesión cerrada. ¡Hasta pronto!');
    }
}
