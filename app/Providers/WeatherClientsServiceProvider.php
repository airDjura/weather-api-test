<?php

namespace App\Providers;

use App\Contracts\Weather\WeatherClientInterface;
use File;
use Illuminate\Support\ServiceProvider;

class WeatherClientsServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register all weather service clients (All classes in the Clients folder)

        foreach (config('weather.clients') as $client) {
            $this->app->singleton(
                WeatherClientInterface::class,
                $client['class']
            );
        }
    }

    public function boot()
    {
    }
}
