<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["nome" => "MATEMÁTICA", "carga_horaria" => 3, "curso_id" => 1],
            ["nome" => "FÍSICA", "carga_horaria" => 2, "curso_id" => 1],
            ["nome" => "PROGRAMAÇÃO", "carga_horaria" => 4, "curso_id" => 2],
            ["nome" => "BANCO DE DADOS", "carga_horaria" => 2, "curso_id" => 2],
        ];
        DB::table('disciplinas')->insert($data);
    }
}
