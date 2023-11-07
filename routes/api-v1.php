<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login']);

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/me', [\App\Http\Controllers\Api\V1\AuthController::class, 'me']);
    Route::get('/refresh', [\App\Http\Controllers\Api\V1\AuthController::class, 'me']);
    Route::apiResource('messages', \App\Http\Controllers\Api\V1\MessageController::class)
        ->only(['index', 'store']);
    Route::post('/messages', [\App\Http\Controllers\Api\V1\MessageController::class, 'store']);
    Route::get('/users/{user}', [\App\Http\Controllers\Api\V1\UserController::class, 'show']);
    Route::get('/users/{user}/send-like', [\App\Http\Controllers\Api\V1\UserLikeController::class, 'sendLike']);
});
