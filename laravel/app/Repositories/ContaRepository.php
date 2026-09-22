<?php

namespace App\Repositories;

use App\Models\Conta;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ContaRepository extends BaseRepository
{
    public function getModel(): Conta
    {
        return new Conta();
    }

    public function findByUsuarioId(int $usuarioId): ?Conta
    {
        return Conta::where('usuario_id', $usuarioId)->first();
    }

    public function getAllContasWithUser(): Collection
    {
        return Conta::with('usuario')->get();
    }

    public function findUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function setBloqueio(Conta $conta, bool $bloqueada): bool
    {
        return $conta->update(['bloqueada' => $bloqueada]);
    }
}