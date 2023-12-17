<?php

namespace App\Dto\Weather\Clients;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class WeatherDataDto extends Data
{
    public function __construct(
        public string $lat,
        public string $lon,
        public CurrentWeatherDto  $current_forecast,
        #[DataCollectionOf(ForecastDto::class)]
        public DataCollection $daily_forecast,
    )
    {
    }


    public static function fromOpenWeatherMapResponse(array $data): self
    {
        $dailyForecastData = [];

        foreach ($data['daily'] as $daily) {
            $forecastTempDto = new ForecastTempDto(
                $daily['temp']['day'],
                $daily['temp']['min'],
                $daily['temp']['max'],
                $daily['temp']['night'],
                $daily['temp']['eve'],
                $daily['temp']['morn'],
            );

            $dailyForecastData[] = new ForecastDto(
                $daily['dt'],
                $daily['sunrise'],
                $daily['sunset'],
                $daily['summary'],
                $forecastTempDto,
            );
        }

        $forecastCollection = ForecastDto::collection($dailyForecastData);

        return new self(
            $data['lat'],
            $data['lon'],
            new CurrentWeatherDto($data['current']['dt'], $data['current']['temp'], $data['current']['feels_like']),
            $forecastCollection
        );
    }
}
