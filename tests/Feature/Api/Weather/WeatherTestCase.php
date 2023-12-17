<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Weather;

use Illuminate\Support\Facades\Http;
use Tests\CreatesApplication;
use Tests\TestCase;

abstract class WeatherTestCase extends TestCase
{
    use CreatesApplication;
    protected array $successOpenWeatherMapGetByCoordinatesMock = [
        "lat" => 42,
        "lon" => 18,
        "timezone" => "Europe/Podgorica",
        "timezone_offset" => 3600,
        "current" => [
            "dt" => 1702775977,
            "sunrise" => 1702793408,
            "sunset" => 1702826264,
            "temp" => 285,
            "feels_like" => 283.62,
            "pressure" => 1033,
            "humidity" => 53,
            "dew_point" => 275.74,
            "uvi" => 0,
            "clouds" => 3,
            "visibility" => 10000,
            "wind_speed" => 1.62,
            "wind_deg" => 247,
            "wind_gust" => 2.4,
            "weather" => [
                0 => [
                    "id" => 800,
                    "main" => "Clear",
                    "description" => "clear sky",
                    "icon" => "01n",
                ]
            ]
        ],
        "daily" => [
            0 => [
                "dt" => 1702807200,
                "sunrise" => 1702793408,
                "sunset" => 1702826264,
                "moonrise" => 1702807440,
                "moonset" => 1702844460,
                "moon_phase" => 0.16,
                "summary" => "There will be clear sky today",
                "temp" => [
                    "day" => 284.09,
                    "min" => 283.93,
                    "max" => 286.11,
                    "night" => 286.11,
                    "eve" => 284.65,
                    "morn" => 284.68,
                ],
                "feels_like" => [
                    "day" => 282.52,
                    "night" => 284.9,
                    "eve" => 283.19,
                    "morn" => 283.32,
                ],
                "pressure" => 1037,
                "humidity" => 49,
                "dew_point" => 273.95,
                "wind_speed" => 6.44,
                "wind_deg" => 329,
                "wind_gust" => 6.5,
                "weather" => [
                    0 => [
                        "id" => 800,
                        "main" => "Clear",
                        "description" => "clear sky",
                        "icon" => "01d",
                    ],
                ],
                "clouds" => 0,
                "pop" => 0,
                "uvi" => 1.34,
            ]
        ]
    ];

    protected array $errorResponseBody = [
        'cod' => 401,
        'message' => 'Error message'
    ];

    protected function fakeSuccesfullGetByCoordinates()
    {
        Http::fake(
            [
                'https://api.openweathermap.org/data/3.0/onecall*' => Http::response(
                    $this->successOpenWeatherMapGetByCoordinatesMock,
                    200
                ),
            ]
        );
    }

    protected function fakeFailedGetByCoordinates()
    {
        Http::fake(
            [
                'https://api.openweathermap.org/data/3.0/onecall*' => Http::response(
                    $this->errorResponseBody,
                    401
                ),
            ]
        );
    }
}
