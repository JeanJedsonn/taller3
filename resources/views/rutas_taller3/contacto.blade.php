@extends('layouts.globales.base')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/taller2/main.css') }}">
@endpush

@section('contenido')
<div class="taller2-scope" style="max-width: 800px; padding: 20px;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; margin-bottom: 20px;">
        <h2 id="form-title" style="margin: 0;">Lista de Contactos</h2>
        <a href="{{ route('contactos.create') }}" class="btn-gray" style="text-decoration: none; padding: 10px 15px; color: white; display: inline-block; border-radius: 6px; background: var(--primary); margin-top: 0;">+ Crear Contacto</a>
    </div>

    @if (session('success'))
        <div style="background: #d1fae5; border: 1px solid #10b981; color: #047857; padding: 10px; border-radius: 6px; margin-bottom: 20px; width: 100%;">
            {{ session('success') }}
        </div>
    @endif

    <div style="width: 100%; overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <thead style="background: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                <tr>
                    <th style="padding: 12px; text-align: left; color: #475569;">Cédula</th>
                    <th style="padding: 12px; text-align: left; color: #475569;">Nombre y Apellido</th>
                    <th style="padding: 12px; text-align: right; color: #475569;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contactos as $c)
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 12px;">{{ $c->cedula }}</td>
                        <td style="padding: 12px;">{{ $c->nombre }} {{ $c->apellido }}</td>
                        <td style="padding: 12px; text-align: right;">
                            
                            <!-- Botón Editar -->
                            <a href="{{ route('contactos.edit', $c->id) }}" style="text-decoration: none; background: #fbbf24; color: #78350f; padding: 6px 12px; border-radius: 4px; font-weight: bold; font-size: 0.85rem; margin-right: 5px;">Editar</a>
                            
                            <!-- Formulario Eliminar -->
                            <form action="{{ route('contactos.destroy', $c->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar el contacto: {{ $c->cedula }}?')" style="background: #ef4444; color: white; padding: 6px 12px; border: none; border-radius: 4px; font-weight: bold; font-size: 0.85rem; cursor: pointer; width: auto;">Eliminar</button>
                            </form>
                            
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
