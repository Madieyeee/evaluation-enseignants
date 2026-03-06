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

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $stats = [
            'enseignants' => Enseignant::count(),
            'etudiants' => Etudiant::count(),
            'matieres' => Matiere::count(),
            'evaluations' => Evaluation::count(),
            'departements' => Departement::count(),
        ];

        $periodeActive = PeriodeEvaluation::where('est_active', true)->first();
        
        $topEnseignants = Enseignant::with('user', 'departement')
            ->withCount('evaluations')
            ->whereHas('evaluations')
            ->get()
            ->map(function ($enseignant) {
                $enseignant->moyenne = $enseignant->evaluations()->avg('moyenne') ?? 0;
                return $enseignant;
            })
            ->sortByDesc('moyenne')
            ->take(5);

        return view('admin.dashboard', compact('stats', 'periodeActive', 'topEnseignants'));
    }
}
