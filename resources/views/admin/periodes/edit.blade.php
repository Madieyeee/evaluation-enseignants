<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Modifier la periode</h2>
            <x-ui.button as="a" href="{{ route('admin.periodes.show', $periode) }}" variant="ghost" size="sm" icon="arrow-left">
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
                <h3 class="text-sm font-semibold text-foreground">Modifier : {{ $periode->nom }}</h3>
            </div>
            <form action="{{ route('admin.periodes.update', $periode) }}" method="POST">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-foreground mb-1.5">Nom <span class="text-danger">*</span></label>
                        <x-ui.input type="text" name="nom" :value="old('nom', $periode->nom)" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Date de debut <span class="text-danger">*</span></label>
                        <x-ui.input type="date" name="date_debut" :value="old('date_debut', $periode->date_debut?->format('Y-m-d'))" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Date de fin <span class="text-danger">*</span></label>
                        <x-ui.input type="date" name="date_fin" :value="old('date_fin', $periode->date_fin?->format('Y-m-d'))" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground mb-1.5">Statut</label>
                        <select name="statut" class="w-full rounded-lg border border-borderColor/60 bg-surface px-3 py-2 text-sm text-foreground focus:border-accent focus:ring-1 focus:ring-accent transition-colors">
                            <option value="inactive" {{ old('statut', $periode->statut) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="active" {{ old('statut', $periode->statut) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="terminee" {{ old('statut', $periode->statut) == 'terminee' ? 'selected' : '' }}>Terminee</option>
                        </select>
                    </div>
                </div>
                <div class="mt-5">
                    <label class="block text-sm font-medium text-foreground mb-1.5">Description</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border border-borderColor/60 bg-surface px-3 py-2 text-sm text-foreground focus:border-accent focus:ring-1 focus:ring-accent transition-colors">{{ old('description', $periode->description) }}</textarea>
                </div>
                <div class="flex items-center gap-3 mt-6 pt-6 border-t border-borderColor/40">
                    <x-ui.button type="submit" variant="primary" icon="save">Enregistrer les modifications</x-ui.button>
                    <x-ui.button as="a" href="{{ route('admin.periodes.show', $periode) }}" variant="ghost">Annuler</x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
</x-app-layout>
