<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matiere;
use App\Models\Enseignant;
use App\Models\Filiere;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    public function index()
    {
        $matieres = Matiere::with(['enseignant.user', 'filiere'])->withCount('evaluations')->paginate(10);
        return view('admin.matieres.index', compact('matieres'));
    }

    public function create()
    {
        $enseignants = Enseignant::with('user')->get();
        $filieres = Filiere::all();
        return view('admin.matieres.create', compact('enseignants', 'filieres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:matieres,code',
            'description' => 'nullable|string',
            'enseignant_id' => 'nullable|exists:enseignants,id',
            'filiere_id' => 'nullable|exists:filieres,id',
            'volume_horaire' => 'nullable|integer|min:1',
            'credits' => 'nullable|integer|min:1',
        ]);

        Matiere::create($request->all());

        return redirect()->route('admin.matieres.index')->with('success', 'Matière créée avec succès.');
    }

    public function show(Matiere $matiere)
    {
        $matiere->load(['enseignant.user', 'filiere', 'evaluations.etudiant.user']);
        return view('admin.matieres.show', compact('matiere'));
    }

    public function edit(Matiere $matiere)
    {
        $enseignants = Enseignant::with('user')->get();
        $filieres = Filiere::all();
        return view('admin.matieres.edit', compact('matiere', 'enseignants', 'filieres'));
    }

    public function update(Request $request, Matiere $matiere)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:matieres,code,' . $matiere->id,
            'description' => 'nullable|string',
            'enseignant_id' => 'nullable|exists:enseignants,id',
            'filiere_id' => 'nullable|exists:filieres,id',
            'volume_horaire' => 'nullable|integer|min:1',
            'credits' => 'nullable|integer|min:1',
        ]);

        $matiere->update($request->all());

        return redirect()->route('admin.matieres.index')->with('success', 'Matière mise à jour avec succès.');
    }

    public function destroy(Matiere $matiere)
    {
        $matiere->delete();
        return redirect()->route('admin.matieres.index')->with('success', 'Matière supprimée avec succès.');
    }
}
