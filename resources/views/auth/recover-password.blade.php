@extends('layouts.globales.base')

@section('title', 'Responde tus preguntas')

@section('contenido')
<div class="taller2-scope" style="max-width: 500px; margin: 0 auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; margin-bottom: 20px;">Seguridad de la Cuenta</h2>

    @if ($errors->any())
        <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/restablecer-password') }}" method="POST">
        @csrf
        
        {{-- Enviar email oculto para saber a quién estamos restableciendo la constraseña --}}
        <input type="hidden" name="email" value="{{ $user->email }}">

        {{-- Mostrar las preguntas exactas que el usuario eligió --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Pregunta 1: {{ $user->security_question_1 }}</label>
            <input type="text" name="security_answer_1" required placeholder="Tu respuesta secreta 1"
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Pregunta 2: {{ $user->security_question_2 }}</label>
            <input type="text" name="security_answer_2" required placeholder="Tu respuesta secreta 2"
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <hr style="margin: 20px 0; border: 0; border-top: 1px solid #e2e8f0;">

        {{-- Nueva Contraseña --}}
        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold;">Nueva Contraseña:</label>
            <input type="password" id="password" name="password" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="password_confirmation" style="display: block; margin-bottom: 5px; font-weight: bold;">Confirmar Nueva Contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <button type="submit" 
                style="width: 100%; background: #10b981; color: white; border: none; padding: 12px; border-radius: 4px; font-size: 16px; cursor: pointer;">
            Cambiar Contraseña
        </button>

    </form>
</div>
@endsection
