<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Role;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ClientesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientes = Cliente::with('user')->get();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('clientes.create');
    }

    public function store(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
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
        $user->roles()->sync([Role::where('title', 'cliente')->pluck('id')->first()]);

        // Definir la carpeta de destino en public/clientes_fotos
        $rutaGuardarImg = public_path('clientes_fotos/');
        
        // Guardar las fotos si se subieron
        if ($request->hasFile('foto_frontal')) {
            $fotoFrontal = date('YmdHis') . '_frontal.' . $request->file('foto_frontal')->getClientOriginalExtension();
            $request->file('foto_frontal')->move($rutaGuardarImg, $fotoFrontal);
        } else {
            $fotoFrontal = null;
        }

        if ($request->hasFile('foto_trasera')) {
            $fotoTrasera = date('YmdHis') . '_trasera.' . $request->file('foto_trasera')->getClientOriginalExtension();
            $request->file('foto_trasera')->move($rutaGuardarImg, $fotoTrasera);
        } else {
            $fotoTrasera = null;
        }

        // Crear el cliente relacionado
        Cliente::create([
            'user_id' => $user->id,
            'foto_frontal' => $fotoFrontal,
            'foto_trasera' => $fotoTrasera,
        ]);

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Creacion de perfil',
                'details' => 'El perfil del usuario ' . $user->name . ' ha sido creado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente');
    }


    
  


    public function show(Cliente $cliente)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Visualización de perfil',
                'details' => 'El perfil del usuario ' . $cliente->user->name . ' ha sido visualizado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        // Validar la entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $cliente->user->id,
            'password' => 'nullable|min:8',
            'foto_frontal' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_trasera' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Actualizar el usuario
        $cliente->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $cliente->user->password,
        ]);

        // Definir la carpeta de destino en public/clientes_fotos
        $rutaGuardarImg = public_path('clientes_fotos/');

        // Actualizar las fotos si se proporcionan nuevas
        if ($request->hasFile('foto_frontal')) {
            $fotoFrontal = date('YmdHis') . '_frontal.' . $request->file('foto_frontal')->getClientOriginalExtension();
            $request->file('foto_frontal')->move($rutaGuardarImg, $fotoFrontal);
            $cliente->foto_frontal = $fotoFrontal;
        }

        if ($request->hasFile('foto_trasera')) {
            $fotoTrasera = date('YmdHis') . '_trasera.' . $request->file('foto_trasera')->getClientOriginalExtension();
            $request->file('foto_trasera')->move($rutaGuardarImg, $fotoTrasera);
            $cliente->foto_trasera = $fotoTrasera;
        }

        // Guardar el cliente
        $cliente->save();

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Modificacion de perfil',
                'details' => 'El perfil del usuario ' . $cliente->user->name . ' ha sido modificado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente');
    }


    public function destroy(Cliente $cliente)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Eliminar tanto el cliente como el usuario

        $cliente->user->delete();
        
        $cliente->delete();
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Eliminacion de perfil',
                'details' => 'El perfil del usuario ' . $cliente->user->name . ' ha sido eliminado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('clientes.index');
    }
}
