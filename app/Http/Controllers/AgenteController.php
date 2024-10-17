<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use Illuminate\Http\Request;
use App\Models\Bitacora;

class AgenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agentes = Agente::all();
        return view('agentes.index', compact('agentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agentes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:agentes',
            'telefono' => 'required|numeric|digits_between:7,15',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',

            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'El correo debe ser una dirección válida.',
            'correo.unique' => 'El correo ya está registrado.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe ser un número.',
            'telefono.digits_between' => 'El teléfono debe tener entre 7 y 15 dígitos.',
        ]);

        $agente = Agente::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
        ]);


        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Creacion de Agente',
                'details' => 'El agente ' . $agente->nombre . ' ha sido creado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('agentes.index')->with('success', 'Agente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agente = Agente::findOrFail($id);

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Visualizacion de Agente',
                'details' => 'El agente ' . $agente->nombre . ' ha sido visto',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return view('agentes.show', compact('agente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agente = Agente::findOrFail($id);
        return view('agentes.edit', compact('agente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agente = Agente::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:agentes,correo,' . $agente->id,
            'telefono' => 'required|numeric|digits_between:7,15',
        ]);

        $agente->update([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
        ]);

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Modificacion de Agente',
                'details' => 'El agente ' . $agente->nombre . ' ha sido modificado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('agentes.index')->with('success', 'Agente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agente = Agente::findOrFail($id);
        $agente->delete();

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Eliminacion de Agente',
                'details' => 'El agente ' . $agente->nombre . ' ha sido eliminado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('agentes.index')->with('success', 'Agente eliminado exitosamente.');
    }
}
