<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\formulario;
use App\Models\Bitacora;

class formularioController extends Controller
{
    public function index()
    {
        // Obtener todos los formularios
        $formularios = formulario::all();
        return view('formulario.index', compact('formularios'));
    }

    public function create()
    {
        // Mostrar el formulario de creación
        return view('formulario.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:15',
            'mensaje' => 'required|string',
        ]);

        // Crear un nuevo registro en la tabla de formularios
        $formu = formulario::create($validatedData);

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Creacion del formulario',
                'details' => 'El formulario de ' . $formu->nombre . ' ha sido creado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        // Redireccionar con un mensaje de éxito
        return redirect()->route('formulario.index')->with('success', 'formulario creado con éxito.');
    }

    public function show($id)
    {
        // Mostrar un formulario específico
        $formulario = formulario::findOrFail($id);
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Visualizacion del formulario',
                'details' => 'El formulario de ' . $formulario->nombre . ' ha sido visto',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return view('formulario.show', compact('formulario'));
    }

    public function edit($id)
    {
        // Editar un formulario específico
        $formulario = formulario::findOrFail($id);
        return view('formulario.edit', compact('formulario'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:15',
            'mensaje' => 'required|string',
        ]);

        // Actualizar los datos del formulario
        $formulario = formulario::findOrFail($id);
        $formulario->update($validatedData);

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Modificacion de formulario',
                'details' => 'El formulario de ' . $formulario->nombre . ' ha sido modificado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        // Redireccionar con un mensaje de éxito
        return redirect()->route('formulario.index')->with('success', 'formulario actualizado con éxito.');
    }

    public function destroy($id)
    {
        // Eliminar un formulario
        $formulario = formulario::findOrFail($id);
        $formulario->delete();

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Eliminacion del formulario',
                'details' => 'El formulario de ' . $formulario->nombre . ' ha sido eliminado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('formulario.index')->with('success', 'formulario eliminado con éxito.');
    }
}
