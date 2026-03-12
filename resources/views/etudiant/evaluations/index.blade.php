<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Evaluer un enseignant</h2>
            <x-ui.button as="a" href="{{ route('etudiant.dashboard') }}" variant="ghost" size="sm" icon="arrow-left">
                Retour au tableau de bord
            </x-ui.button>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <x-ui.card class="border border-success/20 bg-success/5 text-success text-sm">
                {{ session('success') }}
            </x-ui.card>
        @endif

        @if(session('error'))
            <x-ui.card class="border border-danger/20 bg-danger/5 text-danger text-sm">
                {{ session('error') }}
            </x-ui.card>
        @endif

        <x-ui.card class="p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-surface-muted/60 text-xs uppercase tracking-wide text-muted">
                        <tr>
                            <th class="px-4 py-3 text-left">Enseignant</th>
                            <th class="px-4 py-3 text-left">Matiere</th>
                            <th class="px-4 py-3 text-left">Filiere</th>
                            <th class="px-4 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($matieres as $matiere)
                            <tr class="border-t border-borderColor/30 hover:bg-surface-muted/30 transition-colors">
                                <td class="px-4 py-3 font-medium text-foreground">{{ $matiere->enseignant?->user?->name ?? '—' }}</td>
                                <td class="px-4 py-3 text-muted">{{ $matiere->nom }}</td>
                                <td class="px-4 py-3 text-muted">{{ $matiere->filiere?->nom ?? '—' }}</td>
                                <td class="px-4 py-3 text-right">
                                    @if($matiere->dejaEvalue)
                                        <span class="text-xs text-success font-medium">Deja evalue</span>
                                    @else
                                        <x-ui.button as="a" href="{{ route('etudiant.evaluations.create', [$matiere->enseignant, $matiere]) }}" variant="primary" size="xs" icon="star">
                                            Evaluer
                                        </x-ui.button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-muted text-sm">Aucune matiere disponible pour evaluation.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    </div>
</x-app-layout>
