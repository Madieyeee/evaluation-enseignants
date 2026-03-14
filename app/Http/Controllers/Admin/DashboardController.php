<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enseignant;
use App\Models\Etudiant;
use App\Models\Matiere;
use App\Models\Evaluation;
use App\Models\PeriodeEvaluation;
use App\Models\Departement;
use Illuminate\Http\Request;

/**
 * Tableau de bord administrateur : agrège les indicateurs clés
 * (volumétrie, période active, top enseignants).
 */
class DashboardController extends Controller
{
    /**
     * Contrôleur invocable : route admin.dashboard -> __invoke().
     */
    public function __invoke(Request $request)
    {
        // Statistiques globales pour l'en-tête du dashboard
        $stats = [
            'enseignants' => Enseignant::count(),
            'etudiants' => Etudiant::count(),
            'matieres' => Matiere::count(),
            'evaluations' => Evaluation::count(),
            'departements' => Departement::count(),
        ];

        // Période d'évaluation actuellement marquée comme active
        $periodeActive = PeriodeEvaluation::where('est_active', true)->first();

        // Construction du top 5 des enseignants les mieux notés
        $topEnseignants = Enseignant::with('user', 'departement')
            ->withCount('evaluations')
            ->whereHas('evaluations')
            ->get()
            ->map(function ($enseignant) {
                // moyenne calculée sur le champ "moyenne" des évaluations
                $enseignant->moyenne = $enseignant->evaluations()->avg('moyenne') ?? 0;
                return $enseignant;
            })
            ->sortByDesc('moyenne')
            ->take(5);

        return view('admin.dashboard', compact('stats', 'periodeActive', 'topEnseignants'));
    }
}
