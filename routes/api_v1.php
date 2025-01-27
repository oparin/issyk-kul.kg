<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ListingController;

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
    Route::prefix('listing')->group(function () {
        Route::name('listing.')->group(function () {
            Route::controller(ListingController::class)->group(function () {
                Route::get('/{id}', 'index')->name('index');
                Route::post('/', 'create')->name('create');
                Route::put('/{id}', 'update')->name('update');
                Route::delete('/{id}','delete')->name('delete');
            });
        });
    });
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
