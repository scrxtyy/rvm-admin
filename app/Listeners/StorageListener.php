<?php

namespace App\Listeners;

use App\Events\StorageFull;
use App\Models\monitorPlastics;
use App\Models\monitorTincans;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Queue\InteractsWithQueue;
use Pusher\Pusher;

class StorageListener
{
    public $rvm_id;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($rvm_id)
    {
        $this->rvm_id = $rvm_id;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(QueryExecuted $event, $rvm_id)
    {
        $lastPlasticRecord = monitorPlastics::where('rvm_id',$rvm_id)->latest()->first();
        $lastTincanRecord = monitorTincans::where('rvm_id',$rvm_id)->latest()->first();

        $storageType = "";
        if($lastPlasticRecord>=4.50){
            $storageType = 'Plastic';
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                [
                    'cluster' => 'ap1',
                    'useTLS' => true
                ]
            );
            
            $events = [
                [
                    'channel' => 'storage-full',
                    'name' => 'full',
                    'data' => $storageType
                ],
            ];
            
            $pusher->triggerBatch($events);
            StorageFull::dispatch($storageType);
    
        }
        else if($lastTincanRecord>=4.50){
            $storageType = 'Tin Cans';
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                [
                    'cluster' => 'ap1',
                    'useTLS' => true
                ]
            );
            
            $events = [
                [
                    'channel' => 'storage-full',
                    'name' => 'full',
                    'data' => $storageType
                ],
            ];
            
            $pusher->triggerBatch($events);
            StorageFull::dispatch($storageType);
        }
    }
}
