<?php

namespace App\Listeners;

use App\Events\ArticuloCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Bitacora;

class LogArticuloCreated
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ArticuloCreated  $event
     * @return void
     */
    public function handle(ArticuloCreated $event)
    {
        if (auth()->check()) {  // Verificar si un usuario está autenticado
            Bitacora::create([
                'action' => 'Creación de artículo',
                'details' => 'El artículo ' . $event->articulo->nombre . ' ha sido creado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
    }
}
