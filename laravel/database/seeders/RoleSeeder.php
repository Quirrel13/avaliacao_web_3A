<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'gerente_geral'],
            ['name' => 'gerente_conta'],
            ['name' => 'cliente'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}