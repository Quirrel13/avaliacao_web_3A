<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CursoSeeder::class);
        $this->call(DisciplinaSeeder::class);
        $this->call(AlunoSeeder::class);
        $this->call(MatriculaSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ResourceSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
    }
}
