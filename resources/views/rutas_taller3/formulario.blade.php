@extends('layouts.globales.base')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/taller2/main.css') }}">
@endpush

@section('contenido')
<div class="taller2-scope">
    <!-- titulo -->
    <h2 id="form-title">{{ isset($contacto) ? 'Editar Contacto' : 'Crear Nuevo Contacto' }}</h2>

    <!-- boton regresar -->
    <div style="width: 100%; max-width: 650px; margin-bottom: 20px;">
        <a href="{{ route('contacto') }}" class="btn-gray" style="text-decoration: none; padding: 10px 15px; color: white; display: inline-block; border-radius: 6px;">&laquo; Volver a la Lista</a>
    </div>

    <!-- formulario para editar / crear -->
    @if ($errors->any())
        <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 10px; border-radius: 6px; margin-bottom: 20px; width: 100%; max-width: 650px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div style="background: #d1fae5; border: 1px solid #10b981; color: #047857; padding: 10px; border-radius: 6px; margin-bottom: 20px; width: 100%; max-width: 650px;">
            {{ session('success') }}
        </div>
    @endif

    <form id="dynamic-form" class="form-grid" action="{{ isset($contacto) ? route('contactos.update', $contacto->id) : route('contactos.store') }}" method="POST" style="width: 100%; max-width: 650px;">
        @csrf
        @if(isset($contacto))
            @method('PUT')
        @endif
        
        <!-- cedula -->
        <div class="form-group">
            <label for="input_cedula">Cédula</label>
            <input type="text" id="input_cedula" name="cedula" value="{{ old('cedula', $contacto->cedula ?? '') }}" required>
        </div>
        
        <!-- nombre -->
        <div class="form-group">
            <label for="input_nombre">Nombre</label>
            <input type="text" id="input_nombre" name="nombre" value="{{ old('nombre', $contacto->nombre ?? '') }}" required>
        </div>
        
        <!-- apellido -->
        <div class="form-group">
            <label for="input_apellido">Apellido</label>
            <input type="text" id="input_apellido" name="apellido" value="{{ old('apellido', $contacto->apellido ?? '') }}" required>
        </div>
        
        <!-- edad -->
        <div class="form-group">
            <label for="input_edad">Edad (15-90)</label>
            <input type="number" id="input_edad" name="edad" min="15" max="90" value="{{ old('edad', $contacto->edad ?? '') }}" required>
        </div>
        
        <!-- genero -->
        <div class="form-group">
            <label for="select_genero">Género</label>
            @php $generoActual = old('genero', $contacto->genero ?? ''); @endphp
            <select id="select_genero" name="genero" required>
                <option value="femenino" {{ $generoActual == 'femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="masculino" {{ $generoActual == 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="otros" {{ $generoActual == 'otros' ? 'selected' : '' }}>Otros</option>
            </select>
        </div>

        <!-- estado civil -->
        <div class="form-group">
            <label for="select_estado_civil">Estado Civil</label>
            @php $civilActual = old('estado_civil', $contacto->estado_civil ?? ''); @endphp
            <select id="select_estado_civil" name="estado_civil" required>
                <option value="soltero" {{ $civilActual == 'soltero' ? 'selected' : '' }}>Soltero</option>
                <option value="casado" {{ $civilActual == 'casado' ? 'selected' : '' }}>Casado</option>
                <option value="divorciado" {{ $civilActual == 'divorciado' ? 'selected' : '' }}>Divorciado</option>
                <option value="concubinato" {{ $civilActual == 'concubinato' ? 'selected' : '' }}>Concubinato</option>
                <option value="viudo" {{ $civilActual == 'viudo' ? 'selected' : '' }}>Viudo</option>
            </select>
        </div>

        <!-- numeros de telefono -->
        <div class="form-group full-width">
            <label for="input_tel1">Números de Teléfono</label>
            @php 
                $tel1 = old('numero_telefono.0', $contacto->numero_telefono[0] ?? '');
                $tel2 = old('numero_telefono.1', $contacto->numero_telefono[1] ?? '');
            @endphp
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <input type="text" id="input_tel1" name="numero_telefono[]" placeholder="Principal (0000-0000000)" pattern="^\d{4}-\d{7}$" value="{{ $tel1 }}" required>
                <input type="text" id="input_tel2" name="numero_telefono[]" placeholder="Secundario (0000-0000000)" pattern="^\d{4}-\d{7}$" value="{{ $tel2 }}">
            </div>
        </div>

        <!-- correos electronicos -->
        <div class="form-group full-width">
            <label for="input_correo1">Correos Electrónicos</label>
            @php 
                $cor1 = old('correo_electronico.0', $contacto->correo_electronico[0] ?? '');
                $cor2 = old('correo_electronico.1', $contacto->correo_electronico[1] ?? '');
            @endphp
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <input type="email" id="input_correo1" name="correo_electronico[]" placeholder="Correo Principal" value="{{ $cor1 }}" required>
                <input type="email" id="input_correo2" name="correo_electronico[]" placeholder="Correo Secundario" value="{{ $cor2 }}">
            </div>
        </div>

        <!-- direccion -->
        <div class="form-group full-width">
            <label for="input_direccion">Dirección</label>
            <input type="text" id="input_direccion" name="direccion" value="{{ old('direccion', $contacto->direccion ?? '') }}" required>
        </div>

        <!-- departamento -->
        <div class="form-group">
            <label for="input_departamento">Departamento</label>
            <input type="text" id="input_departamento" name="departamento" value="{{ old('departamento', $contacto->departamento ?? '') }}" required>
        </div>

        <!-- cargo -->
        <div class="form-group">
            <label for="input_cargo">Cargo</label>
            <input type="text" id="input_cargo" name="cargo" value="{{ old('cargo', $contacto->cargo ?? '') }}" required>
        </div>

        <!-- boton de guardar -->
        <button type="submit" class="submit-btn">{{ isset($contacto) ? 'Actualizar Contacto' : 'Guardar Contacto Muevo' }}</button>
    </form>
</div>
@endsection
