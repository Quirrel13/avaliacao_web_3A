<?php

use App\Http\Controllers\AlunoController; //Adicionado
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DisciplinaController; //Adicionado
use App\Http\Controllers\MatriculaController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware(['auth', 'verified']);

Route::resource('/curso', CursoController::class)
    ->middleware(['auth', 'verified']);

Route::resource('/disciplina', DisciplinaController::class)
    ->middleware(['auth', 'verified']);

Route::resource('/aluno', AlunoController::class)
    ->middleware(['auth', 'verified']);

Route::resource('/matricula', MatriculaController::class)
    ->middleware(['auth', 'verified']);

Route::get('/audit/curso/{id}', [CursoController::class, 'audit'])
    ->name('curso.audit')->middleware(['auth', 'verified']);
