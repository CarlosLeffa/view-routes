<?php

namespace LeffaCarlos\ViewRoutes;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;

class RotasServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/view-routes.php', 'view-routes');
    }

    public function boot()
    {
        AboutCommand::add('LeffaCarlos\ViewRoutes', fn () => ['Version' => '1.0.0']);

        
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/view-routes.php' => 'config/view-routes.php',
            ], 'view-routes');
        }

        $this->loadRoutesFrom(__DIR__.'/../routes/view-routes.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'view-routes');
    }
}