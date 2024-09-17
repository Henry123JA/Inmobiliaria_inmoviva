<?php

namespace App\Listeners;

use App\Events\ArticuloViewed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Bitacora;

class LogArticuloViewed
{
    /**
     * Handle the event.
     *
     * @param ArticuloViewed $event
     * @return void
     */
    public function handle(ArticuloViewed $event)
    {
        if (auth()->check()) {  // Verificar si un usuario está autenticado
            Bitacora::create([
                'action' => 'Visualización de artículo',
                'details' => 'El detalle de artículo ' . $event->articulo->nombre . ' ha sido visto',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
    }
}
