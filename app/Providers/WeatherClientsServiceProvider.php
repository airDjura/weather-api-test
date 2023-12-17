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
        $filesInFolder = File::files(base_path() .'/app/Services/Weather/Clients');

        foreach ($filesInFolder as $path) {
            $file = pathinfo($path);
            $class = 'App\Services\Weather\Clients\\' . $file['filename'];
            $this->app->singleton(
                WeatherClientInterface::class,
                $class
            );
        }
    }

    public function boot()
    {
    }
}
