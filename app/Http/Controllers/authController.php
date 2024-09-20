<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function generateToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',

        ]);
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password))  // ! user -> existe el usuario?
        {
            return response()->json([
                'message' => 'credenciales incorrectas.',
                'errors' => [
                    'email' => ['datos incorrectos.'],
                ]
            ]);
        }
        return $user->createToken($request->device_name)->plainTextToken;
    }
    public function revokeToken(Request $request)
    {
        return $request;
    }
}
