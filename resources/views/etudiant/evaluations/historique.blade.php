<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Mes evaluations</h2>
            <x-ui.button as="a" href="{{ route('etudiant.dashboard') }}" variant="ghost" size="sm" icon="arrow-left">
                Retour au tableau de bord
            </x-ui.button>
        </div>
    </x-slot>

    <div class="space-y-6">
        <x-ui.card class="p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-surface-muted/60 text-xs uppercase tracking-wide text-muted">
                        <tr>
                            <th class="px-4 py-3 text-left">Enseignant</th>
                            <th class="px-4 py-3 text-left">Matiere</th>
                            <th class="px-4 py-3 text-left">Moyenne</th>
                            <th class="px-4 py-3 text-left">Commentaire</th>
                            <th class="px-4 py-3 text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($evaluations as $evaluation)
                            <tr class="border-t border-borderColor/30 hover:bg-surface-muted/30 transition-colors">
                                <td class="px-4 py-3 font-medium text-foreground">{{ $evaluation->enseignant?->user?->name ?? '—' }}</td>
                                <td class="px-4 py-3 text-muted">{{ $evaluation->matiere?->nom ?? '—' }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-accent/10 text-accent">
                                        {{ number_format($evaluation->moyenne, 1) }}/5
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-muted">{{ $evaluation->commentaire ? Str::limit($evaluation->commentaire, 50) : '—' }}</td>
                                <td class="px-4 py-3 text-muted">{{ $evaluation->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-muted text-sm">Vous n'avez pas encore soumis d'evaluation.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    </div>
</x-app-layout>
