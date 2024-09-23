<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\formulario;

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
        formulario::create($validatedData);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('formulario.index')->with('success', 'formulario creado con éxito.');
    }

    public function show($id)
    {
        // Mostrar un formulario específico
        $formulario = formulario::findOrFail($id);
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

        // Redireccionar con un mensaje de éxito
        return redirect()->route('formulario.index')->with('success', 'formulario actualizado con éxito.');
    }

    public function destroy($id)
    {
        // Eliminar un formulario
        $formulario = formulario::findOrFail($id);
        $formulario->delete();

        return redirect()->route('formulario.index')->with('success', 'formulario eliminado con éxito.');
    }
}
