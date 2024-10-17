<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Propiedad;
use App\Models\TipoPropiedad;
use App\Models\Agente;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class InventarioController extends Controller
{
    public function index()
    {
        $inventarios = Inventario::all();
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

        $inven=Inventario::create([
            'propiedad_id' => $request->propiedad_id,
            'tipopropiedad_id' => $request->tipopropiedad_id,
            'agente_id' => $request->agente_id,

            'fecha' => Carbon::now(),
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
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Vinculacion de propiedad',
                'details' => 'La propiedad ' . $inven->propiedad->nombre . ' ha sido vinculada al inventario',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
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
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Desvinculacion de propiedad',
                'details' => 'La propiedad ' . $inventario->propiedad->nombre . ' ha sido desvinculada al inventario',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('inventarios.index')->with('success', 'Propiedad eliminado del inventario exitosamente');
    }

    public function buscarPorNombre(Request $request)
    {
        $search = $request->input('search');

        // Verificar que se haya ingresado un término de búsqueda
        if (!$search) {
            return redirect()->route('inventarios.index')->with('error', 'Por favor ingresa un término de búsqueda.');
        }

        // Obtener las propiedades que coincidan con el término de búsqueda (ignorando mayúsculas/minúsculas)
        $propiedades = Propiedad::where('nombre', 'LIKE', '%' . $search . '%')->pluck('id');

        // Obtener los inventarios asociados a las propiedades encontradas
        $inventarios = Inventario::whereIn('propiedad_id', $propiedades)->get();

        // Retornar la vista con los inventarios encontrados
        return view('inventarios.index', compact('inventarios'));
    }

    public function filtrarPropiedad(Request $request)
    {
        // Inicializamos la consulta en el modelo Inventario
        $query = Inventario::query();

        // Filtrar por tipo de propiedad si se ha seleccionado uno
        if ($request->filled('buscapropiedad') && $request->buscapropiedad !== 'Todos') {
            $tipoPropiedad = TipoPropiedad::where('nombre', $request->buscapropiedad)->first();
            if ($tipoPropiedad) {
                $query->where('tipopropiedad_id', $tipoPropiedad->id);
            }
        }

        // Filtrar por superficie en el rango especificado
        if ($request->filled('buscasuperficiedesde') || $request->filled('buscasuperficiehasta')) {
            $desde = $request->input('buscasuperficiedesde', 0); // Valor mínimo en caso de no especificar
            $hasta = $request->input('buscasuperficiehasta', PHP_INT_MAX); // Valor máximo en caso de no especificar
            $query->whereBetween('superficie', [$desde, $hasta]);
        }

        // Filtrar por rango de fechas
        if ($request->filled('buscafechadesde') || $request->filled('buscafechahasta')) {
            $fechaDesde = $request->input('buscafechadesde', '1900-01-01');
            $fechaHasta = $request->input('buscafechahasta', now()->format('Y-m-d'));
            $query->whereBetween('fecha', [$fechaDesde, $fechaHasta]);
        }

        // Filtrar por estado en el modelo Inventario
        if ($request->filled('agente') && $request->agente !== 'Todos') {
            $query->where('estado', $request->agente);
        }

        // Ejecutar la consulta y obtener los resultados
        $inventarios = $query->get();

        // Retornar la vista con los inventarios filtrados
        return view('inventarios.index', compact('inventarios'));
    }
}
