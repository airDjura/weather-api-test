<?php

namespace Tests\Feature\Api\Weather;

class OpenWeatherMapTest extends WeatherTestCase
{
    protected string $routeName = 'api.weather.get-by-coordinates';
    protected array $expectedResponseStructure = [
        'lat',
        'lon',
        'current_forecast' => [
            'datetime',
            'temp',
            'feels_like',
        ],
        'daily_forecast' => [
            [
                'datetime',
                'sunrise',
                'sunset',
                'summary',
                'temp' => [
                    'day',
                    'min',
                    'max',
                    'night',
                    'evening',
                    'morning',
                ],
            ]
        ],
    ];

    /**
     * @test
     * @covers \App\Services\Clients\OpenWeatherMapClient
     * @covers \App\Services\WeatherService
     * @covers \App\Http\Api\WeatherController
     * @covers \App\Http\Requests\Api\Weather\WeatherRequest
     * @covers \App\Dto\Weather\Clients\WeatherDataDto
     */
    public function itReturnsSuccessResponseWithTheCorrectData()
    {
        $this->fakeSuccesfullGetByCoordinates();

        $response = $this->get(route($this->routeName, [
            'lat' => 42,
            'lon' => 18,
        ]));

        $response
            ->assertStatus(200)
            ->assertJsonStructure($this->expectedResponseStructure);
    }

    /**
     * @test
     * @covers \App\Http\Requests\Api\Weather\WeatherRequest
     */
    public function itReturnsUnprocessableEntityResponseWhenProvidedDataIsInvalid(): void
    {
        $response = $this->get(route($this->routeName, [
            'lat' => 42,
            'lon' => 'not numeric',
        ]));

        $response->assertStatus(302)
            ->assertInvalid(
                [
                    'lon',
                ],
            );
    }

    /**
     * @test
     * @covers \App\Services\Clients\OpenWeatherMapClient
     * @covers \App\Services\WeatherService
     * @covers \App\Http\Api\WeatherController
     * @covers \App\Http\Requests\Api\Weather\WeatherRequest
     */
    public function itThrowsExceptionWhenThirdPartyEndpointFails(): void
    {
        $this->fakeFailedGetByCoordinates();

        $response = $this->get(route($this->routeName, [
            'lat' => 42,
            'lon' => 18,
        ]));

        $response->assertStatus(401)
            ->assertJsonStructure(['cod', 'message']);
    }
}
