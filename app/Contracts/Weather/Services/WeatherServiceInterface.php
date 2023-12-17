<?php

namespace App\Contracts\Weather\Services;

use App\Contracts\Weather\WeatherClientInterface;
use App\Dto\Weather\Clients\WeatherDataDto;

interface WeatherServiceInterface
{
    public function getWeatherByCoordinates(int $lat, int $lon): WeatherDataDto;
    public static function setClient(WeatherClientInterface $client): self;
}
