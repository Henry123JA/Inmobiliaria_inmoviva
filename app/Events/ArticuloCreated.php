<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Articulo;
class ArticuloCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $articulo;
    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return void
     */
    public function __construct(Articulo $articulo)
    {
        $this->articulo = $articulo;
    }
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
