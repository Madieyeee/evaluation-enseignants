<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enseignant;
use App\Models\User;
use App\Models\Departement;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    public function index()
    {
        $enseignants = Enseignant::with(['user', 'departement', 'matieres'])->paginate(10);
        return view('admin.enseignants.index', compact('enseignants'));
    }

    public function create()
    {
        $departements = Departement::all();
        return view('admin.enseignants.create', compact('departements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'departement_id' => 'nullable|exists:departements,id',
            'telephone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'enseignant',
            'email_verified_at' => now(),
        ]);

        Enseignant::create([
            'user_id' => $user->id,
            'departement_id' => $request->departement_id,
            'telephone' => $request->telephone,
            'bio' => $request->bio,
        ]);

        return redirect()->route('admin.enseignants.index')->with('success', 'Enseignant créé avec succès.');
    }

    public function show(Enseignant $enseignant)
    {
        $enseignant->load(['user', 'departement', 'matieres', 'evaluations.etudiant.user']);
        return view('admin.enseignants.show', compact('enseignant'));
    }

    public function edit(Enseignant $enseignant)
    {
        $departements = Departement::all();
        return view('admin.enseignants.edit', compact('enseignant', 'departements'));
    }

    public function update(Request $request, Enseignant $enseignant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $enseignant->user_id,
            'departement_id' => 'nullable|exists:departements,id',
            'telephone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
        ]);

        $enseignant->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $enseignant->update([
            'departement_id' => $request->departement_id,
            'telephone' => $request->telephone,
            'bio' => $request->bio,
        ]);

        return redirect()->route('admin.enseignants.index')->with('success', 'Enseignant mis à jour avec succès.');
    }

    public function destroy(Enseignant $enseignant)
    {
        $enseignant->user->delete();
        return redirect()->route('admin.enseignants.index')->with('success', 'Enseignant supprimé avec succès.');
    }
}
