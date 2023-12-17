<?php

namespace App\Dto\Weather\Clients;

use Spatie\LaravelData\Data;

class ForecastDto extends Data
{
    public function __construct(
        public int $datetime,
        public int $sunrise,
        public int $sunset,
        public string $summary,
        public ForecastTempDto $temp,
    ) {
    }
}
