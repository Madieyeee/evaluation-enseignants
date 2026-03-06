<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeriodeEvaluation;
use Illuminate\Http\Request;

class PeriodeEvaluationController extends Controller
{
    public function index()
    {
        $periodes = PeriodeEvaluation::orderBy('date_debut', 'desc')->paginate(10);
        return view('admin.periodes.index', compact('periodes'));
    }

    public function create()
    {
        return view('admin.periodes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'est_active' => 'boolean',
        ]);

        // Désactiver les autres périodes si celle-ci est active
        if ($request->est_active) {
            PeriodeEvaluation::where('est_active', true)->update(['est_active' => false]);
        }

        PeriodeEvaluation::create($request->all());

        return redirect()->route('admin.periodes.index')->with('success', 'Période d\'évaluation créée avec succès.');
    }

    public function show(PeriodeEvaluation $periode)
    {
        $periode->load('evaluations.etudiant.user', 'evaluations.enseignant.user');
        return view('admin.periodes.show', compact('periode'));
    }

    public function edit(PeriodeEvaluation $periode)
    {
        return view('admin.periodes.edit', compact('periode'));
    }

    public function update(Request $request, PeriodeEvaluation $periode)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'est_active' => 'boolean',
        ]);

        if ($request->est_active && !$periode->est_active) {
            PeriodeEvaluation::where('est_active', true)->update(['est_active' => false]);
        }

        $periode->update($request->all());

        return redirect()->route('admin.periodes.index')->with('success', 'Période d\'évaluation mise à jour avec succès.');
    }

    public function destroy(PeriodeEvaluation $periode)
    {
        $periode->delete();
        return redirect()->route('admin.periodes.index')->with('success', 'Période d\'évaluation supprimée avec succès.');
    }
}
