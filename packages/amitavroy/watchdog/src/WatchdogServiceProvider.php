<?php

namespace Amitav\Watchdog;

use Illuminate\Support\ServiceProvider;

class WatchdogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('watchdog', function ($app) {
            return new Watchdog;
        });
    }

    public function boot()
    {
        // loading the routes from the routes file.
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }

        // define the path to views
        $this->loadViewsFrom(__DIR__ . '/../views', 'watchdog');
    }
}
