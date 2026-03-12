<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\Enseignant;
use App\Models\Matiere;
use App\Models\Evaluation;
use App\Models\Note;
use App\Models\Critere;
use App\Models\PeriodeEvaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        $etudiant = auth()->user()->etudiant;
        $periodeActive = PeriodeEvaluation::where('est_active', true)->first();
        
        // Matières que l'étudiant peut évaluer (de sa filière avec enseignant assigné)
        $matieres = Matiere::with(['enseignant.user', 'filiere'])
            ->whereHas('enseignant')
            ->when($etudiant->filiere_id, function ($query) use ($etudiant) {
                $query->where('filiere_id', $etudiant->filiere_id);
            })
            ->get();

        // Évaluations déjà faites par l'étudiant
        $evaluationsFaites = Evaluation::where('etudiant_id', $etudiant->id)
            ->pluck('matiere_id')
            ->toArray();

        // Marquer les matières déjà évaluées
        $matieres->each(function ($matiere) use ($evaluationsFaites) {
            $matiere->dejaEvalue = in_array($matiere->id, $evaluationsFaites);
        });

        return view('etudiant.evaluations.index', compact('matieres', 'periodeActive'));
    }

    public function create(Enseignant $enseignant, Matiere $matiere)
    {
        $etudiant = auth()->user()->etudiant;
        
        // Vérifier si déjà évalué
        $dejaEvalue = Evaluation::where('etudiant_id', $etudiant->id)
            ->where('enseignant_id', $enseignant->id)
            ->where('matiere_id', $matiere->id)
            ->exists();

        if ($dejaEvalue) {
            return redirect()->route('etudiant.evaluations.index')
                ->with('error', 'Vous avez déjà évalué cet enseignant pour cette matière.');
        }

        $criteres = Critere::actifs()->get();
        $periodeActive = PeriodeEvaluation::where('est_active', true)->first();

        return view('etudiant.evaluations.create', compact('enseignant', 'matiere', 'criteres', 'periodeActive'));
    }

    public function store(Request $request, Enseignant $enseignant, Matiere $matiere)
    {
        $etudiant = auth()->user()->etudiant;

        $request->validate([
            'notes' => 'required|array',
            'notes.*' => 'required|integer|min:1|max:5',
            'commentaires' => 'nullable|array',
            'commentaires.*' => 'nullable|string|max:500',
            'commentaire_general' => 'nullable|string|max:1000',
        ]);

        $periodeActive = PeriodeEvaluation::where('est_active', true)->first();

        $evaluation = Evaluation::create([
            'etudiant_id' => $etudiant->id,
            'enseignant_id' => $enseignant->id,
            'matiere_id' => $matiere->id,
            'periode_evaluation_id' => $periodeActive?->id,
            'commentaire_general' => $request->commentaire_general,
        ]);

        foreach ($request->notes as $critereId => $note) {
            Note::create([
                'evaluation_id' => $evaluation->id,
                'critere_id' => $critereId,
                'note' => $note,
                'commentaire' => $request->commentaires[$critereId] ?? null,
            ]);
        }

        return redirect()->route('etudiant.evaluations.index')
            ->with('success', 'Évaluation enregistrée avec succès. Merci pour votre participation !');
    }

    public function historique()
    {
        $etudiant = auth()->user()->etudiant;
        $evaluations = Evaluation::where('etudiant_id', $etudiant->id)
            ->with(['enseignant.user', 'matiere', 'notes.critere'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('etudiant.evaluations.historique', compact('evaluations'));
    }
}
