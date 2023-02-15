<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateDropdown
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $test;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($test)
    {
        $this->test = $test;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('update-dropdown');
    }
    /**
     * On Update Event
     * 
     * @return void
     */
    public function broadcastAs(){
        return 'update';
    }
}
