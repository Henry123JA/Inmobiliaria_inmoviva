<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use Illuminate\Http\Request;

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
            'nombre' => 'required',
            'correo' => 'required|email|unique:agentes',
            'telefono' => 'required',
        ]);

        Agente::create($request->all());

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
            'nombre' => 'required',
            'correo' => 'required|email|unique:agentes,correo,' . $agente->id,
            'telefono' => 'required',
        ]);
        
        $agente->update($request->all());

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

        return redirect()->route('agentes.index')->with('success', 'Agente eliminado exitosamente.');
    }
}
