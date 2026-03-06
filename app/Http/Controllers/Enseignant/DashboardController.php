<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $enseignant = auth()->user()->enseignant;
        $enseignant->load(['matieres', 'evaluations.notes.critere']);
        
        $evaluations = $enseignant->evaluations()->with(['etudiant.user', 'matiere', 'notes.critere'])->paginate(10);
        
        $moyenneParCritere = [];
        $criteres = \App\Models\Critere::actifs()->get();
        
        foreach ($criteres as $critere) {
            $moyenneParCritere[$critere->nom] = \App\Models\Note::whereHas('evaluation', function ($q) use ($enseignant) {
                $q->where('enseignant_id', $enseignant->id);
            })->where('critere_id', $critere->id)->avg('note') ?? 0;
        }

        return view('enseignant.dashboard', compact('enseignant', 'evaluations', 'moyenneParCritere'));
    }
}
