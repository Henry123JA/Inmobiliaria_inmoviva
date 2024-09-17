<?php

namespace App\Listeners;

use App\Events\MarcaUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Bitacora;

class LogMarcaUpdated
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\MarcaUpdated  $event
     * @return void
     */
    public function handle(MarcaUpdated $event)
    {
        if (auth()->check()) {  // Verificar si un usuario está autenticado
            Bitacora::create([
                'action' => 'Modificación de marca',
                'details' => 'La marca ' . $event->marca->nombre . ' ha sido modificada',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
    }
}
