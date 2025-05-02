<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CarCategoryController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);

Route::resource('car-categories',CarCategoryController::class);

Route::resource('cars',CarController::class);

Route::resource('clients',ClientController::class);

Route::resource('rentals',RentalController::class);

Route::resource('payments',PaymentController::class);
