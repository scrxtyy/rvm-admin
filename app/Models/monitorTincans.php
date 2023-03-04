<?php

namespace App\Models;

use App\Events\StorageFull;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pusher\Pusher;

class monitorTincans extends Model
{
    use HasFactory;
    // protected $rvmID;

    // public function __construct($rvmID)
    // {
    //     $this->rvmID = $rvmID;
    // }
    // protected static function booted()
    // {
    //     static::creating(function ($model,$rvmID) {
    //         $orderTotal = monitorTincans::where('rvm_id',$this->rvmID)->orderBy('id','desc')->first();   
    //         $lastTotal = $orderTotal->total_kg; 

    //         if ($lastTotal >= 9.00) {
    //             $pusher = new Pusher(
    //                 env('PUSHER_APP_KEY'),
    //                 env('PUSHER_APP_SECRET'),
    //                 env('PUSHER_APP_ID'),
    //                 [
    //                     'cluster' => 'ap1',
    //                     'useTLS' => true
    //                 ]
    //             );
                
    //             $events = [
    //                 [
    //                     'channel' => 'storage-full',
    //                     'name' => 'full',
    //                     'data' => $orderTotal
    //                 ],
    //             ];
                
    //             $pusher->triggerBatch($events);
        
    //             StorageFull::dispatch($orderTotal);
    //         }

    //     });

        // static::updating(function ($model) {
        //     // Do something when a row is updated
        // });

        // static::deleting(function ($model) {
        //     // Do something when a row is deleted
        // });
    // }
}
