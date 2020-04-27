<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TaskService;
use App\Services\CalendarService;
use App\Services\UtilService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\TaskService');
        $this->app->bind('App\Services\CalendarService');
        $this->app->bind('App\Services\UtilService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
