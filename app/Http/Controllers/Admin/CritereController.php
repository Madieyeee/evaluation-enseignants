<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Critere;
use Illuminate\Http\Request;

class CritereController extends Controller
{
    public function index()
    {
        $criteres = Critere::orderBy('ordre')->paginate(10);
        return view('admin.criteres.index', compact('criteres'));
    }

    public function create()
    {
        return view('admin.criteres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ordre' => 'required|integer|min:1',
            'est_actif' => 'boolean',
        ]);

        Critere::create($request->all());

        return redirect()->route('admin.criteres.index')->with('success', 'Critère créé avec succès.');
    }

    public function show(Critere $critere)
    {
        $critere->load('notes.evaluation.etudiant.user');
        return view('admin.criteres.show', compact('critere'));
    }

    public function edit(Critere $critere)
    {
        return view('admin.criteres.edit', compact('critere'));
    }

    public function update(Request $request, Critere $critere)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ordre' => 'required|integer|min:1',
            'est_actif' => 'boolean',
        ]);

        $critere->update($request->all());

        return redirect()->route('admin.criteres.index')->with('success', 'Critère mis à jour avec succès.');
    }

    public function destroy(Critere $critere)
    {
        $critere->delete();
        return redirect()->route('admin.criteres.index')->with('success', 'Critère supprimé avec succès.');
    }
}
