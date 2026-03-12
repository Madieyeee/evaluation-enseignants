<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Modifier le critere</h2>
            <x-ui.button as="a" href="{{ route('admin.criteres.index') }}" variant="ghost" size="sm" icon="arrow-left">Retour a la liste</x-ui.button>
        </div>
    </x-slot>
    <div class="space-y-6">
        @if ($errors->any())
            <x-ui.card class="border border-danger/20 bg-danger/5 text-danger text-sm">
                <ul class="list-disc list-inside space-y-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </x-ui.card>
        @endif
        <x-ui.card>
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-foreground">Modifier {{ $critere->nom }}</h3>
            </div>
            <form action="{{ route('admin.criteres.update', $critere) }}" method="POST">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Nom du critere</label>
                        <x-ui.input type="text" name="nom" :value="old('nom', $critere->nom)" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Ordre d'affichage</label>
                        <x-ui.input type="number" name="ordre" :value="old('ordre', $critere->ordre)" min="1" required />
                    </div>
                </div>
                <div class="mt-5">
                    <label class="block text-sm font-medium text-foreground mb-1.5">Description</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border border-borderColor/60 bg-surface px-3 py-2 text-sm text-foreground focus:border-accent focus:ring-1 focus:ring-accent transition-colors">{{ old('description', $critere->description) }}</textarea>
                </div>
                <div class="mt-5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="est_actif" value="1" class="rounded border-borderColor/60 text-accent focus:ring-accent" {{ old('est_actif', $critere->est_actif) ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-foreground">Critere actif</span>
                    </label>
                </div>
                <div class="flex items-center gap-3 mt-6 pt-6 border-t border-borderColor/40">
                    <x-ui.button type="submit" variant="primary" icon="save">Enregistrer</x-ui.button>
                    <x-ui.button as="a" href="{{ route('admin.criteres.index') }}" variant="ghost">Annuler</x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
</x-app-layout>
