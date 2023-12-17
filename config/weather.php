<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'active_client' => env('WEATHER_CLIENT', 'open_weather_map'),

    'clients' => [
        'open_weather_map' => [
            'class' => \App\Services\Clients\OpenWeatherMapClient::class,
            'api_key' => env('OPEN_WEATHER_MAP_API_KEY'),
        ],
    ]
];
