<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Filiere;
use App\Models\Departement;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    public function index()
    {
        $filieres = Filiere::with('departement')->withCount('etudiants', 'matieres')->paginate(10);
        return view('admin.filieres.index', compact('filieres'));
    }

    public function create()
    {
        $departements = Departement::all();
        return view('admin.filieres.create', compact('departements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:filieres,code',
            'departement_id' => 'nullable|exists:departements,id',
            'description' => 'nullable|string',
        ]);

        Filiere::create($request->all());

        return redirect()->route('admin.filieres.index')->with('success', 'Filière créée avec succès.');
    }

    public function show(Filiere $filiere)
    {
        $filiere->load('departement', 'etudiants.user', 'matieres.enseignant.user');
        return view('admin.filieres.show', compact('filiere'));
    }

    public function edit(Filiere $filiere)
    {
        $departements = Departement::all();
        return view('admin.filieres.edit', compact('filiere', 'departements'));
    }

    public function update(Request $request, Filiere $filiere)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:filieres,code,' . $filiere->id,
            'departement_id' => 'nullable|exists:departements,id',
            'description' => 'nullable|string',
        ]);

        $filiere->update($request->all());

        return redirect()->route('admin.filieres.index')->with('success', 'Filière mise à jour avec succès.');
    }

    public function destroy(Filiere $filiere)
    {
        $filiere->delete();
        return redirect()->route('admin.filieres.index')->with('success', 'Filière supprimée avec succès.');
    }
}
