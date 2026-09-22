<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoInvestimento;

class TipoInvestimentoSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            ['nome' => 'CDB'],
            ['nome' => 'CDI'],
            ['nome' => 'Poupança'],
        ];

        foreach ($tipos as $tipo) {
            TipoInvestimento::firstOrCreate(['nome' => $tipo['nome']], $tipo);
        }
    }
}