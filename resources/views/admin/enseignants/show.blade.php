<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Fiche enseignant</h2>
            <div class="flex items-center gap-2">
                <x-ui.button as="a" href="{{ route('admin.enseignants.edit', $enseignant) }}" variant="primary" size="sm" icon="pencil">
                    Modifier
                </x-ui.button>
                <x-ui.button as="a" href="{{ route('admin.enseignants.index') }}" variant="ghost" size="sm" icon="arrow-left">
                    Retour a la liste
                </x-ui.button>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Infos principales --}}
            <x-ui.card class="md:col-span-2 space-y-4">
                <h3 class="text-sm font-semibold text-foreground border-b border-borderColor/40 pb-3">Informations personnelles</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-xs text-muted uppercase tracking-wide mb-1">Nom complet</p>
                        <p class="font-medium text-foreground">{{ $enseignant->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-muted uppercase tracking-wide mb-1">Email</p>
                        <p class="text-foreground">{{ $enseignant->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-muted uppercase tracking-wide mb-1">Telephone</p>
                        <p class="text-foreground">{{ $enseignant->telephone ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-muted uppercase tracking-wide mb-1">Departement</p>
                        <p class="text-foreground">{{ $enseignant->departement?->nom ?? '—' }}</p>
                    </div>
                    @if($enseignant->bio)
                    <div class="sm:col-span-2">
                        <p class="text-xs text-muted uppercase tracking-wide mb-1">Biographie</p>
                        <p class="text-foreground">{{ $enseignant->bio }}</p>
                    </div>
                    @endif
                </div>
            </x-ui.card>

            {{-- Stats --}}
            <div class="space-y-4">
                <x-ui.card class="text-center">
                    <p class="text-3xl font-bold text-foreground">{{ $enseignant->matieres->count() }}</p>
                    <p class="text-xs text-muted mt-1 uppercase tracking-wide">Matieres</p>
                </x-ui.card>
                <x-ui.card class="text-center">
                    <p class="text-3xl font-bold text-foreground">{{ $enseignant->evaluations->count() }}</p>
                    <p class="text-xs text-muted mt-1 uppercase tracking-wide">Evaluations recues</p>
                </x-ui.card>
                <x-ui.card class="text-center">
                    <p class="text-3xl font-bold text-foreground">{{ number_format($enseignant->moyenne, 1) }}<span class="text-base font-normal text-muted">/5</span></p>
                    <p class="text-xs text-muted mt-1 uppercase tracking-wide">Moyenne generale</p>
                </x-ui.card>
            </div>
        </div>

        {{-- Matieres --}}
        @if($enseignant->matieres->count())
        <x-ui.card class="p-0">
            <div class="px-4 py-3 border-b border-borderColor/40">
                <h3 class="text-sm font-semibold text-foreground">Matieres enseignees</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-surface-muted/60 text-xs uppercase tracking-wide text-muted">
                        <tr>
                            <th class="px-4 py-3 text-left">Code</th>
                            <th class="px-4 py-3 text-left">Nom</th>
                            <th class="px-4 py-3 text-left">Filiere</th>
                            <th class="px-4 py-3 text-left">Volume horaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enseignant->matieres as $matiere)
                        <tr class="border-t border-borderColor/30 hover:bg-surface-muted/30 transition-colors">
                            <td class="px-4 py-3 font-mono text-xs text-muted">{{ $matiere->code }}</td>
                            <td class="px-4 py-3 font-medium text-foreground">{{ $matiere->nom }}</td>
                            <td class="px-4 py-3 text-muted">{{ $matiere->filiere?->nom ?? '—' }}</td>
                            <td class="px-4 py-3 text-muted">{{ $matiere->volume_horaire ? $matiere->volume_horaire.'h' : '—' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.card>
        @endif

        {{-- Zone danger --}}
        <x-ui.card class="border border-danger/20">
            <h3 class="text-sm font-semibold text-danger mb-3">Zone de danger</h3>
            <p class="text-xs text-muted mb-4">La suppression de cet enseignant est irreversible et entraine la suppression de son compte utilisateur.</p>
            <form action="{{ route('admin.enseignants.destroy', $enseignant) }}" method="POST" onsubmit="return confirm('Supprimer definitivement cet enseignant ?')">
                @csrf @method('DELETE')
                <x-ui.button type="submit" variant="ghost" size="sm" icon="trash-2" class="text-danger hover:bg-danger/10 border border-danger/30">
                    Supprimer cet enseignant
                </x-ui.button>
            </form>
        </x-ui.card>
    </div>
</x-app-layout>
