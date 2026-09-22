<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Conta;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roleGerenteGeral = Role::where('name', 'gerente_geral')->first();
        $roleGerenteConta = Role::where('name', 'gerente_conta')->first();
        $roleCliente = Role::where('name', 'cliente')->first();

        // 1. Gerente Geral
        User::firstOrCreate(
            ['email' => 'gerente.geral@ifbank.com'],
            [
                'name' => 'Gerente Geral',
                'password' => bcrypt('password'),
                'role_id' => $roleGerenteGeral->id,
            ]
        );

        // 2. Gerente de Conta
        User::firstOrCreate(
            ['email' => 'gerente.conta@ifbank.com'],
            [
                'name' => 'Gerente de Conta',
                'password' => bcrypt('password'),
                'role_id' => $roleGerenteConta->id,
            ]
        );

        // 3. Cliente Teste (com Conta Bancária vinculada)
        $cliente = User::firstOrCreate(
            ['email' => 'cliente@ifbank.com'],
            [
                'name' => 'Cliente Teste',
                'password' => bcrypt('password'),
                'role_id' => $roleCliente->id,
            ]
        );

        Conta::firstOrCreate(
            ['usuario_id' => $cliente->id],
            [
                'saldo' => 5000.00,
                'limite' => 1000.00,
                'bloqueada' => false,
            ]
        );
    }
}