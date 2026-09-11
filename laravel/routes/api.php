<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DisciplinaController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Cursos
    Route::apiResource('cursos', CursoController::class);
    // Disciplinas
    Route::apiResource('disciplinas', DisciplinaController::class);
});
