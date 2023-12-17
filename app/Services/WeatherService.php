<?php

namespace App\Services;

use App\Contracts\Clients\WeatherClientInterface;
use App\Contracts\Services\WeatherServiceInterface;
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
