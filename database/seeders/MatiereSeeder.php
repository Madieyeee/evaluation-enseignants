<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matiere;
use App\Models\Filiere;

class MatiereSeeder extends Seeder
{
    public function run(): void
    {
        $filieres = Filiere::all()->keyBy('code');

        $matieres = [
            // Génie Logiciel
            ['code' => 'GL101', 'nom' => 'Algorithmique et Structures de Données', 'filiere_id' => $filieres['GL']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'GL102', 'nom' => 'Programmation Orientée Objet (Java)', 'filiere_id' => $filieres['GL']->id, 'volume_horaire' => 60, 'credits' => 5],
            ['code' => 'GL103', 'nom' => 'Base de Données (MySQL/PostgreSQL)', 'filiere_id' => $filieres['GL']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'GL104', 'nom' => 'Génie Logiciel et Design Patterns', 'filiere_id' => $filieres['GL']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'GL105', 'nom' => 'Développement Web (Laravel/Symfony)', 'filiere_id' => $filieres['GL']->id, 'volume_horaire' => 60, 'credits' => 5],
            ['code' => 'GL106', 'nom' => 'DevOps et CI/CD', 'filiere_id' => $filieres['GL']->id, 'volume_horaire' => 30, 'credits' => 3],

            // Sécurité Réseaux
            ['code' => 'SR101', 'nom' => 'Réseaux Informatiques (Cisco)', 'filiere_id' => $filieres['SR']->id, 'volume_horaire' => 60, 'credits' => 5],
            ['code' => 'SR102', 'nom' => 'Sécurité Informatique', 'filiere_id' => $filieres['SR']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'SR103', 'nom' => 'Ethical Hacking', 'filiere_id' => $filieres['SR']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'SR104', 'nom' => 'Administration Linux/Windows Server', 'filiere_id' => $filieres['SR']->id, 'volume_horaire' => 60, 'credits' => 5],

            // Data Science
            ['code' => 'DS101', 'nom' => 'Python pour Data Science', 'filiere_id' => $filieres['DS']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'DS102', 'nom' => 'Machine Learning', 'filiere_id' => $filieres['DS']->id, 'volume_horaire' => 60, 'credits' => 5],
            ['code' => 'DS103', 'nom' => 'Big Data et Hadoop', 'filiere_id' => $filieres['DS']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'DS104', 'nom' => 'Visualisation de Données', 'filiere_id' => $filieres['DS']->id, 'volume_horaire' => 30, 'credits' => 3],

            // Web Development
            ['code' => 'WD101', 'nom' => 'HTML/CSS/JavaScript', 'filiere_id' => $filieres['WD']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'WD102', 'nom' => 'React.js / Vue.js', 'filiere_id' => $filieres['WD']->id, 'volume_horaire' => 60, 'credits' => 5],
            ['code' => 'WD103', 'nom' => 'Node.js et API REST', 'filiere_id' => $filieres['WD']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'WD104', 'nom' => 'Développement Mobile (React Native)', 'filiere_id' => $filieres['WD']->id, 'volume_horaire' => 45, 'credits' => 4],

            // Management
            ['code' => 'GRH101', 'nom' => 'Gestion des Ressources Humaines', 'filiere_id' => $filieres['GRH']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'GRH102', 'nom' => 'Droit du Travail', 'filiere_id' => $filieres['GRH']->id, 'volume_horaire' => 30, 'credits' => 3],
            ['code' => 'PM101', 'nom' => 'Gestion de Projet (PMP)', 'filiere_id' => $filieres['PM']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'PM102', 'nom' => 'Leadership et Management', 'filiere_id' => $filieres['PM']->id, 'volume_horaire' => 30, 'credits' => 3],

            // Finance
            ['code' => 'CFA101', 'nom' => 'Comptabilité Générale', 'filiere_id' => $filieres['CFA']->id, 'volume_horaire' => 60, 'credits' => 5],
            ['code' => 'CFA102', 'nom' => 'Analyse Financière', 'filiere_id' => $filieres['CFA']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'BF101', 'nom' => 'Marchés Financiers', 'filiere_id' => $filieres['BF']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'BF102', 'nom' => 'Gestion Bancaire', 'filiere_id' => $filieres['BF']->id, 'volume_horaire' => 45, 'credits' => 4],

            // Marketing
            ['code' => 'MKTDIG101', 'nom' => 'Marketing Digital', 'filiere_id' => $filieres['MKTDIG']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'MKTDIG102', 'nom' => 'SEO/SEA et Social Media', 'filiere_id' => $filieres['MKTDIG']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'COM101', 'nom' => 'Communication Corporate', 'filiere_id' => $filieres['COM']->id, 'volume_horaire' => 45, 'credits' => 4],
            ['code' => 'COM102', 'nom' => 'Relations Publiques', 'filiere_id' => $filieres['COM']->id, 'volume_horaire' => 30, 'credits' => 3],
        ];

        foreach ($matieres as $matiere) {
            Matiere::create($matiere);
        }
    }
}
