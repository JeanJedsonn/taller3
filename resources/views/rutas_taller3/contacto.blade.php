@extends('layouts.globales.base')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/taller2/main.css') }}">
@endpush

@section('contenido')
<div class="taller2-scope">
    <!-- titulo -->
    <h2 id="form-title">Proyecto JSON</h2>

    <!-- input para seleccionar el archivo json -->
    <div class="section">
        <label for="input_archivo">Seleccionar personas.json</label>
        <input type="file" id="input_archivo" accept=".json">
    </div>

    <!-- input para buscar una persona por cedula -->
    <div class="section search-row">
        <input type="text" id="input_busqueda" placeholder="Cédula a buscar...">
        <button onclick="buscar()">Buscar Persona</button>
    </div>

    <!-- formulario para editar / crear -->
    @if ($errors->any())
        <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div style="background: #d1fae5; border: 1px solid #10b981; color: #047857; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <form id="dynamic-form" class="form-grid" action="{{ route('contactos.store') }}" method="POST">
        @csrf
        <!-- cedula -->
        <div class="form-group">
            <label for="input_cedula">Cedula</label>
            <input type="text" id="input_cedula" name="cedula" required>
        </div>
        
        <!-- nombre -->
        <div class="form-group">
            <label for="input_nombre">Nombre</label>
            <input type="text" id="input_nombre" name="nombre" required>
        </div>
        
        <!-- apellido -->
        <div class="form-group">
            <label for="input_apellido">Apellido</label>
            <input type="text" id="input_apellido" name="apellido" required>
        </div>
        
        <!-- se valida que la edad este entre 16 y 89-->
        <div class="form-group">
            <label for="input_edad">Edad (16-89)</label>
            <input type="number" id="input_edad" name="edad" min="15" max="90" required>
        </div>
        
        <!-- genero -->
        <div class="form-group">
            <label for="select_genero">Genero</label>
            <select id="select_genero" name="genero" required>
                <option value="femenino">Femenino</option>
                <option value="masculino">Masculino</option>
                <option value="otros">Otros</option>
            </select>
        </div>

        <!-- estado civil -->
        <div class="form-group">
            <label for="select_estado_civil">Estado Civil</label>
            <select id="select_estado_civil" name="estado_civil" required>
                <option value="soltero">Soltero</option>
                <option value="casado">Casado</option>
                <option value="divorciado">Divorciado</option>
                <option value="concubinato">Concubinato</option>
                <option value="viudo">Viudo</option>
            </select>
        </div>

        <!-- numeros de telefono -->
        <div class="form-group full-width">
            <label for="input_tel1">Numeros de Telefono</label>
            <!-- se valida que el telefono tenga el formato 0000-0000000-->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <input type="text" id="input_tel1" name="numero_telefono[]" placeholder="Telefono Principal (0000-0000000)" pattern="^\d{4}-\d{7}$" required>
                <input type="text" id="input_tel2" name="numero_telefono[]" placeholder="Telefono Secundario (0000-0000000)" pattern="^\d{4}-\d{7}$">
            </div>
        </div>

        <!-- correos electronicos -->
        <div class="form-group full-width">
            <label for="input_correo1">Correos Electronicos</label>

            <!-- permitido un correo extra -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <input type="email" id="input_correo1" name="correo_electronico[]" placeholder="Correo Principal" required>
                <input type="email" id="input_correo2" name="correo_electronico[]" placeholder="Correo Secundario">
            </div>
        </div>

        <!-- direccion -->
        <div class="form-group full-width">
            <label for="input_direccion">Direccion</label>
            <input type="text" id="input_direccion" name="direccion" required>
        </div>

        <!-- departamento -->
        <div class="form-group">
            <label for="input_departamento">Departamento</label>
            <input type="text" id="input_departamento" name="departamento" required>
        </div>

        <!-- cargo -->
        <div class="form-group">
            <label for="input_cargo">Cargo</label>
            <input type="text" id="input_cargo" name="cargo" required>
        </div>

        <!-- boton de actualizar datos -->
        <button type="submit" class="submit-btn">Actualizar Datos</button>
    </form>

    <button class="btn-gray" onclick="descargar()">Descargar JSON Final con Todos</button>
</div>
@endsection
