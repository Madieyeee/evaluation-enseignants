<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departement;

class DepartementSeeder extends Seeder
{
    public function run(): void
    {
        $departements = [
            ['code' => 'INFO', 'nom' => 'Informatique', 'description' => 'Département Informatique et Technologies'],
            ['code' => 'MGT', 'nom' => 'Management', 'description' => 'Département Management et Gestion'],
            ['code' => 'FIN', 'nom' => 'Finance', 'description' => 'Département Finance et Comptabilité'],
            ['code' => 'MARK', 'nom' => 'Marketing', 'description' => 'Département Marketing et Communication'],
        ];

        foreach ($departements as $dept) {
            Departement::create($dept);
        }
    }
}
