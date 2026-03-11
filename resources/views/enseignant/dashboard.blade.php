<x-app-layout>
    <x-slot name="header">
        <h2 class="text-sm font-medium text-muted">
            Tableau de bord Enseignant
        </h2>
    </x-slot>

    <div class="space-y-8">
        <x-ui.card class="p-6">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h3 class="text-sm font-semibold text-foreground">
                        Bienvenue, {{ auth()->user()->name }} !
                    </h3>
                    <p class="mt-2 text-sm text-muted">
                        Département :
                        <span class="font-medium text-foreground">
                            {{ $enseignant->departement?->nom ?? 'Non assigné' }}
                        </span>
                    </p>
                </div>
            </div>
        </x-ui.card>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <x-ui.card class="p-6">
                <h3 class="text-sm font-semibold text-foreground">
                    Statistiques
                </h3>
                <dl class="mt-4 space-y-3 text-sm">
                    <div class="flex items-center justify-between">
                        <dt class="text-muted">Matières enseignées</dt>
                        <dd class="font-semibold text-foreground">
                            {{ $enseignant->matieres->count() }}
                        </dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-muted">Évaluations reçues</dt>
                        <dd class="font-semibold text-foreground">
                            {{ $enseignant->evaluations->count() }}
                        </dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-muted">Moyenne globale</dt>
                        <dd>
                            @php
                                $moyenneClass =
                                    $enseignant->moyenne >= 4
                                        ? 'text-success'
                                        : ($enseignant->moyenne >= 3 ? 'text-amber-500' : 'text-danger');
                            @endphp
                            <span class="text-lg font-semibold {{ $moyenneClass }}">
                                {{ number_format($enseignant->moyenne, 2) }}/5
                            </span>
                        </dd>
                    </div>
                </dl>
            </x-ui.card>

            <x-ui.card class="p-6">
                <h3 class="text-sm font-semibold text-foreground">
                    Moyenne par critère
                </h3>
                <div class="mt-4 space-y-2">
                    @foreach ($moyenneParCritere as $critere => $moyenne)
                        @php
                            $moyenneClass =
                                $moyenne >= 4
                                    ? 'text-success'
                                    : ($moyenne >= 3
                                        ? 'text-amber-500'
                                        : 'text-danger');
                        @endphp
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-muted">
                                {{ $critere }}
                            </span>
                            <span class="font-semibold {{ $moyenneClass }}">
                                {{ number_format($moyenne, 2) }}/5
                            </span>
                        </div>
                    @endforeach
                </div>
            </x-ui.card>
        </div>

        @if ($evaluations->count() > 0)
            <x-ui.card class="p-0">
                <div class="flex items-center justify-between px-6 py-4">
                    <h3 class="text-sm font-semibold text-foreground">
                        Évaluations récentes
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-t border-borderColor/40 text-sm">
                        <thead class="bg-surface-muted/60 text-xs uppercase tracking-wide text-muted">
                            <tr>
                                <th class="px-4 py-2 text-left">Date</th>
                                <th class="px-4 py-2 text-left">Matière</th>
                                <th class="px-4 py-2 text-left">Moyenne</th>
                                <th class="px-4 py-2 text-left">Commentaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($evaluations as $evaluation)
                                @php
                                    $moyenneClass =
                                        $evaluation->moyenne >= 4
                                            ? 'text-success'
                                            : ($evaluation->moyenne >= 3
                                                ? 'text-amber-500'
                                                : 'text-danger');
                                @endphp
                                <tr class="border-t border-borderColor/30">
                                    <td class="px-4 py-2 text-sm text-muted">
                                        {{ $evaluation->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-foreground">
                                        {{ $evaluation->matiere->nom }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <span class="text-sm font-semibold {{ $moyenneClass }}">
                                            {{ number_format($evaluation->moyenne, 2) }}/5
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-sm text-muted">
                                        {{ $evaluation->commentaire_general ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-borderColor/40 px-6 py-3">
                    {{ $evaluations->links() }}
                </div>
            </x-ui.card>
        @endif
    </div>
</x-app-layout>
