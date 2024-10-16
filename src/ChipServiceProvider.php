<?php

namespace SyahrinSeth\ChipApi;

use Illuminate\Support\ServiceProvider;

class ChipServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load the package's configuration file
        $this->mergeConfigFrom(__DIR__.'/../config/chipapi.php', 'chipapi');

        // Optionally, publish the configuration file
        $this->publishes([
            __DIR__.'/../config/chipapi.php' => config_path('chipapi.php'),
        ], 'config');
    }

    public function register()
    {
        // Register bindings or services for your package
    }
}
