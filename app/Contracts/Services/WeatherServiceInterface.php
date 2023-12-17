<?php

namespace App\Contracts\Services;

use App\Contracts\Clients\WeatherClientInterface;
use App\Dto\Weather\Clients\WeatherDataDto;

interface WeatherServiceInterface
{
    public function getWeatherByCoordinates(int $lat, int $lon): WeatherDataDto;
    public static function setClient(WeatherClientInterface $client): self;
}
