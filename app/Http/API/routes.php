<?php

use App\Http\API\Controllers\AuthController;
use App\Http\API\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::name('auth.')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('/register', 'register')->name('register');
            Route::post('/login', 'login')->name('login');
            Route::any('/logout','logout')->name('logout')->middleware('auth:sanctum');
        });
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('listing', ListingController::class);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
