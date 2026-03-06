<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Critere;

class CritereSeeder extends Seeder
{
    public function run(): void
    {
        $criteres = [
            ['nom' => 'Pédagogie et méthodes d\'enseignement', 'description' => 'Capacité à transmettre les connaissances de manière claire et efficace', 'ordre' => 1],
            ['nom' => 'Ponctualité et assiduité', 'description' => 'Respect des horaires de cours et présence régulière', 'ordre' => 2],
            ['nom' => 'Disponibilité et accessibilité', 'description' => 'Disponibilité pour répondre aux questions et aider les étudiants', 'ordre' => 3],
            ['nom' => 'Clarté des explications', 'description' => 'Qualité des explications et facilité de compréhension', 'ordre' => 4],
            ['nom' => 'Supports de cours', 'description' => 'Qualité et pertinence des supports pédagogiques fournis', 'ordre' => 5],
            ['nom' => 'Interaction avec les étudiants', 'description' => 'Encouragement de la participation et échanges avec les étudiants', 'ordre' => 6],
            ['nom' => 'Évaluation et feedback', 'description' => 'Qualité des évaluations et pertinence des retours sur les travaux', 'ordre' => 7],
        ];

        foreach ($criteres as $critere) {
            Critere::create($critere);
        }
    }
}
