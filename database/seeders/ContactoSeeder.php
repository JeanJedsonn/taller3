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
        $jsonPath = base_path('_requisitos/taller2/proyectoMasSimple/personas.json');
        if (file_exists($jsonPath)) {
            $json = file_get_contents($jsonPath);
            $personas = json_decode($json, true);
            foreach ($personas as $persona) {
                \App\Models\Contacto::create($persona);
            }
        }
    }
}
