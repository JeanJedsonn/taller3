<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Controlador del taller 2 adaptado al taller 3
class ContactoController extends Controller
{
    /**
     * Muestra todos los contactos
     */
    public function index()
    {
        $contactos = \App\Models\Contacto::all();
        return view('rutas_taller3.contacto.index', compact('contactos'));
    }

    /**
     * Muestra el formulario para crear un nuevo contacto
     */
    public function create()
    {
        return view('rutas_taller3.contacto.formulario');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validarContacto($request);
        \App\Models\Contacto::create($validated);

        return redirect()->route('contacto')->with('success', 'Contacto agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contacto = \App\Models\Contacto::findOrFail($id);
        return view('rutas_taller3.contacto.mostrar', compact('contacto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contacto = \App\Models\Contacto::findOrFail($id);
        return view('rutas_taller3.contacto.formulario', compact('contacto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contacto = \App\Models\Contacto::findOrFail($id);
        $validated = $this->validarContacto($request, $contacto->id);
        
        $contacto->update($validated);

        return back()->with('success', 'Contacto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contacto = \App\Models\Contacto::findOrFail($id);
        $contacto->delete();

        return back()->with('success', 'Contacto eliminado.');
    }

    /**
     * Validation rules matching Taller 2 strict specs
     */
    private function validarContacto(Request $request, $id = null)
    {
        $uniqueRule = $id ? "unique:contactos,cedula,{$id}" : "unique:contactos,cedula";

        return $request->validate([
            'cedula' => ['required', 'string', $uniqueRule],
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'edad' => 'required|integer|min:15|max:90',
            'genero' => 'required|in:femenino,masculino,otros',
            'numero_telefono' => 'required|array|max:2',
            'numero_telefono.0' => 'required|string|regex:/^\d{4}-\d{7}$/',
            'numero_telefono.1' => 'nullable|string|regex:/^\d{4}-\d{7}$/',
            'correo_electronico' => 'required|array|max:2',
            'correo_electronico.0' => 'required|email|max:255',
            'correo_electronico.1' => 'nullable|email|max:255',
            'estado_civil' => 'required|in:soltero,casado,divorciado,concubinato,viudo',
            'direccion' => 'required|string|max:500',
            'departamento' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
        ]);
    }
}
