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
        'numero_telefono_1',
        'numero_telefono_2',
        'correo_electronico_1',
        'correo_electronico_2',
        'estado_civil',
        'direccion',
        'departamento',
        'cargo',
    ];
}
