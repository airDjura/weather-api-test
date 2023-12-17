<?php

namespace App\Dto\Weather\Clients;

use Spatie\LaravelData\Data;

class CurrentWeatherDto extends Data
{
    public function __construct(
        public int $datetime,
        public float $temp,
        public float $feels_like,
    ) {
    }
}
