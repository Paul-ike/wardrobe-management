<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClothingItemController;
use App\Http\Controllers\AuthController;

// Custom AuthController for handling registration and login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protect the following routes with Sanctum authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('clothing-items', ClothingItemController::class);
});
