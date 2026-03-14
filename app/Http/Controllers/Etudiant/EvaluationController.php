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

/**
 * Flux métier côté étudiant pour créer et consulter ses évaluations.
 */
class EvaluationController extends Controller
{
    /**
     * Liste les matières que l'étudiant peut évaluer pour la période active.
     */
    public function index()
    {
        $etudiant = auth()->user()->etudiant;
        $periodeActive = PeriodeEvaluation::where('est_active', true)->first();

        // Matières de la filière de l'étudiant avec un enseignant assigné
        $matieres = Matiere::with(['enseignant.user', 'filiere'])
            ->whereHas('enseignant')
            ->when($etudiant->filiere_id, function ($query) use ($etudiant) {
                $query->where('filiere_id', $etudiant->filiere_id);
            })
            ->get();

        // Identifiants des matières déjà évaluées par cet étudiant
        $evaluationsFaites = Evaluation::where('etudiant_id', $etudiant->id)
            ->pluck('matiere_id')
            ->toArray();

        // Flag "dejaEvalue" pour l'affichage dans la vue
        $matieres->each(function ($matiere) use ($evaluationsFaites) {
            $matiere->dejaEvalue = in_array($matiere->id, $evaluationsFaites);
        });

        return view('etudiant.evaluations.index', compact('matieres', 'periodeActive'));
    }

    /**
     * Affiche le formulaire d'évaluation pour un couple enseignant/matière.
     */
    public function create(Enseignant $enseignant, Matiere $matiere)
    {
        $etudiant = auth()->user()->etudiant;

        // Empêcher la création d'une évaluation en double pour ce triplet (étudiant, enseignant, matière)
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

    /**
     * Enregistre une nouvelle évaluation et les notes par critère.
     */
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

        // Création de l'en-tête d'évaluation
        $evaluation = Evaluation::create([
            'etudiant_id' => $etudiant->id,
            'enseignant_id' => $enseignant->id,
            'matiere_id' => $matiere->id,
            'periode_evaluation_id' => $periodeActive?->id,
            'commentaire_general' => $request->commentaire_general,
        ]);

        // Création des notes pour chaque critère sélectionné
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

    /**
     * Historique paginé des évaluations réalisées par l'étudiant.
     */
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
