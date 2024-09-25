<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcaRequests;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Events\MarcaViewed;
use Illuminate\Support\Facades\Gate;
use App\Models\marca;
use Illuminate\Support\Facades\Storage;
use App\Models\Bitacora;

class MarcaController extends Controller
{


    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marcs = marca::all();
        return view('marca.index', compact('marcs'));
    }


    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('marca.create');
    }

    public function Sstore(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'foto_frontal' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_trasera' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Asignar el rol de cliente
        $user->roles()->sync([Role::where('title', 'cliente')->first()->id]);

        $input = $request->all();
        
        // Guardar la foto frontal si se subió
        if ($fotoFrontal = $request->file('foto_frontal')) {
            $rutaGuardarImg = 'storage/clientes/';
            $nombreFotoFrontal = date('YmdHis') . "_frontal." . $fotoFrontal->getClientOriginalExtension();
            $fotoFrontal->move($rutaGuardarImg, $nombreFotoFrontal);
            $input['foto_frontal'] = "$nombreFotoFrontal";
        }

        // Guardar la foto trasera si se subió
        if ($fotoTrasera = $request->file('foto_trasera')) {
            $rutaGuardarImg = 'storage/clientes/';
            $nombreFotoTrasera = date('YmdHis') . "_trasera." . $fotoTrasera->getClientOriginalExtension();
            $fotoTrasera->move($rutaGuardarImg, $nombreFotoTrasera);
            $input['foto_trasera'] = "$nombreFotoTrasera";
        }

        // Crear el cliente relacionado
        Cliente::create([
            'user_id' => $user->id,
            'foto_frontal' => $input['foto_frontal'] ?? null,
            'foto_trasera' => $input['foto_trasera'] ?? null,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente');
    }

    public function store(Request $request)
    {

        $request->validate([

            'nombre' => 'required|string|min:1|max:200',
            'creacion' => 'required|string|min:1',
            'imagen' => 'required|image|mimes:jpeg,png,svg,jpg|max:1024'
        ]);
    
        $input=$request->all();
        if($imagen = $request->file('imagen'))
        {            
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $input['imagen'] = "$imagenProducto";    
            
        }
        marca::create($input);
        return redirect()->route('marca.index')->with('success','Marca creado exitosamente');
    }
    
    public function show(int $id)
    {

        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marc = marca::findOrFail($id);
        event(new MarcaViewed($marc));
        return view('marca.show', compact('marc'));
    }


    public function edit(int $id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marc = marca::find($id);
        return view('marca.edit', compact('marc'));
    }


    public function update(Request $request, int $id)
    {
        $request->validate([
            'nombre' => 'required', 'creacion' => 'required'
        ]);
        $marc = marca::findOrFail($id);
         $input = $request->all();
         if ($imagen = $request->file('imagen')) {         
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension(); 
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $input['imagen'] = "$imagenProducto";

        } else {
            unset($input['imagen']);
        }
         $marc->update($input);
         return redirect()->route('marca.index')->with('success','Marca modificado exitosamente');

    }


    public function destroy(int $id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marc = marca::find($id);
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Eliminacion de marca',
                'details' => 'La marca ' . $marc->nombre . ' ha sido eliminada',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        $marc->delete();
        return redirect()->route('marca.index')->with('success', 'Marca eliminado exitosamente');
    }
}
