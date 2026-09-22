<?php

use App\Http\Controllers\GerenteGeralController;
use App\Http\Controllers\GerenteContaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Rotas do Gerente Geral
    Route::prefix('gerente-geral')->group(function () {
        Route::get('/gerentes', [GerenteGeralController::class, 'indexGerentes'])->name('gerente.gerentes.index');
        Route::post('/gerentes', [GerenteGeralController::class, 'storeGerente'])->name('gerente.gerentes.store');
        Route::get('/solicitacoes', [GerenteGeralController::class, 'solicitacoes'])->name('gerente.solicitacoes');
        Route::post('/solicitacoes/{solicitacao}/avaliar', [GerenteGeralController::class, 'avaliarSolicitacao'])->name('gerente.solicitacoes.avaliar');
        Route::get('/logs', [GerenteGeralController::class, 'logsAuditoria'])->name('gerente.logs');
    });

    // Rotas do Gerente de Conta
    Route::prefix('gerente-conta')->group(function () {
        Route::get('/clientes', [GerenteContaController::class, 'indexClientes'])->name('conta.clientes.index');
        Route::post('/clientes', [GerenteContaController::class, 'storeCliente'])->name('conta.clientes.store');
        Route::post('/clientes/{conta}/limite', [GerenteContaController::class, 'solicitarAumentoLimite'])->name('conta.clientes.limite');
        Route::post('/clientes/{conta}/bloqueio', [GerenteContaController::class, 'toggleBloqueio'])->name('conta.clientes.bloqueio');
    });
});