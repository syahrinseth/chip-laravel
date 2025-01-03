<?php

namespace SyahrinSeth\ChipLaravel;

use Illuminate\Support\ServiceProvider;

class ChipServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load the package's configuration file
        $this->mergeConfigFrom(__DIR__.'/../config/chiplaravel.php', 'chiplaravel');

        // Optionally, publish the configuration file
        $this->publishes([
            __DIR__.'/../config/chiplaravel.php' => config_path('chiplaravel.php'),
        ], 'config');
    }

    public function register()
    {
        // Register bindings or services for your package
        $this->app->singleton('chiplaravel', function ($app) {
            $config = config('chiplaravel'); // Fetch the config data
    
            return new \Chip\ChipApi(
                $config['brand_id'], 
                $config['api_key'], 
                $config['endpoint']
            );
        });
    }
}
