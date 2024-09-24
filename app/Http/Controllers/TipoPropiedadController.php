<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoPropiedad;

class TipoPropiedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoPropiedades = TipoPropiedad::all();
        return view('tipo_propiedades.index', compact('tipoPropiedades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_propiedades.create');
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
            'descripcion' => 'required|string',
        ]);

        TipoPropiedad::create($request->all());

        return redirect()->route('tipo-propiedades.index')->with('success', 'Tipo de propiedad creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoPropiedad = TipoPropiedad::findOrFail($id);
        return view('tipo_propiedades.show', compact('tipoPropiedad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoPropiedad = TipoPropiedad::findOrFail($id);
        return view('tipo_propiedades.edit', compact('tipoPropiedad'));
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
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        $tipoPropiedad = TipoPropiedad::findOrFail($id);

        $tipoPropiedad->update($request->all());

        return redirect()->route('tipo-propiedades.index')->with('success', 'Tipo de propiedad actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoPropiedad = TipoPropiedad::findOrFail($id);
        $tipoPropiedad->delete();

        return redirect()->route('tipo-propiedades.index')->with('success', 'Tipo de propiedad eliminado exitosamente.');
    }
}
