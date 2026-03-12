<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Fiche etudiant</h2>
            <div class="flex items-center gap-2">
                <x-ui.button as="a" href="{{ route('admin.etudiants.edit', $etudiant) }}" variant="primary" size="sm" icon="pencil">
                    Modifier
                </x-ui.button>
                <x-ui.button as="a" href="{{ route('admin.etudiants.index') }}" variant="ghost" size="sm" icon="arrow-left">
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
                        <p class="font-medium text-foreground">{{ $etudiant->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-muted uppercase tracking-wide mb-1">Email</p>
                        <p class="text-foreground">{{ $etudiant->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-muted uppercase tracking-wide mb-1">Matricule</p>
                        <p class="font-mono text-foreground">{{ $etudiant->matricule }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-muted uppercase tracking-wide mb-1">Filiere</p>
                        <p class="text-foreground">{{ $etudiant->filiere?->nom ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-muted uppercase tracking-wide mb-1">Niveau</p>
                        <p class="text-foreground">{{ $etudiant->niveau ?? '—' }}</p>
                    </div>
                </div>
            </x-ui.card>

            {{-- Stats --}}
            <div class="space-y-4">
                <x-ui.card class="text-center">
                    <p class="text-3xl font-bold text-foreground">{{ $etudiant->evaluations->count() }}</p>
                    <p class="text-xs text-muted mt-1 uppercase tracking-wide">Evaluations soumises</p>
                </x-ui.card>
            </div>
        </div>

        {{-- Historique evaluations --}}
        @if($etudiant->evaluations->count())
        <x-ui.card class="p-0">
            <div class="px-4 py-3 border-b border-borderColor/40">
                <h3 class="text-sm font-semibold text-foreground">Evaluations soumises</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-surface-muted/60 text-xs uppercase tracking-wide text-muted">
                        <tr>
                            <th class="px-4 py-3 text-left">Enseignant</th>
                            <th class="px-4 py-3 text-left">Matiere</th>
                            <th class="px-4 py-3 text-left">Moyenne</th>
                            <th class="px-4 py-3 text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etudiant->evaluations as $evaluation)
                        <tr class="border-t border-borderColor/30 hover:bg-surface-muted/30 transition-colors">
                            <td class="px-4 py-3 font-medium text-foreground">{{ $evaluation->enseignant?->user?->name ?? '—' }}</td>
                            <td class="px-4 py-3 text-muted">{{ $evaluation->matiere?->nom ?? '—' }}</td>
                            <td class="px-4 py-3 text-muted">{{ number_format($evaluation->moyenne, 1) }}/5</td>
                            <td class="px-4 py-3 text-muted">{{ $evaluation->created_at->format('d/m/Y') }}</td>
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
            <p class="text-xs text-muted mb-4">La suppression de cet etudiant est irreversible et entraine la suppression de son compte utilisateur.</p>
            <form action="{{ route('admin.etudiants.destroy', $etudiant) }}" method="POST" onsubmit="return confirm('Supprimer definitivement cet etudiant ?')">
                @csrf @method('DELETE')
                <x-ui.button type="submit" variant="ghost" size="sm" icon="trash-2" class="text-danger hover:bg-danger/10 border border-danger/30">
                    Supprimer cet etudiant
                </x-ui.button>
            </form>
        </x-ui.card>
    </div>
</x-app-layout>
