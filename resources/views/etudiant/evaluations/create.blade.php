<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Evaluer un enseignant</h2>
            <x-ui.button as="a" href="{{ route('etudiant.evaluations.index') }}" variant="ghost" size="sm" icon="arrow-left">
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
                <h3 class="text-sm font-semibold text-foreground">{{ $enseignant->user->name }}</h3>
                <p class="text-xs text-muted mt-1">Matiere : {{ $matiere->nom }}</p>
            </div>

            <form action="{{ route('etudiant.evaluations.store', [$enseignant, $matiere]) }}" method="POST">
                @csrf
                <div class="space-y-5">
                    @foreach($criteres as $critere)
                    <div class="p-4 rounded-lg border border-borderColor/40 bg-surface-muted/20">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-foreground">{{ $critere->nom }}</p>
                                @if($critere->description)
                                    <p class="text-xs text-muted mt-0.5">{{ $critere->description }}</p>
                                @endif
                            </div>
                            <div class="flex items-center gap-1 shrink-0">
                                @for($i = 1; $i <= 5; $i++)
                                <label class="cursor-pointer">
                                    <input type="radio" name="notes[{{ $critere->id }}]" value="{{ $i }}" class="sr-only peer" {{ old("notes.{$critere->id}") == $i ? 'checked' : '' }} required>
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-borderColor/40 text-sm text-muted peer-checked:bg-accent peer-checked:text-white peer-checked:border-accent hover:border-accent transition-colors">{{ $i }}</span>
                                </label>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-5">
                    <label class="block text-sm font-medium text-foreground mb-1.5">Commentaire (optionnel)</label>
                    <textarea name="commentaire" rows="3" class="w-full rounded-lg border border-borderColor/60 bg-surface px-3 py-2 text-sm text-foreground focus:border-accent focus:ring-1 focus:ring-accent transition-colors" placeholder="Vos remarques sur cet enseignant...">{{ old('commentaire') }}</textarea>
                </div>

                <div class="flex items-center gap-3 mt-6 pt-6 border-t border-borderColor/40">
                    <x-ui.button type="submit" variant="primary" icon="send">Soumettre l'evaluation</x-ui.button>
                    <x-ui.button as="a" href="{{ route('etudiant.evaluations.index') }}" variant="ghost">Annuler</x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
</x-app-layout>
