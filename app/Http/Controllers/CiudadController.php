<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ciudad;
use App\Models\Bitacora;

class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciudades = Ciudad::all();
        return view('ciudad.index', compact('ciudades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ciudad.create');
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
            'descripcion' => 'nullable|string',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
        ]);

        $ciudad = Ciudad::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Creacion de Ciudad',
                'details' => 'La ciudad ' . $ciudad->nombre . ' ha sido creada',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('ciudad.index')->with('success', 'Ciudad creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ciudad = Ciudad::findOrFail($id);
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Visualizacion de Ciudad',
                'details' => 'La ciudad ' . $ciudad->nombre . ' ha sido vista',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return view('ciudad.show', compact('ciudad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ciudad = Ciudad::findOrFail($id);
        return view('ciudad.edit', compact('ciudad'));
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
            'descripcion' => 'nullable|string',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
        ]);

        $ciudad = Ciudad::findOrFail($id);
        $ciudad->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Modificacion de Ciudad',
                'details' => 'La ciudad ' . $ciudad->nombre . ' ha sido modificada',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('ciudad.index')->with('success', 'Ciudad actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ciudad = Ciudad::findOrFail($id);
        $ciudad->delete();
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Eliminacion de Ciudad',
                'details' => 'La ciudad ' . $ciudad->nombre . ' ha sido eliminada',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('ciudad.index')->with('success', 'Ciudad eliminada exitosamente.');
    }
}