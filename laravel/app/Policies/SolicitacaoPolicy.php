<?php

namespace App\Policies;

use App\Models\Solicitacao;
use App\Models\User;

class SolicitacaoPolicy
{
    public function create(User $user): bool
    {
        return $user->role->name === 'gerente_conta';
    }

    public function avaliar(User $user): bool
    {
        return $user->role->name === 'gerente_geral';
    }
}