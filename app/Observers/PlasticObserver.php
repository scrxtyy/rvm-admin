<?php

namespace App\Observers;

use DB;
use App\Models\monitorPlastics;
use Illuminate\Support\Facades\Mail;
use App\Mail\RvmMail;
class PlasticObserver
{
    /**
     * Handle the monitorPlastics "created" event.
     *
     * @param  \App\Models\monitorPlastics  $monitorPlastics
     * @return void
     */
    public function created(monitorPlastics $monitorPlastics)
    {
        $latestEmpty = DB::table('lastemptyplastics')->orderBy('lastemptydate', 'desc')->first();
        $sumLatestPlastics = monitorPlastics::where('created_at','>',$latestEmpty->lastemptydate)->sum('pieces');
        //kunware lang, limit naten ayyy 200, gagawa ako ng if
        if($sumLatestPlastics >= 200)
        {
            //kung 200 na, mag send ng email
            Mail::to("allyyydelrosario@gmail.com")
            ->send(new RvmMail());
            
            //kung hindi, wag

            //turnOFF RPI(){

                //code here to turn off rpi

            //}
        }
    }

    /**
     * Handle the monitorPlastics "updated" event.
     *
     * @param  \App\Models\monitorPlastics  $monitorPlastics
     * @return void
     */
    public function updated(monitorPlastics $monitorPlastics)
    {
 
    }

    /**
     * Handle the monitorPlastics "deleted" event.
     *
     * @param  \App\Models\monitorPlastics  $monitorPlastics
     * @return void
     */
    public function deleted(monitorPlastics $monitorPlastics)
    {
        //
    }

    /**
     * Handle the monitorPlastics "restored" event.
     *
     * @param  \App\Models\monitorPlastics  $monitorPlastics
     * @return void
     */
    public function restored(monitorPlastics $monitorPlastics)
    {
        //
    }

    /**
     * Handle the monitorPlastics "force deleted" event.
     *
     * @param  \App\Models\monitorPlastics  $monitorPlastics
     * @return void
     */
    public function forceDeleted(monitorPlastics $monitorPlastics)
    {
        //
    }
}
