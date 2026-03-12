<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Mes evaluations</h2>
            <x-ui.button as="a" href="{{ route('etudiant.dashboard') }}" variant="ghost" size="sm" icon="arrow-left">Retour au tableau de bord</x-ui.button>
        </div>
    </x-slot>
    <div class="space-y-6">
        @if($evaluations->count() > 0)
            @foreach($evaluations as $evaluation)
                <x-ui.card>
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-sm font-semibold text-foreground">{{ $evaluation->enseignant->user->name }}</h3>
                            <p class="text-xs text-muted">{{ $evaluation->matiere->nom }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-muted">{{ $evaluation->created_at->format('d/m/Y') }}</p>
                            <p class="text-lg font-bold {{ $evaluation->moyenne >= 4 ? 'text-success' : ($evaluation->moyenne >= 3 ? 'text-warning' : 'text-danger') }}">
                                {{ number_format($evaluation->moyenne, 2) }}/5
                            </p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @foreach($evaluation->notes as $note)
                            <div class="rounded-lg bg-surface-muted/50 p-3">
                                <p class="text-xs text-muted">{{ $note->critere->nom }}</p>
                                <p class="text-sm font-bold text-foreground">{{ $note->note }}/5</p>
                            </div>
                        @endforeach
                    </div>
                    @if($evaluation->commentaire_general)
                        <p class="mt-4 text-sm text-muted italic border-t border-borderColor/30 pt-3">"{{ $evaluation->commentaire_general }}"</p>
                    @endif
                </x-ui.card>
            @endforeach
            @if($evaluations->hasPages())
                <div class="mt-4">{{ $evaluations->links() }}</div>
            @endif
        @else
            <x-ui.card class="text-center py-8">
                <p class="text-sm text-muted mb-4">Vous n'avez pas encore effectue d'evaluation.</p>
                <x-ui.button as="a" href="{{ route('etudiant.evaluations.index') }}" variant="primary" icon="clipboard-check">Commencer a evaluer</x-ui.button>
            </x-ui.card>
        @endif
    </div>
</x-app-layout>
