<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["nome" => "JOÃO SILVA", "turma" => 2024, "curso_id" => 1],
            ["nome" => "ANA SANTOS", "turma" => 2025, "curso_id" => 1],
            ["nome" => "MARCOS SOUZA", "turma" => 2025, "curso_id" => 2],
            ["nome" => "BRUNA GOMES", "turma" => 2024, "curso_id" => 2],
        ];
        DB::table('alunos')->insert($data);
    }
}
