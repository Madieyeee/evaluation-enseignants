<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::withCount('enseignants', 'filieres')->paginate(10);
        return view('admin.departements.index', compact('departements'));
    }

    public function create()
    {
        return view('admin.departements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:departements,code',
            'description' => 'nullable|string',
        ]);

        Departement::create($request->all());

        return redirect()->route('admin.departements.index')->with('success', 'Département créé avec succès.');
    }

    public function show(Departement $departement)
    {
        $departement->load('enseignants.user', 'filieres');
        return view('admin.departements.show', compact('departement'));
    }

    public function edit(Departement $departement)
    {
        return view('admin.departements.edit', compact('departement'));
    }

    public function update(Request $request, Departement $departement)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:departements,code,' . $departement->id,
            'description' => 'nullable|string',
        ]);

        $departement->update($request->all());

        return redirect()->route('admin.departements.index')->with('success', 'Département mis à jour avec succès.');
    }

    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()->route('admin.departements.index')->with('success', 'Département supprimé avec succès.');
    }
}
