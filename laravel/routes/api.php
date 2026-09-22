<?php

use App\Http\Controllers\Api\ClienteApiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('v1/cliente')->group(function () {
    Route::get('/dashboard', [ClienteApiController::class, 'dashboard']);
    Route::post('/pix', [ClienteApiController::class, 'realizarPix']);
    Route::post('/investimentos/aplicar', [ClienteApiController::class, 'aplicar']);
    Route::post('/investimentos/resgatar', [ClienteApiController::class, 'resgatar']);
});