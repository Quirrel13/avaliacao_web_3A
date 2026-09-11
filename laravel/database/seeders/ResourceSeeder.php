<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // CURSO
            ["name" => "curso.index"],	// 1
            ["name" => "curso.create"],	// 2
            ["name" => "curso.show"],	// 3
            ["name" => "curso.edit"],	// 4
            ["name" => "curso.delete"],	// 5
            // DISCIPLINA
            ["name" => "disciplina.index"],	// 6
            ["name" => "disciplina.create"],	// 7
            ["name" => "disciplina.show"],	// 8
            ["name" => "disciplina.edit"],	// 9
            ["name" => "disciplina.delete"],	// 10
            // ALUNO
            ["name" => "aluno.index"],	// 11
            ["name" => "aluno.create"],	// 12
            ["name" => "aluno.show"],	// 13
            ["name" => "aluno.edit"],	// 14
            ["name" => "aluno.delete"],	// 15
            // MATTRICULA
            ["name" => "matricula.index"],	// 16
            ["name" => "matricula.create"],	// 17
            ["name" => "matricula.show"],	// 18
            ["name" => "matricula.edit"],	// 19
            ["name" => "matricula.delete"],	// 20
        ];
        DB::table('resources')->insert($data);
    }
}
