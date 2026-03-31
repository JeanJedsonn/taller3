@extends('layouts.globales.base')

@section('title', 'Recuperar Contraseña')

@section('contenido')
<div class="taller2-scope" style="max-width: 500px; margin: 0 auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; margin-bottom: 20px;">Recuperar Contraseña</h2>
    
    <p style="text-align: center; margin-bottom: 20px; color: #475569;">
        Ingresa el correo electrónico asociado a tu cuenta para buscar tus preguntas de seguridad.
    </p>

    @if ($errors->any())
        <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/recuperar-cuenta') }}" method="POST">
        @csrf

        <div style="margin-bottom: 20px;">
            <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">Correo Electrónico:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <button type="submit" 
                style="width: 100%; background: #3b82f6; color: white; border: none; padding: 12px; border-radius: 4px; font-size: 16px; cursor: pointer;">
            Continuar
        </button>
    </form>
    
    <div style="margin-top: 15px; text-align: center;">
        <a href="{{ url('/login') }}" style="color: #64748b; text-decoration: none;">&laquo; Volver al Login</a>
    </div>
</div>
@endsection
