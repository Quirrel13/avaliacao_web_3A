<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function findRoleByName(string $name): ?Role
    {
        return Role::where('name', $name)->first();
    }

    public function getUsuariosByRoleName(string $roleName): Collection
    {
        return User::whereHas('role', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })->get();
    }

    public function createUser(array $data): User
    {
        return User::create($data);
    }

    public function updateUser(User $user, array $data): bool
    {
        return $user->update($data);
    }
}