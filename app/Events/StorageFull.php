<?php

namespace App\Events;

use App\Listeners\StorageListener;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StorageFull
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notifyAdmin;
    public $rvm_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($notifyAdmin,$rvm_id)
    {
        $this->notifyAdmin = $notifyAdmin;
        $this->listen(new StorageListener($rvm_id));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('storage-full');
    }
    public function broadcastAs(){
        return 'full';
    }
}
