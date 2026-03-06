<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Enseignant;
use App\Models\Filiere;
use App\Models\Departement;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $filieres = Filiere::all();
        $departements = Departement::all();
        return view('auth.register', compact('filieres', 'departements'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:etudiant,enseignant'],
            'matricule' => ['required_if:role,etudiant', 'string', 'max:50', 'unique:etudiants,matricule'],
            'filiere_id' => ['nullable', 'exists:filieres,id'],
            'departement_id' => ['nullable', 'exists:departements,id'],
            'telephone' => ['nullable', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Créer le profil correspondant selon le rôle
        if ($request->role === 'etudiant') {
            Etudiant::create([
                'user_id' => $user->id,
                'matricule' => $request->matricule,
                'filiere_id' => $request->filiere_id,
            ]);
        } elseif ($request->role === 'enseignant') {
            Enseignant::create([
                'user_id' => $user->id,
                'departement_id' => $request->departement_id,
                'telephone' => $request->telephone,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
