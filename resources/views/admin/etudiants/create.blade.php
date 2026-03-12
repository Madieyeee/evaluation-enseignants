<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Nouvel etudiant</h2>
            <x-ui.button as="a" href="{{ route('admin.etudiants.index') }}" variant="ghost" size="sm" icon="arrow-left">
                Retour a la liste
            </x-ui.button>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if ($errors->any())
            <x-ui.card class="border border-danger/20 bg-danger/5 text-danger text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-ui.card>
        @endif

        <x-ui.card>
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-foreground">Compte utilisateur</h3>
                <p class="text-xs text-muted mt-1">Ces informations serviront a la connexion de l'etudiant.</p>
            </div>

            <form action="{{ route('admin.etudiants.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Nom complet <span class="text-danger">*</span></label>
                        <x-ui.input type="text" name="name" :value="old('name')" placeholder="Ex: Fatou Ndiaye" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Email <span class="text-danger">*</span></label>
                        <x-ui.input type="email" name="email" :value="old('email')" placeholder="Ex: fatou.ndiaye@etud.univ.sn" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Mot de passe <span class="text-danger">*</span></label>
                        <x-ui.input type="password" name="password" placeholder="Min. 8 caracteres" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Confirmer le mot de passe <span class="text-danger">*</span></label>
                        <x-ui.input type="password" name="password_confirmation" placeholder="Repeter le mot de passe" required />
                    </div>
                </div>

                <div class="border-t border-borderColor/40 mt-6 pt-6 mb-6">
                    <h3 class="text-sm font-semibold text-foreground">Informations academiques</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Matricule <span class="text-danger">*</span></label>
                        <x-ui.input type="text" name="matricule" :value="old('matricule')" placeholder="Ex: ETU2024001" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Filiere</label>
                        <select name="filiere_id" class="w-full rounded-lg border border-borderColor/60 bg-surface px-3 py-2 text-sm text-foreground focus:border-accent focus:ring-1 focus:ring-accent transition-colors">
                            <option value="">-- Selectionner --</option>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>{{ $filiere->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Niveau</label>
                        <select name="niveau" class="w-full rounded-lg border border-borderColor/60 bg-surface px-3 py-2 text-sm text-foreground focus:border-accent focus:ring-1 focus:ring-accent transition-colors">
                            <option value="">-- Selectionner --</option>
                            @foreach(['L1','L2','L3','M1','M2'] as $niv)
                                <option value="{{ $niv }}" {{ old('niveau') == $niv ? 'selected' : '' }}>{{ $niv }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-6 pt-6 border-t border-borderColor/40">
                    <x-ui.button type="submit" variant="primary" icon="save">Enregistrer</x-ui.button>
                    <x-ui.button as="a" href="{{ route('admin.etudiants.index') }}" variant="ghost">Annuler</x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
</x-app-layout>
