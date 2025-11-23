<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller as BaseController;

class WeatherController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCurrentWeather()
    {
        $city = auth()->user()->city ?? config('services.openweather.default_city');
        $apiKey = config('services.openweather.api_key');

        try {
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'metric',
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json(['error' => 'Unable to fetch weather data'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Weather service unavailable'], 500);
        }
    }
}
