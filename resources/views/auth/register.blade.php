<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom complet')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Je suis')" />
            <select name="role" id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required onchange="toggleFields()">
                <option value="">-- Sélectionner --</option>
                <option value="etudiant" {{ old('role') == 'etudiant' ? 'selected' : '' }}>Étudiant</option>
                <option value="enseignant" {{ old('role') == 'enseignant' ? 'selected' : '' }}>Enseignant</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Champs Étudiant -->
        <div id="etudiant-fields" class="hidden">
            <div class="mt-4">
                <x-input-label for="matricule" :value="__('Matricule')" />
                <x-text-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="old('matricule')" />
                <x-input-error :messages="$errors->get('matricule')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="filiere_id" :value="__('Filière')" />
                <select name="filiere_id" id="filiere_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">-- Sélectionner --</option>
                    @foreach($filieres ?? [] as $filiere)
                        <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>{{ $filiere->nom }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('filiere_id')" class="mt-2" />
            </div>
        </div>

        <!-- Champs Enseignant -->
        <div id="enseignant-fields" class="hidden">
            <div class="mt-4">
                <x-input-label for="departement_id" :value="__('Département')" />
                <select name="departement_id" id="departement_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">-- Sélectionner --</option>
                    @foreach($departements ?? [] as $dept)
                        <option value="{{ $dept->id }}" {{ old('departement_id') == $dept->id ? 'selected' : '' }}>{{ $dept->nom }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('departement_id')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="telephone" :value="__('Téléphone')" />
                <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" />
                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Déjà inscrit ?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('S\'inscrire') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function toggleFields() {
            const role = document.getElementById('role').value;
            document.getElementById('etudiant-fields').classList.toggle('hidden', role !== 'etudiant');
            document.getElementById('enseignant-fields').classList.toggle('hidden', role !== 'enseignant');
        }
        // Afficher les champs au chargement si rôle déjà sélectionné
        document.addEventListener('DOMContentLoaded', toggleFields);
    </script>
</x-guest-layout>
