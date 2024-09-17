<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;

use App\Models\User;
use Illuminate\Http\Request;
class BitacoraController extends Controller
{
    
    public function showBitacora($userId)
    {
        $user = User::findOrFail($userId);
        $bitacoras = Bitacora::where('user_id', $userId)->get(); // pasa la lista completa

        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Descarga de Bitacora',
                'details' => 'La bitacora de ' . $user->name . ' ha sido descargada en PDF',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }


        $currentDateTime = now()->format('Y-m-d H:i:s');

        return view('bitacora.show', compact('user', 'bitacoras', 'currentDateTime'));
    }
    
}
