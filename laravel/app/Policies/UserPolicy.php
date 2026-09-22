<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function manageGerentes(User $user): bool
    {
        return $user->role->name === 'gerente_geral';
    }
}