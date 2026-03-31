@extends('layouts.globales.base')

<!-- agrega mas estilos al css base -->
@push('css')
    <link rel="stylesheet" href="{{ asset('css/taller2/main.css') }}">
@endpush

@section('contenido')
<div class="contacto-show-scope">
    <div class="contacto-show-header">
        <h2 id="form-title" class="contacto-show-title">Detalles del Contacto</h2>
        <a href="{{ route('contacto') }}" class="btn-contacto-back-alt">&laquo; Volver</a>
    </div>

    <div class="contacto-show-card">
        <div class="contacto-show-grid">
            
            <!-- Columna Izquierda -->
            <div>
                <h3 class="contacto-show-subtitle">Información Personal</h3>
                <p class="contacto-show-p"><strong>Cédula:</strong> <span class="contacto-show-span">{{ $contacto->cedula }}</span></p>
                <p class="contacto-show-p"><strong>Nombre:</strong> <span class="contacto-show-span">{{ $contacto->nombre }}</span></p>
                <p class="contacto-show-p"><strong>Apellido:</strong> <span class="contacto-show-span">{{ $contacto->apellido }}</span></p>
                <p class="contacto-show-p"><strong>Edad:</strong> <span class="contacto-show-span">{{ $contacto->edad }} años</span></p>
                <p class="contacto-show-p"><strong>Género:</strong> <span class="contacto-show-span">{{ ucfirst($contacto->genero) }}</span></p>
                <p class="contacto-show-p"><strong>Estado Civil:</strong> <span class="contacto-show-span">{{ ucfirst($contacto->estado_civil) }}</span></p>
            </div>

            <!-- Columna Derecha -->
            <div>
                <h3 class="contacto-show-subtitle">Contacto y Trabajo</h3>
                
                <p class="contacto-show-p-tel"><strong>Teléfonos:</strong></p>
                <ul class="contacto-show-ul">
                    <li>{{ $contacto->numero_telefono_1 }}</li>
                    @if($contacto->numero_telefono_2)
                        <li>{{ $contacto->numero_telefono_2 }}</li>
                    @endif
                </ul>

                <p class="contacto-show-p-tel"><strong>Correos Electrónicos:</strong></p>
                <ul class="contacto-show-ul">
                    <li>{{ $contacto->correo_electronico_1 }}</li>
                    @if($contacto->correo_electronico_2)
                        <li>{{ $contacto->correo_electronico_2 }}</li>
                    @endif
                </ul>

                <p class="contacto-show-p"><strong>Dirección:</strong> <span class="contacto-show-span">{{ $contacto->direccion }}</span></p>
                <p class="contacto-show-p"><strong>Departamento:</strong> <span class="contacto-show-span">{{ $contacto->departamento }}</span></p>
                <p class="contacto-show-p"><strong>Cargo:</strong> <span class="contacto-show-span">{{ $contacto->cargo }}</span></p>
            </div>

        </div>
        
        <div class="contacto-show-actions">
            <a href="{{ route('contactos.edit', $contacto->id) }}" class="btn-contacto-warning">Editar Contacto</a>
            <form action="{{ route('contactos.destroy', $contacto->id) }}" method="POST" style="display: inline-block;">
                <!-- token de seguridad -->
                @csrf
                
                <!-- metodo delete -->
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar este contacto?')" class="btn-contacto-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection
