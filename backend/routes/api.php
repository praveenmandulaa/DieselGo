<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FuelBookingController;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/fuel-types', [FuelBookingController::class, 'fuelTypes']);

Route::get('/bookings', [FuelBookingController::class, 'index']);

Route::post('/bookings', [FuelBookingController::class, 'store']);

Route::get('/bookings/{id}', [FuelBookingController::class, 'show']);
});