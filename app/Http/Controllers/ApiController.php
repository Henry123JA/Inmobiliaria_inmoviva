<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function mostrarUsers()
    {
        $users=User::all();
        return json_encode($users);
    }

    public function mostrarUser(int $id)
    {
        $user=User::find($id);
        return json_encode($user);
    }
    public function mostrarUser2(Request $request)
    {
        $user=User::find($request->id);
        return json_encode($user);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required',
        ]);
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password= bcrypt($request->password);
        $user->save();

        $msj="Se creo el usuario ('.$request->name.') correctamente ";
        return json_encode($msj);
    }    
}
