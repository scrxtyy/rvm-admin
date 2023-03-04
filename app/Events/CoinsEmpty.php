<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CoinsEmpty
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $empty;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($empty)
    {
        $this->empty = $empty;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|arrays
     */
    public function broadcastOn()
    {
        return new PrivateChannel('coins-empty');
    }

    public function broadcastAs(){
        return 'empty';
    }
}
