<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Bitacora;

class LogUserRegistered
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        Bitacora::create([
            'action' => 'Registro de usuario',
            'details' => 'El usuario ' . $event->user->name . ' se ha registrado.',
            'user_id' => $event->user->id,
            'ip_address' => request()->ip(),
        ]);
    }
}
