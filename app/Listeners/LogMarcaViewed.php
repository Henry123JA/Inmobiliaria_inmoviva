<?php

namespace App\Listeners;
use App\Events\MarcaViewed;
use App\Models\Bitacora;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogMarcaViewed
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function handle(MarcaViewed $event)
    {
        if (auth()->check()) {  // Verificar si un usuario está autenticado
            Bitacora::create([
                'action' => 'Visualización de marca',
                'details' => 'El detalle de la marca ' . $event->marca->nombre . ' ha sido visto',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
    }
}
