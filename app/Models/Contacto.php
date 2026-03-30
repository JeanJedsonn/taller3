<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = [
        'cedula',
        'nombre',
        'apellido',
        'edad',
        'genero',
        'numero_telefono',
        'correo_electronico',
        'estado_civil',
        'direccion',
        'departamento',
        'cargo',
    ];

    protected $casts = [
        'numero_telefono' => 'array',
        'correo_electronico' => 'array',
    ];
}
