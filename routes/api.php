<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RegistrationController;
use Illuminate\Support\Facades\Route;


Route::post('registration', [RegistrationController::class, '__invoke']);
Route::post('login', [AuthController::class, 'login']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::middleware('jwt.auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'show']);
    Route::post('logout', [AuthController::class, 'logout']);
});
