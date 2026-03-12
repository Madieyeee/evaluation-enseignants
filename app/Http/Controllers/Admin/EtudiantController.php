<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\User;
use App\Models\Filiere;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::with(['user', 'filiere'])->paginate(10);
        return view('admin.etudiants.index', compact('etudiants'));
    }

    public function create()
    {
        $filieres = Filiere::all();
        return view('admin.etudiants.create', compact('filieres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'matricule' => 'required|string|unique:etudiants,matricule',
            'filiere_id' => 'nullable|exists:filieres,id',
            'niveau' => 'nullable|string|max:50',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'etudiant',
            'email_verified_at' => now(),
        ]);

        Etudiant::create([
            'user_id' => $user->id,
            'matricule' => $request->matricule,
            'filiere_id' => $request->filiere_id,
            'niveau' => $request->niveau,
        ]);

        return redirect()->route('admin.etudiants.index')->with('success', 'Étudiant créé avec succès.');
    }

    public function show(Etudiant $etudiant)
    {
        $etudiant->load(['user', 'filiere', 'evaluations.enseignant.user', 'evaluations.matiere']);
        return view('admin.etudiants.show', compact('etudiant'));
    }

    public function edit(Etudiant $etudiant)
    {
        $filieres = Filiere::all();
        return view('admin.etudiants.edit', compact('etudiant', 'filieres'));
    }

    public function update(Request $request, Etudiant $etudiant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $etudiant->user_id,
            'matricule' => 'required|string|unique:etudiants,matricule,' . $etudiant->id,
            'filiere_id' => 'nullable|exists:filieres,id',
            'niveau' => 'nullable|string|max:50',
        ]);

        $etudiant->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $etudiant->update([
            'matricule' => $request->matricule,
            'filiere_id' => $request->filiere_id,
            'niveau' => $request->niveau,
        ]);

        return redirect()->route('admin.etudiants.index')->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function destroy(Etudiant $etudiant)
    {
        $etudiant->user->delete();
        return redirect()->route('admin.etudiants.index')->with('success', 'Étudiant supprimé avec succès.');
    }
}
