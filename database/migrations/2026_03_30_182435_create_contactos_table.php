<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('edad');
            $table->enum('genero', ['femenino', 'masculino', 'otros']);
            $table->json('numero_telefono');
            $table->json('correo_electronico');
            $table->enum('estado_civil', ['soltero', 'casado', 'divorciado', 'concubinato', 'viudo']);
            $table->string('direccion');
            $table->string('departamento');
            $table->string('cargo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactos');
    }
};
