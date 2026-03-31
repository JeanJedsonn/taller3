<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/personas.json');
        if (file_exists($jsonPath)) {
            $json = file_get_contents($jsonPath);
            $personas = json_decode($json, true);
            foreach ($personas as $persona) {
                \App\Models\Contacto::create([
                    'cedula' => $persona['cedula'],
                    'nombre' => $persona['nombre'],
                    'apellido' => $persona['apellido'],
                    'edad' => $persona['edad'],
                    'genero' => $persona['genero'],
                    'numero_telefono_1' => $persona['numero_telefono'][0],
                    'numero_telefono_2' => $persona['numero_telefono'][1] ?? null,
                    'correo_electronico_1' => $persona['correo_electronico'][0],
                    'correo_electronico_2' => $persona['correo_electronico'][1] ?? null,
                    'estado_civil' => $persona['estado_civil'],
                    'direccion' => $persona['direccion'],
                    'departamento' => $persona['departamento'],
                    'cargo' => $persona['cargo'],
                ]);
            }
        }
    }
}
