<?php

namespace App\Providers;

use App\Contracts\Services\WeatherServiceInterface;
use App\Services\WeatherService;
use Illuminate\Support\ServiceProvider;

class WeatherServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $weatherActiveClientConfig = config('weather.clients')[config('weather.active_client')];

        $client = new $weatherActiveClientConfig['class'];

        $this->app->singleton(
            WeatherServiceInterface::class,
            fn() => new WeatherService($client)
        );
    }

    public function boot()
    {
    }
}
