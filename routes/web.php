<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [WeatherController::class, 'index'])
    ->name('dashboard');
});

require __DIR__.'/settings.php';
