<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Filiere;
use App\Models\Departement;

class FiliereSeeder extends Seeder
{
    public function run(): void
    {
        $informatique = Departement::where('code', 'INFO')->first();
        $management = Departement::where('code', 'MGT')->first();
        $finance = Departement::where('code', 'FIN')->first();
        $marketing = Departement::where('code', 'MARK')->first();

        $filieres = [
            // Filières Informatique - ISI Dakar
            ['code' => 'GL', 'nom' => 'Génie Logiciel', 'departement_id' => $informatique->id, 'description' => 'Développement d\'applications et systèmes logiciels'],
            ['code' => 'SR', 'nom' => 'Sécurité Réseaux', 'departement_id' => $informatique->id, 'description' => 'Cybersécurité et administration réseaux'],
            ['code' => 'DS', 'nom' => 'Data Science', 'departement_id' => $informatique->id, 'description' => 'Analyse de données et Intelligence Artificielle'],
            ['code' => 'TI', 'nom' => 'Technologies de l\'Information', 'departement_id' => $informatique->id, 'description' => 'Infrastructure IT et systèmes d\'information'],
            ['code' => 'WD', 'nom' => 'Web Development', 'departement_id' => $informatique->id, 'description' => 'Développement Web et Mobile'],
            
            // Filières Management
            ['code' => 'GRH', 'nom' => 'Gestion des Ressources Humaines', 'departement_id' => $management->id, 'description' => 'Management des ressources humaines'],
            ['code' => 'PM', 'nom' => 'Project Management', 'departement_id' => $management->id, 'description' => 'Gestion de projets et management stratégique'],
            
            // Filières Finance
            ['code' => 'CFA', 'nom' => 'Comptabilité et Finance', 'departement_id' => $finance->id, 'description' => 'Comptabilité générale et finance d\'entreprise'],
            ['code' => 'BF', 'nom' => 'Banque et Finance', 'departement_id' => $finance->id, 'description' => 'Secteur bancaire et marchés financiers'],
            
            // Filières Marketing
            ['code' => 'MKTDIG', 'nom' => 'Marketing Digital', 'departement_id' => $marketing->id, 'description' => 'Marketing en ligne et communication digitale'],
            ['code' => 'COM', 'nom' => 'Communication', 'departement_id' => $marketing->id, 'description' => 'Communication corporate et relations publiques'],
        ];

        foreach ($filieres as $filiere) {
            Filiere::create($filiere);
        }
    }
}
