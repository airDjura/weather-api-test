<?php

namespace App\Services\Weather\Clients;

use App\Contracts\Weather\WeatherClientInterface;
use App\Dto\Weather\Clients\WeatherDataDto;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;

class OpenWeatherMapClient implements WeatherClientInterface
{
    protected PendingRequest $client;
    protected string $version = '3.0';
    public function __construct()
    {
        $this->client = Http::withOptions(
            [
                'query' => ['appid' => config('weather.clients.open_weather_map.api_key')],
            ]
        )
            ->baseUrl('https://api.openweathermap.org/data/' . $this->version);
    }

    public function getWeatherByCoordinates(int $lat, int $lon): WeatherDataDto
    {
        $response = $this->client->get('/onecall', [
            'lat' => $lat,
            'lon' => $lon,
        ]);

        $responseData = json_decode($response, true);

        if (array_key_exists('cod', $responseData)) {
            throw new HttpResponseException(response($responseData, $responseData['cod']));
        }

        return WeatherDataDto::fromOpenWeatherMapResponse($responseData);
    }
}
