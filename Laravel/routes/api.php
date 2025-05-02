<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RentalController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
});

Route::middleware(['auth:api', 'role:Admin'])->group(function () {
    Route::apiResource('cars', CarController::class);
});

Route::middleware(['auth:api', 'role:Manager,Admin'])->group(function () {
    Route::apiResource('clients', ClientController::class);
});

Route::middleware(['auth:api', 'role:Client'])->group(function () {
    Route::get('/my-rentals', [RentalController::class, 'clientRentals']);
});
