<?php

namespace App\Weather\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    public function getWeather(string $city)
    {
        return Cache::remember("weather_{$city}", 3600, function () use ($city) {
            $response = Http::get('http://api.openweathermap.org/data/2.5/weather', [
                'q' => $city,
                'appid' => env('WEATHER_API_KEY'),
                'units' => 'metric',
                'lang' => 'uk'
            ]);

            if ($response->failed()) {
                return null;
            }

            return $response->json();
        });
    }
}
