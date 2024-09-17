<?php

namespace App\Events;
use App\Models\marca;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MarcaViewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $marca;

    /**
     * Create a new event instance.
     *
     * @param Marca $marca
     */
    public function __construct(marca $marca)
    {
        $this->marca = $marca;
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
