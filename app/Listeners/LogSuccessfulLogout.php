<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Bitacora;


class LogSuccessfulLogout
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
     * @param  \Illuminate\Auth\Events\Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        Bitacora::create([
            'action' => 'Cierre de sesión',
            'details' => 'El usuario ' . $event->user->name . ' ha cerrado sesión.',
            'user_id' => $event->user->id,
            'ip_address' => request()->ip(),
        ]);
    }
}
