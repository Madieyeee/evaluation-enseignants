<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Nouvelle filiere</h2>
            <x-ui.button as="a" href="{{ route('admin.filieres.index') }}" variant="ghost" size="sm" icon="arrow-left">
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
                <h3 class="text-sm font-semibold text-foreground">Informations de la filiere</h3>
            </div>
            <form action="{{ route('admin.filieres.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Code <span class="text-danger">*</span></label>
                        <x-ui.input type="text" name="code" :value="old('code')" placeholder="Ex: INFO" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Nom <span class="text-danger">*</span></label>
                        <x-ui.input type="text" name="nom" :value="old('nom')" placeholder="Ex: Informatique" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Departement</label>
                        <select name="departement_id" class="w-full rounded-lg border border-borderColor/60 bg-surface px-3 py-2 text-sm text-foreground focus:border-accent focus:ring-1 focus:ring-accent transition-colors">
                            <option value="">-- Selectionner --</option>
                            @foreach($departements as $departement)
                                <option value="{{ $departement->id }}" {{ old('departement_id') == $departement->id ? 'selected' : '' }}>{{ $departement->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-5">
                    <label class="block text-sm font-medium text-foreground mb-1.5">Description</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border border-borderColor/60 bg-surface px-3 py-2 text-sm text-foreground focus:border-accent focus:ring-1 focus:ring-accent transition-colors" placeholder="Description de la filiere...">{{ old('description') }}</textarea>
                </div>
                <div class="flex items-center gap-3 mt-6 pt-6 border-t border-borderColor/40">
                    <x-ui.button type="submit" variant="primary" icon="save">Enregistrer</x-ui.button>
                    <x-ui.button as="a" href="{{ route('admin.filieres.index') }}" variant="ghost">Annuler</x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
</x-app-layout>
