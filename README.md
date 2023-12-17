## Setup

### Run docker compose

```docker compose up -d```

### Setup project

```docker compose exec php composer install && cp .env.example .env && php artisan key:generate```

### Change open weather map API key

Set `OPEN_WEATHER_MAP_API_KEY` in `.env` file

Open weather map API key can be obtained [here](https://home.openweathermap.org/api_keys)


### Try it

```
Headers: Aceept: application/json
http://localhost/api/weather/get-by-coordinates?lat=42&lon=18
```

### Run tests

```docker compose exec php php artisan test```
