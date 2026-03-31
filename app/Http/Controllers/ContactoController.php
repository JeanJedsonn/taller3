<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

// Controlador del taller 2 adaptado al taller 3
class ContactoController extends Controller
{
    /**
     * Muestra todos los contactos
     */
    public function index()
    {
        $contactos = Contacto::all();
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
        Contacto::create($validated);

        return redirect()->route('contacto')->with('success', 'Contacto agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contacto = Contacto::findOrFail($id);
        return view('rutas_taller3.contacto.mostrar', compact('contacto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contacto = Contacto::findOrFail($id);
        return view('rutas_taller3.contacto.formulario', compact('contacto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contacto = Contacto::findOrFail($id);
        $validated = $this->validarContacto($request, $contacto->id);
        
        $contacto->update($validated);

        return back()->with('success', 'Contacto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->delete();

        return back()->with('success', 'Contacto eliminado.');
    }

    /**
     * Validation rules matching Taller 2 strict specs
     */
    private function validarContacto(Request $request, $id = null)
    {
        $uniqueRule = $id ? "unique:contactos,cedula,{$id}" : "unique:contactos,cedula";

        $reglas = [
            'cedula' => ['required', 'string', 'regex:/^[0-9]+$/', $uniqueRule],
            'nombre' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\']+$/u'],
            'apellido' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\']+$/u'],
            'edad' => 'required|integer|min:15|max:90',
            'genero' => 'required|in:femenino,masculino,otros',
            'numero_telefono_1' => 'required|string|regex:/^\d{4}-\d{7}$/',
            'numero_telefono_2' => 'nullable|string|regex:/^\d{4}-\d{7}$/',
            'correo_electronico_1' => 'required|email|max:255',
            'correo_electronico_2' => 'nullable|email|max:255',
            'estado_civil' => 'required|in:soltero,casado,divorciado,concubinato,viudo',
            'direccion' => 'required|string|max:500',
            'departamento' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
        ];

        $mensajes = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute no puede exceder :max caracteres.',
            'min' => 'El campo :attribute debe ser al menos :min.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'email' => 'El campo :attribute debe ser un correo válido.',
            'unique' => 'El valor de :attribute ya está en uso.',
            'in' => 'El valor seleccionado para :attribute no es válido.',
            'cedula.regex' => 'La cédula debe contener únicamente números.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'apellido.regex' => 'El apellido solo puede contener letras y espacios.',
            'numero_telefono_1.regex' => 'El teléfono principal debe tener el formato 0000-0000000.',
            'numero_telefono_2.regex' => 'El teléfono secundario debe tener el formato 0000-0000000.',
        ];

        $atributos = [
            'cedula' => 'cédula',
            'nombre' => 'nombre',
            'apellido' => 'apellido',
            'edad' => 'edad',
            'genero' => 'género',
            'numero_telefono_1' => 'teléfono principal',
            'numero_telefono_2' => 'teléfono secundario',
            'correo_electronico_1' => 'correo electrónico principal',
            'correo_electronico_2' => 'correo electrónico secundario',
            'estado_civil' => 'estado civil',
            'direccion' => 'dirección',
            'departamento' => 'departamento',
            'cargo' => 'cargo',
        ];

        return $request->validate($reglas, $mensajes, $atributos);
    }
}
