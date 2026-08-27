<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Geocoding API | Searches for location 
        // Most accurate way to specify location 
        // This method is intergrated with the OpenWeatherMap API
        // This is the process of transformation of any location name to coordinates
        $locationResponse = Http::get('http://api.openweathermap.org/geo/1.0/direct', [
            'q' => 'Derry', // Location name to search for
            'limit' => '5', // Caps location response to 5 results
            'appid' => config('services.openweather.key'),   // API key for OpenWeatherMap
        ]);

        $locations = $locationResponse->json();

        // dd(is_null(config('services.openweather.key')));

        // dd($locations);

        // Takes first result 
        $location = $locations[0] ?? null;

        // Weather Response now that we have got location
        $weatherResponse = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'lat' => $location['lat'], // Latitude of the location
            'lon' => $location['lon'], // Longitude of the location
            'appid' => config('services.openweather.key'), // API key for OpenWeatherMap
            'units' => 'metric', // Units for temperature (metric for Celsius)

        ]);

        $weatherData = $weatherResponse->json();

        $forecastResponse = Http::get('https://api.openweathermap.org/data/2.5/forecast', [
            'lat' => $location['lat'], // Latitude of the location
            'lon' => $location['lon'], // Longitude of the location
            'appid' => config('services.openweather.key'), // API key for OpenWeatherMap
            'units' => 'metric', // Units for temperature (metric for Celsius)
        ]);

        $forecastData = $forecastResponse->json();

        $forecasts = array_slice($forecastData['list'], 0, 7);

        // Return the weather data as a JSON response
        // return response()->json($weatherData);

        return view('dashboard', [
            'weather' => $weatherData,
            'location' => $location,
            'forecasts' => $forecasts,
        ]);

        /**
         * Show the form for creating a new resource.
         */
    }
}
