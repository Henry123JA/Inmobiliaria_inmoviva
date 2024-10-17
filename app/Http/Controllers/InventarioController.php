<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Propiedad;
use App\Models\TipoPropiedad;
use App\Models\Agente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventario::query();
        if ($request->has('from_date') && $request->has('to_date')) {
            $fromDate = Carbon::parse($request->input('from_date'))->startOfDay();
            $toDate = Carbon::parse($request->input('to_date'))->endOfDay();

            $query->whereBetween('fecha', [$fromDate, $toDate]);
        }

        $inventarios = $query->get();

        return view('inventarios.index', compact('inventarios'));
    }


    public function create()
    {
        $propiedades = Propiedad::all();

        $tipoPropiedades = TipoPropiedad::all();
        $agentes = Agente::all();


        return view('inventarios.create', compact('propiedades', 'tipoPropiedades', 'agentes'));
    }


    public function store(Request $request)
    {

        $nombreImagen = time() . '_' . $request->imagen->getClientOriginalName();
        //obtener ruta
        $ruta = $request->imagen->storeAs('public/imagenes/inventarios', $nombreImagen);
        $url = Storage::url($ruta);

        Inventario::create([
            'propiedad_id' => $request->propiedad_id,
            'tipopropiedad_id' => $request->tipopropiedad_id,
            'agente_id' => $request->agente_id,
            'fecha' => $request->fecha,  
            //'fecha' => Carbon::now(),
            // 'tipopropiedad_id' => 'required|exists:tipoPropiedades,id',
            // 'propiedad_id' => 'required|exists:propiedades,id',

            'direccion' => $request->direccion,
            'precio' => $request->precio,
            'estado' => $request->estado,
            'superficie' => $request->superficie,
            'habitaciones' => $request->habitaciones,
            'baños' => $request->baños,
            'descripcion' => $request->descripcion,


            'imagen' => $url,

        ]);

        return redirect()->route('inventarios.index')->with('success', 'inventario creado exitosamente');
    }

    public function show(int $id)
    {

        $inventario = Inventario::with(['tipoPropiedad', 'propiedad', 'agente'])->findOrFail($id);

        // $inventario = Inventario::with(['categoria', 'marca', 'modelo'])->findOrFail($id);
        return view('inventarios.show', compact('inventario'));
    }


    public function edit(int $id)
    {

        $inventario = Inventario::find($id);
        $propiedades = Propiedad::all();
        $tipoPropiedades = TipoPropiedad::all();
        $agentes = Agente::all();
        return view('inventarios.edit', compact(
            'inventario',
            'propiedades',
            'tipoPropiedades',
            'agentes'
        ));
    }


    public function update(Request $request, int $id)
    {
        $request->validate([

            'propiedad_id' => 'required|exists:propiedades,id',
            'tipopropiedad_id' => 'required',
            'agente_id' => 'required|exists:agentes,id',
            'direccion' => 'required',
            'precio' => 'required',
            'estado' => 'required',
            'superficie' => 'required',
            'habitaciones' => 'required',
            'baños' => 'required',
            'descripcion' => 'required',

            'imagen' => 'image'
        ]);
        $inventario = Inventario::find($id);
        if ($request->imagen == '') {
            // $inventario->fecha=$request->fecha;
            $inventario->agente_id = $request->agente_id;
            $inventario->propiedad_id = $request->propiedad_id;
            $inventario->tipopropiedad_id = $request->tipopropiedad_id;

            $inventario->direccion = $request->direccion;
            $inventario->estado = $request->estado;
            $inventario->superficie = $request->superficie;
            $inventario->habitaciones = $request->habitaciones;
            $inventario->baños = $request->baños;
            $inventario->descripcion = $request->descripcion;

            $inventario->save();
        } else {
            $url = str_replace('storage', 'public', $inventario->imagen);
            storage::delete($url);
            //obtener nombre de la imagen
            $nombreImagen = time() . '_' . $request->imagen->getClientOriginalName();
            //obtener ruta
            $ruta = $request->imagen->storeAs('public/imagenes/inventario', $nombreImagen);
            $url = Storage::url($ruta);
            $inventario->agente_id = $request->agente_id;

            // $inventario->fecha=$request->fecha;
            $inventario->direccion = $request->direccion;
            $inventario->estado = $request->estado;
            $inventario->superficie = $request->superficie;
            $inventario->habitaciones = $request->habitaciones;
            $inventario->baños = $request->baños;
            $inventario->descripcion = $request->descripcion;

            $inventario->imagen = $url;
            $inventario->save();
        }
        $inventario = Inventario::find($id);

        return redirect()->route('inventarios.index')->with('success', 'Propiedad modificado exitosamente');
    }

    public function destroy(int $id)
    {
        $inventario = Inventario::find($id);
        $inventario->delete();
        $url = str_replace('storage', 'public', $inventario->imagen);
        storage::delete($url);
        return redirect()->route('inventarios.index')->with('success', 'Propiedad eliminado del inventario exitosamente');
    }

    public function pdf(int $id)
    {
 
        $inventario = Inventario::with(['tipoPropiedad', 'propiedad'])->findOrFail($id);

        return view('inventarios.pdf', compact('inventario'));
    }
}
