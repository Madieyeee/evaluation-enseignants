<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeriodeEvaluation;
use Illuminate\Http\Request;

/**
 * Gestion CRUD des périodes d'évaluation côté administrateur.
 */
class PeriodeEvaluationController extends Controller
{
    /**
     * Liste paginée des périodes d'évaluation.
     */
    public function index()
    {
        $periodes = PeriodeEvaluation::orderBy('date_debut', 'desc')->paginate(10);

        return view('admin.periodes.index', compact('periodes'));
    }

    /**
     * Formulaire de création d'une nouvelle période.
     */
    public function create()
    {
        return view('admin.periodes.create');
    }

    /**
     * Enregistre une nouvelle période et gère l'unicité de la période active.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'est_active' => 'boolean',
        ]);

        // Si une nouvelle période est déclarée active, désactiver toutes les autres
        if ($request->est_active) {
            PeriodeEvaluation::where('est_active', true)->update(['est_active' => false]);
        }

        PeriodeEvaluation::create($request->all());

        return redirect()->route('admin.periodes.index')->with('success', 'Période d\'évaluation créée avec succès.');
    }

    /**
     * Détail d'une période avec les évaluations associées.
     */
    public function show(PeriodeEvaluation $periode)
    {
        // Chargement eager des évaluations et des utilisateurs liés pour les tableaux de synthèse
        $periode->load('evaluations.etudiant.user', 'evaluations.enseignant.user');

        return view('admin.periodes.show', compact('periode'));
    }

    /**
     * Formulaire d'édition d'une période.
     */
    public function edit(PeriodeEvaluation $periode)
    {
        return view('admin.periodes.edit', compact('periode'));
    }

    /**
     * Met à jour une période existante, en s'assurant qu'une seule
     * période soit active à la fois.
     */
    public function update(Request $request, PeriodeEvaluation $periode)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'est_active' => 'boolean',
        ]);

        // Si on active cette période alors qu'elle était inactive,
        // désactiver les autres périodes actives
        if ($request->est_active && ! $periode->est_active) {
            PeriodeEvaluation::where('est_active', true)->update(['est_active' => false]);
        }

        $periode->update($request->all());

        return redirect()->route('admin.periodes.index')->with('success', 'Période d\'évaluation mise à jour avec succès.');
    }

    /**
     * Suppression d'une période (et potentiellement des évaluations associées
     * via contraintes de base de données).
     */
    public function destroy(PeriodeEvaluation $periode)
    {
        $periode->delete();

        return redirect()->route('admin.periodes.index')->with('success', 'Période d\'évaluation supprimée avec succès.');
    }
}
