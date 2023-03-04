<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateUserNotif
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $latestNotif;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($latestNotif)
    {
        $this->latestNotif = $latestNotif;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notif-update');
    }
    
    public function broadcastAs(){
        return 'usernotif';
    }
}
