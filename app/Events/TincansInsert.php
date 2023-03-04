<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TincansInsert
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $tincanInsert;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($tincanInsert)
    {
        $this->tincanInsert = $tincanInsert;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('tincan-insert');
    }
    public function broadcastAs(){
        return 'insert-2';
    }
}
