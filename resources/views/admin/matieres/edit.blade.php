<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Modifier la matiere</h2>
            <x-ui.button as="a" href="{{ route('admin.matieres.show', $matiere) }}" variant="ghost" size="sm" icon="arrow-left">
                Retour
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
                <h3 class="text-sm font-semibold text-foreground">Modifier : {{ $matiere->nom }}</h3>
            </div>
            <form action="{{ route('admin.matieres.update', $matiere) }}" method="POST">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Code</label>
                        <x-ui.input type="text" name="code" :value="old('code', $matiere->code)" placeholder="Ex: INF301" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Nom</label>
                        <x-ui.input type="text" name="nom" :value="old('nom', $matiere->nom)" placeholder="Ex: Algorithmique avancee" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Enseignant</label>
                        <select name="enseignant_id" class="w-full rounded-lg border border-borderColor/60 bg-surface px-3 py-2 text-sm text-foreground focus:border-accent focus:ring-1 focus:ring-accent transition-colors">
                            <option value="">-- Selectionner --</option>
                            @foreach($enseignants as $enseignant)
                                <option value="{{ $enseignant->id }}" {{ old('enseignant_id', $matiere->enseignant_id) == $enseignant->id ? 'selected' : '' }}>{{ $enseignant->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Filiere</label>
                        <select name="filiere_id" class="w-full rounded-lg border border-borderColor/60 bg-surface px-3 py-2 text-sm text-foreground focus:border-accent focus:ring-1 focus:ring-accent transition-colors">
                            <option value="">-- Selectionner --</option>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id }}" {{ old('filiere_id', $matiere->filiere_id) == $filiere->id ? 'selected' : '' }}>{{ $filiere->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Volume horaire</label>
                        <x-ui.input type="number" name="volume_horaire" :value="old('volume_horaire', $matiere->volume_horaire)" min="1" placeholder="Ex: 40" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Credits</label>
                        <x-ui.input type="number" name="credits" :value="old('credits', $matiere->credits)" min="1" placeholder="Ex: 3" />
                    </div>
                </div>
                <div class="mt-5">
                    <label class="block text-sm font-medium text-foreground mb-1.5">Description</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border border-borderColor/60 bg-surface px-3 py-2 text-sm text-foreground focus:border-accent focus:ring-1 focus:ring-accent transition-colors">{{ old('description', $matiere->description) }}</textarea>
                </div>
                <div class="flex items-center gap-3 mt-6 pt-6 border-t border-borderColor/40">
                    <x-ui.button type="submit" variant="primary" icon="save">Enregistrer les modifications</x-ui.button>
                    <x-ui.button as="a" href="{{ route('admin.matieres.show', $matiere) }}" variant="ghost">Annuler</x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
</x-app-layout>
