<?php

namespace App\Dto\Weather\Clients;

use Spatie\LaravelData\Data;

class ForecastTempDto extends Data
{
    public function __construct(
        public float $day,
        public float $min,
        public float $max,
        public float $night,
        public float $evening,
        public float $morning,
    ) {
    }
}
