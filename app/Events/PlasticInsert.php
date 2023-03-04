<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlasticInsert
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $plasticInsert;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($plasticInsert)
    {
        $this->plasticInsert = $plasticInsert;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('plastic-insert');
    }
    public function broadcastAs(){
        return 'insert-1';
    }
}
