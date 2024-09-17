<?php

namespace App\Events;
use App\Models\Articulo;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticuloViewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $articulo;

    /**
     * Create a new event instance.
     *
     * @param Articulo $articulo
     */
    public function __construct(Articulo $articulo)
    {
        $this->articulo = $articulo;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
