<?php

namespace App\Listeners;

use App\Events\UpdateElementEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateElementListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UpdateElementEvent  $event
     * @return void
     */
    public function handle(UpdateElementEvent $event)
    {
        $data = $event->data;
    }
}
