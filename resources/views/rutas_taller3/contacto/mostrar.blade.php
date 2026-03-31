@extends('layouts.globales.base')

<!-- agrega mas estilos al css base -->
@push('css')
    <link rel="stylesheet" href="{{ asset('css/taller2/main.css') }}">
@endpush

@section('contenido')
<div class="taller2-scope" style="max-width: 800px; padding: 20px; font-family: sans-serif;">
    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; margin-bottom: 20px;">
        <h2 id="form-title" style="margin: 0; color: #1e293b;">Detalles del Contacto</h2>
        <a href="{{ route('contacto') }}" class="btn-gray" style="text-decoration: none; padding: 10px 15px; color: white; display: inline-block; border-radius: 6px; background: #64748b; margin-top: 0;">&laquo; Volver</a>
    </div>

    <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 25px; border: 1px solid #e2e8f0;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            
            <!-- Columna Izquierda -->
            <div>
                <h3 style="color: #334155; margin-top: 0; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px;">Información Personal</h3>
                <p style="margin: 10px 0;"><strong>Cédula:</strong> <span style="color: #475569;">{{ $contacto->cedula }}</span></p>
                <p style="margin: 10px 0;"><strong>Nombre:</strong> <span style="color: #475569;">{{ $contacto->nombre }}</span></p>
                <p style="margin: 10px 0;"><strong>Apellido:</strong> <span style="color: #475569;">{{ $contacto->apellido }}</span></p>
                <p style="margin: 10px 0;"><strong>Edad:</strong> <span style="color: #475569;">{{ $contacto->edad }} años</span></p>
                <p style="margin: 10px 0;"><strong>Género:</strong> <span style="color: #475569;">{{ ucfirst($contacto->genero) }}</span></p>
                <p style="margin: 10px 0;"><strong>Estado Civil:</strong> <span style="color: #475569;">{{ ucfirst($contacto->estado_civil) }}</span></p>
            </div>

            <!-- Columna Derecha -->
            <div>
                <h3 style="color: #334155; margin-top: 0; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px;">Contacto y Trabajo</h3>
                
                <p style="margin: 10px 0 5px 0;"><strong>Teléfonos:</strong></p>
                <ul style="color: #475569; margin: 0 0 10px 0; padding-left: 20px;">
                    @foreach($contacto->numero_telefono as $tel)
                        @if(!empty($tel))
                            <li>{{ $tel }}</li>
                        @endif
                    @endforeach
                </ul>

                <p style="margin: 10px 0 5px 0;"><strong>Correos Electrónicos:</strong></p>
                <ul style="color: #475569; margin: 0 0 10px 0; padding-left: 20px;">
                    @foreach($contacto->correo_electronico as $correo)
                        @if(!empty($correo))
                            <li>{{ $correo }}</li>
                        @endif
                    @endforeach
                </ul>

                <p style="margin: 10px 0;"><strong>Dirección:</strong> <span style="color: #475569;">{{ $contacto->direccion }}</span></p>
                <p style="margin: 10px 0;"><strong>Departamento:</strong> <span style="color: #475569;">{{ $contacto->departamento }}</span></p>
                <p style="margin: 10px 0;"><strong>Cargo:</strong> <span style="color: #475569;">{{ $contacto->cargo }}</span></p>
            </div>

        </div>
        
        <div style="margin-top: 30px; border-top: 1px solid #e2e8f0; padding-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
            <a href="{{ route('contactos.edit', $contacto->id) }}" style="text-decoration: none; background: #fbbf24; color: #78350f; padding: 10px 20px; border-radius: 6px; font-weight: bold; display: inline-block;">Editar Contacto</a>
            <form action="{{ route('contactos.destroy', $contacto->id) }}" method="POST" style="display: inline-block;">
                <!-- token de seguridad -->
                @csrf
                
                <!-- metodo delete -->
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar este contacto?')" style="background: #ef4444; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection
