<?php

namespace App\Services\Weather;

use App\Contracts\Weather\Services\WeatherServiceInterface;
use App\Contracts\Weather\WeatherClientInterface;
use App\Dto\Weather\Clients\WeatherDataDto;

class WeatherService implements WeatherServiceInterface
{
    public function __construct(protected WeatherClientInterface $client)
    {
    }

    public static function setClient(WeatherClientInterface $client): self
    {
        return new self($client);
    }

    public function getWeatherByCoordinates(int $lat, int $lon): WeatherDataDto
    {
        return $this->client->getWeatherByCoordinates($lat, $lon);
    }
}
