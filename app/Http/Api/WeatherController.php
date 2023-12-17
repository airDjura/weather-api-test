<?php

namespace App\Http\Api;

use App\Dto\Weather\Clients\WeatherDataDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Weather\GetByCoordinatesRequest;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    public function getWeatherByCoordinates(GetByCoordinatesRequest $request, WeatherService $weatherService): WeatherDataDto
    {
        // No need json resource here, because dto has expected structure
        return $weatherService->getWeatherByCoordinates($request->input('lat'), $request->input('lon'));
    }
}
