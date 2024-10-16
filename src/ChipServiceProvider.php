<?php

namespace SyahrinSeth\ChipApi;

use Illuminate\Support\ServiceProvider;

class ChipServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('chipapi', function () {
            $config = config('chipapi');
            return new \Chip\ChipApi($config['brand_id'], $config['api_key'], $config['endpoint']);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/chipapi.php' => config_path('chipapi.php'),
        ]);
    }
}
