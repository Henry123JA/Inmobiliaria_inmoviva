<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Bitacora;

class PropiedadController extends Controller
{
    
    public function index()
    {
        $propiedades = Propiedad::all();
        return view('propiedades.index', compact('propiedades'));
    }


    public function create()
    {
        return view('propiedades.create');
    }


    public function store(Request $request)
    {

        $nombreImagen=time(). '_' . $request->imagen->getClientOriginalName();
        //obtener ruta
        $ruta=$request->imagen->storeAs('public/imagenes/propiedades',$nombreImagen);
        $url=Storage::url($ruta);

        $Propiedad = Propiedad::create([    
        'nombre'=>$request->nombre,       
        'estado'=>$request->estado,       
        'descripcion'=>$request->descripcion,       
        'imagen'=>$url,
        
       ]);
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Creacion de Propiedad',
                'details' => 'La propiedad ' . $Propiedad->nombre . ' ha sido creada',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('propiedades.index')->with('success','Propiedad creado exitosamente');
    }
    
    public function show(int $id)
    {

        $propiedad = Propiedad::findOrFail($id);
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Visualizacion de Propiedad',
                'details' => 'La propiedad ' . $propiedad->nombre . ' ha sido vista',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return view('propiedades.show', compact('propiedad'));
    }


    public function edit(int $id)
    {
        $propiedad = Propiedad::find($id);
        return view('propiedades.edit', compact('propiedad'));
    }


    public function update(Request $request, int $id)
    {
        $request->validate([
            'nombre' => 'required', 
            'estado' => 'required',
            'descripcion' => 'required',
            'imagen'=>'image'
        ]);
        $propiedad = Propiedad::find($id);
        if($request->imagen == '')
        {
            $propiedad->nombre=$request->nombre;
            $propiedad->estado=$request->estado;    
            $propiedad->descripcion=$request->descripcion;         

            $propiedad->save();
        }else
        {
            $url=str_replace('storage','public',$propiedad->imagen);
            storage::delete($url);
            //obtener nombre de la imagen
            $nombreImagen=time(). '_' . $request->imagen->getClientOriginalName();
            //obtener ruta
            $ruta=$request->imagen->storeAs('public/imagenes/propiedades',$nombreImagen);
            $url=Storage::url($ruta);

            $propiedad->nombre=$request->nombre;
            $propiedad->estado=$request->estado;   
            $propiedad->descripcion=$request->descripcion;    

            $propiedad->imagen=$url;       
            $propiedad->save();
        }
        $propiedad=Propiedad::find($id);
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Modificacion de Propiedad',
                'details' => 'La propiedad ' . $propiedad->nombre . ' ha sido modificada',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
         return redirect()->route('propiedades.index')->with('success','Propiedad modificado exitosamente');
    }

    public function destroy(int $id)
    {
        $propiedad = Propiedad::find($id);    
        $propiedad->delete();
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Eliminacion de Propiedad',
                'details' => 'La propiedad ' . $propiedad->nombre . ' ha sido eliminada',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        $url=str_replace('storage','public',$propiedad->imagen);
        storage::delete($url);
        return redirect()->route('propiedades.index')->with('success', 'Propiedad eliminado exitosamente');
    }
}
