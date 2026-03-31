@extends('layouts.globales.base')

<!-- agrega mas estilos al css base -->
@push('css')
    <link rel="stylesheet" href="{{ asset('css/taller2/main.css') }}">
@endpush

@section('contenido')
<div class="taller2-scope">
    
    <div class="contacto-header">
        <h2 id="form-title" class="contacto-title">Lista de Contactos</h2>
        <a href="{{ route('contactos.create') }}" class="btn-contacto-create">+ Crear Contacto</a>
    </div>

    @if (session('success'))
        <div class="contacto-alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="tabla-datos">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre y Apellido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contactos as $c)
                    <tr>
                        <td>{{ $c->cedula }}</td>
                        <td>{{ $c->nombre }} {{ $c->apellido }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('contactos.show', $c->id) }}" class="btn-action btn-show">Mostrar</a>
                                <a href="{{ route('contactos.edit', $c->id) }}" class="btn-action btn-edit">Editar</a>
                                <form action="{{ route('contactos.destroy', $c->id) }}" method="POST" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar el contacto: {{ $c->cedula }}?')" class="btn-action btn-delete">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="contacto-empty-table">No hay contactos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
