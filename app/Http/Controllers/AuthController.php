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
            'security_question_1' => ['required', 'string'],
            'security_answer_1' => ['required', 'string', 'max:255'],
            'security_question_2' => ['required', 'string', 'different:security_question_1'],
            'security_answer_2' => ['required', 'string', 'max:255'],
        ]);

        // 2. Creación: Insertamos el usuario en la base de datos usando el Modelo.
        // Hash::make() es súper importante para no guardar contraseñas en texto plano.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'security_question_1' => $request->security_question_1,
            'security_answer_1' => strtolower(trim($request->security_answer_1)),
            'security_question_2' => $request->security_question_2,
            'security_answer_2' => strtolower(trim($request->security_answer_2)),
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

    /**
     * Muestra el formulario para ingresar correo de recuperación
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Valida si el correo existe y muestra las preguntas secretas
     */
    public function verifyEmailAndShowQuestions(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        // 1. Verificamos que el email exista en la BD
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'No encontramos ninguna cuenta registrada con este correo.',
            ]);
        }

        // 2. Comprobamos que el usuario configuró preguntas de seguridad
        if (empty($user->security_question_1) || empty($user->security_question_2)) {
            throw ValidationException::withMessages([
                'email' => 'Esta cuenta es antigua y no tiene preguntas de seguridad configuradas. Contacta al administrador.',
            ]);
        }

        // Si existe y tiene preguntas, le mandamos a la Vista de Responder
        return view('auth.recover-password', compact('user'));
    }

    /**
     * Procesa las respuestas secretas y actualiza la contraseña
     */
    public function resetPasswordWithAnswers(Request $request)
    {
        $reglas = [
            'email' => 'required|email|exists:users,email',
            'security_answer_1' => 'required|string',
            'security_answer_2' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ];

        $mensajes = [
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'El :attribute debe tener un formato válido.',
            'exists' => 'No existe ninguna cuenta asociada a este :attribute.',
            'string' => 'El campo :attribute debe ser texto válido.',
            'min' => 'La :attribute debe tener un mínimo de :min caracteres.',
            'confirmed' => 'La confirmación de la :attribute no coincide.',
        ];

        $atributos = [
            'email' => 'correo electrónico',
            'security_answer_1' => 'primera respuesta secreta',
            'security_answer_2' => 'segunda respuesta secreta',
            'password' => 'contraseña',
        ];

        $request->validate($reglas, $mensajes, $atributos);

        $user = User::where('email', $request->email)->first();

        // 1. Estandarizamos las respuestas (minúsculas y sin espacios al inicio/final)
        $answer1 = strtolower(trim($request->security_answer_1));
        $answer2 = strtolower(trim($request->security_answer_2));

        // 2. Comparamos estrictamente
        if ($user->security_answer_1 !== $answer1 || $user->security_answer_2 !== $answer2) {
            // Si falla, volvemos a inyectar la Vista explícitamente pero pasándole Error.
            // Asi evitamos el problema del "redirect back" en un form de 2-pasos.
            return view('auth.recover-password', compact('user'))
                   ->withErrors(['security_answer_1' => '¡Error! Una o ambas respuestas son incorrectas.']);
        }

        // 3. Todo coincide perfectamente. Machacamos la clave con un nuevo Hash.
        $user->password = Hash::make($request->password);
        $user->save();

        // 4. Redirigimos al Login triunfalmente.
        return redirect('/login')->with('success', '¡Contraseña restablecida correctamente! Ya puedes iniciar sesión con tu nueva clave.');
    }
}
