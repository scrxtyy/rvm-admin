<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StorageEmptied
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $notif;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($notif)
    {
        $this->notif = $notif;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('storage-empty');
    }

    public function broadcastAs(){
        return 'emptied';
    }
}
