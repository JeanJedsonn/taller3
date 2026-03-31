@extends('layouts.globales.base')

@section('title', 'Registro de Usuario')

@section('contenido')
<div class="taller2-scope" style="max-width: 500px; margin: 0 auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; margin-bottom: 20px;">Registro Nuevo Usuario</h2>

    {{-- Mostrar errores si el usuario no cumple las condiciones del Controlador (e.g. contraseña corta) --}}
    @if ($errors->any())
        <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- POST a la ruta de registro --}}
    <form action="{{ url('/registro') }}" method="POST">
        
        {{-- Token de seguridad contra peticiones falsas cruzadas --}}
        @csrf

        {{-- Campo de Nombre completo --}}
        <div style="margin-bottom: 15px;">
            <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">Nombre Completo:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        {{-- Campo de Correo Electrónico --}}
        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">Correo Electrónico:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        {{-- Campo de Contraseña --}}
        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold;">Contraseña (mínimo 8 caract.):</label>
            <input type="password" id="password" name="password" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        {{-- Confirmación de Contraseña --}}
        <div style="margin-bottom: 20px;">
            {{-- Nota importante: el name "password_confirmation" es el que Laravel busca automáticamente 
                 cuando en el validador requerimos la regla 'confirmed' --}}
            <label for="password_confirmation" style="display: block; margin-bottom: 5px; font-weight: bold;">Confirmar Contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        {{-- Botón Enviar --}}
        <br>
        <div style="margin-bottom: 15px; background: #f8fafc; padding: 15px; border-radius: 6px; border: 1px solid #e2e8f0;">
            <h4 style="margin-top: 0; color: #334155; margin-bottom: 15px;">Recuperación de Contraseña</h4>

            {{-- Pregunta de Seguridad 1 --}}
            <div style="margin-bottom: 15px;">
                <label for="security_question_1" style="display: block; margin-bottom: 5px; font-weight: bold;">Pregunta de Seguridad 1:</label>
                <select id="security_question_1" name="security_question_1" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="" disabled selected>Selecciona una pregunta...</option>
                    <option value="¿Nombre de tu primera mascota?" @selected(old('security_question_1') == '¿Nombre de tu primera mascota?')>¿Nombre de tu primera mascota?</option>
                    <option value="¿Ciudad donde naciste?" @selected(old('security_question_1') == '¿Ciudad donde naciste?')>¿Ciudad donde naciste?</option>
                    <option value="¿Segundo nombre de tu madre?" @selected(old('security_question_1') == '¿Segundo nombre de tu madre?')>¿Segundo nombre de tu madre?</option>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="security_answer_1" style="display: block; margin-bottom: 5px; font-weight: bold;">Respuesta 1:</label>
                <input type="text" id="security_answer_1" name="security_answer_1" value="{{ old('security_answer_1') }}" required 
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            {{-- Pregunta de Seguridad 2 --}}
            <div style="margin-bottom: 15px;">
                <label for="security_question_2" style="display: block; margin-bottom: 5px; font-weight: bold;">Pregunta de Seguridad 2:</label>
                <select id="security_question_2" name="security_question_2" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="" disabled selected>Selecciona una pregunta diferente...</option>
                    <option value="¿Nombre de tu profesor favorito?" @selected(old('security_question_2') == '¿Nombre de tu profesor favorito?')>¿Nombre de tu profesor favorito?</option>
                    <option value="¿Cuál es tu color favorito?" @selected(old('security_question_2') == '¿Cuál es tu color favorito?')>¿Cuál es tu color favorito?</option>
                    <option value="¿Película favorita de la infancia?" @selected(old('security_question_2') == '¿Película favorita de la infancia?')>¿Película favorita de la infancia?</option>
                </select>
            </div>
            <div style="margin-bottom: 10px;">
                <label for="security_answer_2" style="display: block; margin-bottom: 5px; font-weight: bold;">Respuesta 2:</label>
                <input type="text" id="security_answer_2" name="security_answer_2" value="{{ old('security_answer_2') }}" required 
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
        </div>

        <button type="submit" 
                style="width: 100%; background: #10b981; color: white; border: none; padding: 12px; border-radius: 4px; font-size: 16px; cursor: pointer;">
            Registrarme Ahora
        </button>

    </form>
    
    <div style="margin-top: 15px; text-align: center;">
        ¿Ya tienes cuenta? <a href="{{ url('/login') }}" style="color: #2563eb; text-decoration: none;">Inicia sesión</a>
    </div>
</div>
@endsection
