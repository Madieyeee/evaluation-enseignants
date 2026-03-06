<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Ordre important : Départements -> Filières -> Matières -> Admin -> Critères
        $this->call([
            DepartementSeeder::class,
            FiliereSeeder::class,
            MatiereSeeder::class,
            AdminSeeder::class,
            CritereSeeder::class,
        ]);
    }
}
