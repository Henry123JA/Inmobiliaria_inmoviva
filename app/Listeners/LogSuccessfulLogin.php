<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Bitacora;


class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        Bitacora::create([
            'action' => 'Inicio de sesión',
            'details' => 'El usuario ' . $event->user->name . ' ha iniciado sesión.',
            'user_id' => $event->user->id,
            'ip_address' => request()->ip(),
        ]);
    }
}
