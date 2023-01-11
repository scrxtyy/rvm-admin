<?php

namespace App\Observers;

use App\Models\Employees;

class AdminObserver
{
    /**
     * Handle the Employees "created" event.
     *
     * @param  \App\Models\Employees  $employees
     * @return void
     */
    public function created(Employees $employees)
    {
        //
    }

    /**
     * Handle the Employees "updated" event.
     *
     * @param  \App\Models\Employees  $employees
     * @return void
     */
    public function updated(Employees $employees)
    {
        //
    }

    /**
     * Handle the Employees "deleted" event.
     *
     * @param  \App\Models\Employees  $employees
     * @return void
     */
    public function deleted(Employees $employees)
    {
        //
    }

    /**
     * Handle the Employees "restored" event.
     *
     * @param  \App\Models\Employees  $employees
     * @return void
     */
    public function restored(Employees $employees)
    {
        //
    }

    /**
     * Handle the Employees "force deleted" event.
     *
     * @param  \App\Models\Employees  $employees
     * @return void
     */
    public function forceDeleted(Employees $employees)
    {
        //
    }
}
