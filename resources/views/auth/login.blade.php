@extends('layouts.globales.base')

@section('title', 'Iniciar Sesión')

@section('contenido')
<div class="taller2-scope" style="max-width: 500px; margin: 0 auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; margin-bottom: 20px;">Iniciar Sesión</h2>

    {{-- Muestra los mensajes de error en caso de que las credenciales sean inválidas --}}
    @if ($errors->any())
        <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- El action apunta a la ruta POST del login (/login) --}}
    <form action="{{ url('/login') }}" method="POST">
        
        {{-- Directiva Blade para incluir un input oculto llamado _token 
             que previene a tu sistema de ataques CSRF (Cross-Site Request Forgery). --}}
        @csrf

        {{-- Entrada del Correo --}}
        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">Correo Electrónico:</label>
            {{-- value="{{ old('email') }}" permite que, si recarga por error, el usuario no pierda lo que ya escribió --}}
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        {{-- Entrada de la Contraseña --}}
        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold;">Contraseña:</label>
            <input type="password" id="password" name="password" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        {{-- Boton de Enviar --}}
        <button type="submit" 
                style="width: 100%; background: #2563eb; color: white; border: none; padding: 12px; border-radius: 4px; font-size: 16px; cursor: pointer;">
            Ingresar
        </button>

    </form>
    
    <div style="margin-top: 15px; text-align: center;">
        ¿Olvidaste tu contraseña? <a href="{{ url('/recuperar-cuenta') }}" style="color: #ef4444; text-decoration: none;">Recupérala aquí</a>
    </div>

    <div style="margin-top: 10px; text-align: center;">
        ¿No tienes cuenta? <a href="{{ url('/registro') }}" style="color: #2563eb; text-decoration: none;">Regístrate aquí</a>
    </div>
</div>
@endsection
