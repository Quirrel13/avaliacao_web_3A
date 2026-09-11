<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatriculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["disciplina_id" => 1, "aluno_id" => 1],
            ["disciplina_id" => 2, "aluno_id" => 1],
            ["disciplina_id" => 2, "aluno_id" => 2],
            ["disciplina_id" => 3, "aluno_id" => 3],
            ["disciplina_id" => 3, "aluno_id" => 4],
            ["disciplina_id" => 4, "aluno_id" => 4],
        ];
        DB::table('matriculas')->insert($data);
    }
}
