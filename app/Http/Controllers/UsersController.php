<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index()
    {

        $users = User::with('roles')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {

        $roles = Role::pluck('title', 'id');

        return view('users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']); // Encripta la contraseña

        $user = User::create($data);
        $user->roles()->sync($request->input('roles', []));

        // Si el rol seleccionado es cliente, crear una entrada en la tabla cliente
        $roleClienteId = Role::where('title', 'cliente')->pluck('id')->first();
        if (in_array($roleClienteId, $request->input('roles', []))) {
            Cliente::create([
                'user_id' => $user->id,
                'foto_frontal' => null, // Fotos en null al crear
                'foto_trasera' => null,
            ]);
        }
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Creacion de perfil',
                'details' => 'El perfil del usuario ' . $user->name . ' ha sido creado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('users.index')->with('success','Usuario creado exitosamente');

    }

    public function show(User $user)
    {
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Visualización de perfil',
                'details' => 'El perfil del usuario ' . $user->name . ' ha sido visualizado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return view('users.show', compact('user'));
    }

    public function showBitacora(User $user)
    {

        $bitacoras = $user->bitacoras; // Asume que 'bitacoras' es la relación definida en el modelo User
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Visualización de Bitacora',
                'details' => 'La bitacora de ' . $user->name . ' ha sido visto',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return view('users.bitacora', compact('user', 'bitacoras'));
    }

    public function edit(User $user)
    {

        $roles = Role::pluck('title', 'id');

        $user->load('roles');

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        $user->roles()->sync($request->input('roles', []));

        $roleClienteId = Role::where('title', 'cliente')->pluck('id')->first();

        // Si el rol "cliente" ya no está seleccionado, verificar y eliminar el registro de la tabla "cliente"
        if (!in_array($roleClienteId, $request->input('roles', []))) {
            // Buscar el registro del cliente relacionado con este usuario
            $cliente = Cliente::where('user_id', $user->id)->first();
            
            // Si el cliente existe, eliminarlo
            if ($cliente) {
                $cliente->delete();
            }
        }

        // Registrar la modificación en la bitácora si el usuario está autenticado
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Modificacion de perfil',
                'details' => 'El perfil del usuario ' . $user->name . ' ha sido modificado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }

        return redirect()->route('users.index')->with('success','Usuario modificado exitosamente');
    }



    public function destroy(User $user)
    {

        $user->delete();

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Eliminacion del perfil',
                'details' => 'El perfil del usuario ' . $user->name . ' ha sido eliminado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        return redirect()->route('users.index')->with('success','Usuario eliminado exitosamente');
    }

    public function propietarios()
    {

        $propietarios = User::whereHas('roles', function ($query) {
            $query->where('title', 'propietario');
        })->get();

        return view('users.propietarios', compact('propietarios'));
    }

}
