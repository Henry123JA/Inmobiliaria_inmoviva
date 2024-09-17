<?php

namespace App\Listeners;

use App\Events\ArticuloUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Bitacora;

class LogArticuloUpdated
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ArticuloUpdated  $event
     * @return void
     */
    public function handle(ArticuloUpdated $event)
    {
        if (auth()->check()) {  // Verificar si un usuario está autenticado 
            Bitacora::create([
                'action' => 'Modificación de artículo',
                'details' => 'El artículo ' . $event->articulo->nombre . ' ha sido modificado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
    }
}
