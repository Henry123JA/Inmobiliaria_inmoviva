<?php

namespace App\Listeners;
use App\Events\MarcaCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Bitacora;

class LogMarcaCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    
    public function handle(MarcaCreated $event)
    {
        if (auth()->check()) {  // Verificar si un usuario está autenticado
            Bitacora::create([
                'action' => 'Creación de marca',
                'details' => 'La marca ' . $event->marca->nombre . ' ha sido creada',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
    }
}
