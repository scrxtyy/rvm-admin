<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Employees;
use App\Observers\AdminObserver;

class AdminProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Employees::observe(AdminObserver::class); 
    }
}
