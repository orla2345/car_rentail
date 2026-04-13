<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('brands', \App\Http\Controllers\Api\brandController::class);
Route::resource("drivers", \App\Http\Controllers\Api\driverController::class);
Route::resource("loyalty_levels", \App\Http\Controllers\Api\LoyaltyLevelController::class);
Route::resource("cars", \App\Http\Controllers\Api\carController::class);
Route::resource("payments", \App\Http\Controllers\Api\paymentController::class);
Route::resource("rentals", \App\Http\Controllers\Api\rentalController::class);  
Route::resource("users", \App\Http\Controllers\Api\UserController::class);
