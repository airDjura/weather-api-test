<?php

namespace App\Contracts\Clients;

use App\Dto\Weather\Clients\WeatherDataDto;

interface WeatherClientInterface
{
    public function getWeatherByCoordinates(int $lat, int $lon): WeatherDataDto;
}
