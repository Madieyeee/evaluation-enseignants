<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Evaluer {{ $enseignant->user->name }}</h2>
            <x-ui.button as="a" href="{{ route('etudiant.evaluations.index') }}" variant="ghost" size="sm" icon="arrow-left">Retour a la liste</x-ui.button>
        </div>
    </x-slot>
    <div class="space-y-6">
        @if ($errors->any())
            <x-ui.card class="border border-danger/20 bg-danger/5 text-danger text-sm">
                <ul class="list-disc list-inside space-y-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </x-ui.card>
        @endif
        <x-ui.card>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-muted">Matiere</p>
                    <p class="text-sm font-medium text-foreground">{{ $matiere->nom }}</p>
                </div>
                <div>
                    <p class="text-xs text-muted">Enseignant</p>
                    <p class="text-sm font-medium text-foreground">{{ $enseignant->user->name }}</p>
                </div>
            </div>
        </x-ui.card>
        <form action="{{ route('etudiant.evaluations.store', [$enseignant, $matiere]) }}" method="POST">
            @csrf
            <x-ui.card>
                <div class="mb-4">
                    <h3 class="text-sm font-semibold text-foreground">Criteres d'evaluation</h3>
                    <p class="text-xs text-muted">Notez chaque critere de 1 a 5 (1 = Tres insatisfait, 5 = Tres satisfait)</p>
                </div>
                <div class="space-y-6">
                    @foreach($criteres as $critere)
                        <div class="pb-5 border-b border-borderColor/30 last:border-0 last:pb-0">
                            <label class="block text-sm font-medium text-foreground mb-1">{{ $critere->nom }}</label>
                            <p class="text-xs text-muted mb-3">{{ $critere->description }}</p>
                            <div class="flex gap-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="notes[{{ $critere->id }}]" value="{{ $i }}" class="hidden peer" required>
                                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-borderColor/60 text-sm font-medium text-muted transition-all peer-checked:bg-accent peer-checked:text-white peer-checked:border-accent hover:bg-surface-muted">{{ $i }}</span>
                                    </label>
                                @endfor
                            </div>
                            <textarea name="commentaires[{{ $critere->id }}]" placeholder="Commentaire (optionnel)" rows="2" class="mt-3 w-full rounded-lg border border-borderColor/60 bg-surface px-3 py-2 text-sm text-foreground focus:border-accent focus:ring-1 focus:ring-accent transition-colors"></textarea>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6 pt-6 border-t border-borderColor/40">
                    <label class="block text-sm font-medium text-foreground mb-1.5">Commentaire general (optionnel)</label>
                    <textarea name="commentaire_general" rows="3" class="w-full rounded-lg border border-borderColor/60 bg-surface px-3 py-2 text-sm text-foreground focus:border-accent focus:ring-1 focus:ring-accent transition-colors" placeholder="Partagez vos impressions generales..."></textarea>
                </div>
            </x-ui.card>
            <div class="flex items-center gap-3 mt-4">
                <x-ui.button type="submit" variant="primary" icon="send">Soumettre l'evaluation</x-ui.button>
                <x-ui.button as="a" href="{{ route('etudiant.evaluations.index') }}" variant="ghost">Annuler</x-ui.button>
            </div>
        </form>
    </div>
</x-app-layout>
