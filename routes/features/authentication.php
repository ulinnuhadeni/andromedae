<?php

use App\Http\Controllers\Authentication\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->middleware('auth:sanctum')->group(function () {

    Route::get('/current-user', [AuthenticationController::class, 'currentUser'])
        ->name('current-user');

    Route::get('/logout', [AuthenticationController::class, 'logout'])
        ->name('logout');

    Route::post('/login', [AuthenticationController::class, 'login'])
        ->withoutMiddleware('auth:sanctum')
        ->name('login');
});
