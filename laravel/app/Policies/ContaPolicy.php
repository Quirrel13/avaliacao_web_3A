<?php

namespace App\Policies;

use App\Models\Conta;
use App\Models\User;

class ContaPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role->name, ['gerente_geral', 'gerente_conta']);
    }

    public function view(User $user, Conta $conta): bool
    {
        if ($user->role->name === 'cliente') {
            return $conta->usuario_id === $user->id;
        }

        return in_array($user->role->name, ['gerente_geral', 'gerente_conta']);
    }

    public function create(User $user): bool
    {
        return $user->role->name === 'gerente_conta';
    }

    public function update(User $user, Conta $conta): bool
    {
        return $user->role->name === 'gerente_conta';
    }

    public function toggleBloqueio(User $user): bool
    {
        return $user->role->name === 'gerente_conta';
    }
}