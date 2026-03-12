<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Evaluer les enseignants</h2>
            <x-ui.button as="a" href="{{ route('etudiant.dashboard') }}" variant="ghost" size="sm" icon="arrow-left">Retour au tableau de bord</x-ui.button>
        </div>
    </x-slot>
    <div class="space-y-6">
        @if(session('error'))
            <x-ui.card class="border border-danger/20 bg-danger/5 text-danger text-sm">{{ session('error') }}</x-ui.card>
        @endif
        @if(!$periodeActive)
            <x-ui.card class="border border-warning/20 bg-warning/5 text-warning text-sm">
                <div class="flex items-center gap-2">
                    <x-ui.icon name="alert-triangle" class="h-4 w-4" />
                    Aucune periode d'evaluation n'est actuellement active. Veuillez patienter.
                </div>
            </x-ui.card>
        @else
            <x-ui.card class="border border-success/20 bg-success/5 text-success text-sm">
                <div class="flex items-center gap-2">
                    <x-ui.icon name="calendar-range" class="h-4 w-4" />
                    Periode active : <strong>{{ $periodeActive->nom }}</strong>
                    ({{ $periodeActive->date_debut->format('d/m/Y') }} - {{ $periodeActive->date_fin->format('d/m/Y') }})
                </div>
            </x-ui.card>
        @endif
        <x-ui.card class="p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-surface-muted/60 text-xs uppercase tracking-wide text-muted">
                        <tr>
                            <th class="px-4 py-3 text-left">Enseignant</th>
                            <th class="px-4 py-3 text-left">Matiere</th>
                            <th class="px-4 py-3 text-left">Statut</th>
                            <th class="px-4 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enseignants as $enseignant)
                            @foreach($enseignant->matieres as $matiere)
                                @php
                                    $key = $enseignant->id . '_' . $matiere->id;
                                    $dejaEvalue = isset($evaluationsFaites[$key]);
                                @endphp
                                <tr class="border-t border-borderColor/30 hover:bg-surface-muted/30 transition-colors">
                                    <td class="px-4 py-3 font-medium text-foreground">{{ $enseignant->user->name }}</td>
                                    <td class="px-4 py-3 text-muted">{{ $matiere->nom }}</td>
                                    <td class="px-4 py-3">
                                        @if($dejaEvalue)
                                            <span class="inline-flex items-center rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">Evalue</span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-warning/10 px-2 py-0.5 text-xs font-medium text-warning">A evaluer</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        @if($periodeActive && !$dejaEvalue)
                                            <x-ui.button as="a" href="{{ route('etudiant.evaluations.create', [$enseignant, $matiere]) }}" variant="primary" size="xs" icon="clipboard-check">Evaluer</x-ui.button>
                                        @elseif($dejaEvalue)
                                            <span class="text-xs text-muted">Deja evalue</span>
                                        @else
                                            <span class="text-xs text-muted">Periode fermee</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    </div>
</x-app-layout>
