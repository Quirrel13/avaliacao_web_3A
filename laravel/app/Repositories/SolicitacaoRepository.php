<?php

namespace App\Repositories;

use App\Models\Solicitacao;
use Illuminate\Database\Eloquent\Collection;

class SolicitacaoRepository extends BaseRepository
{
    public function getModel(): Solicitacao
    {
        return new Solicitacao();
    }

    public function getPendentes(): Collection
    {
        return Solicitacao::with(['conta.usuario', 'gerenteConta'])
            ->where('status', 'pendente')
            ->get();
    }
}