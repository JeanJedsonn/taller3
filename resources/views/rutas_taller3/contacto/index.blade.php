@extends('layouts.globales.base')

<!-- agrega mas estilos al css base -->
@push('css')
    <link rel="stylesheet" href="{{ asset('css/taller2/main.css') }}">
@endpush

@section('contenido')
<div class="taller2-scope">
    
    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; margin-bottom: 20px;">
        <h2 id="form-title" style="margin: 0;">Lista de Contactos</h2>
        <a href="{{ route('contactos.create') }}" class="btn-gray" style="text-decoration: none; padding: 10px 15px; color: white; display: inline-block; border-radius: 6px; background: var(--primary); margin-top: 0;">+ Crear Contacto</a>
    </div>

    @if (session('success'))
        <div style="background: #d1fae5; border: 1px solid #10b981; color: #047857; padding: 10px; border-radius: 6px; margin-bottom: 20px; width: 100%;">
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
                        <td colspan="3" style="padding: 15px; text-align: center; color: #64748b;">No hay contactos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
