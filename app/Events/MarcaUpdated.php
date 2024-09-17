<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\marca;

class MarcaUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $marca;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Marca  $marca
     * @return void
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
