<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoPropiedad;
use App\Models\Bitacora;

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

        $tpropiedad = TipoPropiedad::create($request->all());

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Creacion de Tipo de Propiedad',
                'details' => 'El tipo de propiedad ' . $tpropiedad->nombre . ' ha sido creado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
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
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Visualizacion del tipo de propiedad',
                'details' => 'El tipo de propiedad ' . $tipoPropiedad->nombre . ' ha sido visto',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
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

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Modificacion del tipo de propiedad',
                'details' => 'El tipo de propiedad ' . $tipoPropiedad->nombre . ' ha sido modificado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
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

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Eliminacion del tipo de propiedad',
                'details' => 'El tipo de propiedad ' . $tipoPropiedad->nombre . ' ha sido eliminado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('tipo-propiedades.index')->with('success', 'Tipo de propiedad eliminado exitosamente.');
    }
}
