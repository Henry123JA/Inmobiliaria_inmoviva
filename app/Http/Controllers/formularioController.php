<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\formulario;
use App\Models\TipoPropiedad;

class formularioController extends Controller
{
    public function index()
    {
       // Obtener todos los formularios con su tipo de propiedad
    $formularios = Formulario::with('tipoPropiedad')->get();
    return view('formulario.index', compact('formularios'));
    }

    public function create()
    {
         // Obtener los tipos de propiedad
    $tiposDePropiedad = TipoPropiedad::all();
    
    // Mostrar la vista de creación con los tipos de propiedad
    return view('formulario.create', compact('tiposDePropiedad'));
    }

        public function store(Request $request)
        {
            // Validar los datos del formulario
            $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:15',
            'mensaje' => 'required|string',
            'tipo_de_propiedad_id' => 'required|exists:tipo_propiedads,id', // Validar que exista el tipo de propiedad
        ]);
 // Crear un nuevo registro en la tabla de formularios
 $formulario = formulario::create(array_merge($validatedData, [
    'fecha_envio' => now(), // Agregar la fecha de envío
        ]));
            // Redireccionar con un mensaje de éxito
            return redirect()->route('formulario.index')->with('success', 'formulario creado con éxito.');
        }

    public function show($id)
    {
         // Obtener el formulario con su tipo de propiedad
        $formulario = Formulario::with('tipoPropiedad')->findOrFail($id);
        return view('formulario.show', compact('formulario'));
    }

    public function edit($id)
    {
         // Obtener el formulario específico
    $formulario = formulario::findOrFail($id);

    // Obtener todos los tipos de propiedad
    $tiposDePropiedad = TipoPropiedad::all();

    // Mostrar la vista de edición
    return view('formulario.edit', compact('formulario', 'tiposDePropiedad'));
    }

    public function update(Request $request, $id)
    {
            // Validar los datos
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'correo' => 'required|email|max:255',
                'telefono' => 'required|string|max:15',
                'mensaje' => 'required|string',
                'tipo_de_propiedad_id' => 'required|exists:tipo_propiedads,id', // Asegúrate de validar este campo
            ]);
        
            // Actualizar los datos del formulario
            $formulario = formulario::findOrFail($id);
            $formulario->update($validatedData); // Asegúrate de que aquí también se incluya el tipo de propiedad
        
            // Redireccionar con un mensaje de éxito
            return redirect()->route('formulario.index')->with('success', 'Formulario actualizado con éxito.');
        }
        

    public function destroy($id)
    {
        // Eliminar un formulario
        $formulario = formulario::findOrFail($id);
        $formulario->delete();

        return redirect()->route('formulario.index')->with('success', 'formulario eliminado con éxito.');
    }
}
