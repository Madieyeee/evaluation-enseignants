<x-app-layout>
    <x-slot name="header">
        <h2 class="text-sm font-medium text-muted">
            Tableau de bord administrateur
        </h2>
    </x-slot>

    <div class="space-y-8">
        {{-- Messages flash --}}
        @if (session('success'))
            <x-ui.card class="border border-success/20 bg-success/5 text-success text-sm">
                {{ session('success') }}
            </x-ui.card>
        @endif

        {{-- Statistiques principales --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
            <x-ui.card interactive class="p-5">
                <p class="text-xs font-medium uppercase tracking-[0.16em] text-muted">
                    Enseignants
                </p>
                <p class="mt-2 text-2xl font-semibold">
                    {{ $stats['enseignants'] }}
                </p>
            </x-ui.card>

            <x-ui.card interactive class="p-5">
                <p class="text-xs font-medium uppercase tracking-[0.16em] text-muted">
                    Étudiants
                </p>
                <p class="mt-2 text-2xl font-semibold">
                    {{ $stats['etudiants'] }}
                </p>
            </x-ui.card>

            <x-ui.card interactive class="p-5">
                <p class="text-xs font-medium uppercase tracking-[0.16em] text-muted">
                    Matières
                </p>
                <p class="mt-2 text-2xl font-semibold">
                    {{ $stats['matieres'] }}
                </p>
            </x-ui.card>

            <x-ui.card interactive class="p-5">
                <p class="text-xs font-medium uppercase tracking-[0.16em] text-muted">
                    Évaluations
                </p>
                <p class="mt-2 text-2xl font-semibold">
                    {{ $stats['evaluations'] }}
                </p>
            </x-ui.card>

            <x-ui.card interactive class="p-5">
                <p class="text-xs font-medium uppercase tracking-[0.16em] text-muted">
                    Départements
                </p>
                <p class="mt-2 text-2xl font-semibold">
                    {{ $stats['departements'] }}
                </p>
            </x-ui.card>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            {{-- Période active --}}
            <x-ui.card class="p-6 lg:col-span-1">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-sm font-semibold text-foreground">
                            Période d'évaluation active
                        </h3>

                        @if ($periodeActive)
                            <p class="mt-3 text-sm text-muted">
                                <span class="font-medium text-foreground">{{ $periodeActive->nom }}</span>
                                <span class="ml-1">
                                    ({{ $periodeActive->date_debut->format('d/m/Y') }}
                                    –
                                    {{ $periodeActive->date_fin->format('d/m/Y') }})
                                </span>
                            </p>
                        @else
                            <p class="mt-3 text-sm text-muted">
                                Aucune période d'évaluation active.
                            </p>
                        @endif
                    </div>

                    @if ($periodeActive)
                        <span
                            class="inline-flex items-center rounded-full bg-success/10 px-3 py-1 text-xs font-medium text-success"
                        >
                            Active
                        </span>
                    @endif
                </div>

                @unless ($periodeActive)
                    <div class="mt-4">
                        <x-ui.button
                            as="a"
                            href="{{ route('admin.periodes.create') }}"
                            variant="primary"
                            size="sm"
                            icon="calendar-plus"
                        >
                            Créer une période d'évaluation
                        </x-ui.button>
                    </div>
                @endunless
            </x-ui.card>

            {{-- Top enseignants --}}
            @if ($topEnseignants->count() > 0)
                <x-ui.card class="p-0 lg:col-span-2">
                    <div class="flex items-center justify-between px-6 py-4">
                        <h3 class="text-sm font-semibold text-foreground">
                            Top 5 des enseignants les mieux notés
                        </h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full border-t border-borderColor/40 text-sm">
                            <thead class="bg-surface-muted/60 text-xs uppercase tracking-wide text-muted">
                                <tr>
                                    <th class="px-4 py-2 text-left">Rang</th>
                                    <th class="px-4 py-2 text-left">Enseignant</th>
                                    <th class="px-4 py-2 text-left">Département</th>
                                    <th class="px-4 py-2 text-left">Évaluations</th>
                                    <th class="px-4 py-2 text-left">Moyenne</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topEnseignants as $index => $enseignant)
                                    <tr class="border-t border-borderColor/30">
                                        <td class="px-4 py-2 text-xs text-muted">
                                            #{{ $index + 1 }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <span class="text-sm font-medium text-foreground">
                                                {{ $enseignant->user->name }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 text-sm text-muted">
                                            {{ $enseignant->departement?->nom ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-muted">
                                            {{ $enseignant->evaluations_count }}
                                        </td>
                                        <td class="px-4 py-2">
                                            @php
                                                $moyenneClass =
                                                    $enseignant->moyenne >= 4
                                                        ? 'text-success'
                                                        : ($enseignant->moyenne >= 3
                                                            ? 'text-amber-500'
                                                            : 'text-danger');
                                            @endphp
                                            <span class="text-sm font-semibold {{ $moyenneClass }}">
                                                {{ number_format($enseignant->moyenne, 2) }}/5
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-ui.card>
            @endif
        </div>

        {{-- Liens rapides --}}
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
            <x-ui.card
                interactive
                as="a"
                href="{{ route('admin.enseignants.index') }}"
                class="flex flex-col items-start gap-3 p-4"
            >
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-accent-soft text-accent">
                    👨‍🏫
                </span>
                <div>
                    <p class="text-sm font-medium text-foreground">Enseignants</p>
                    <p class="mt-1 text-xs text-muted">Gérer les enseignants et leurs matières</p>
                </div>
            </x-ui.card>

            <x-ui.card
                interactive
                as="a"
                href="{{ route('admin.etudiants.index') }}"
                class="flex flex-col items-start gap-3 p-4"
            >
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-accent-soft text-accent">
                    👨‍🎓
                </span>
                <div>
                    <p class="text-sm font-medium text-foreground">Étudiants</p>
                    <p class="mt-1 text-xs text-muted">Gérer les profils étudiants</p>
                </div>
            </x-ui.card>

            <x-ui.card
                interactive
                as="a"
                href="{{ route('admin.matieres.index') }}"
                class="flex flex-col items-start gap-3 p-4"
            >
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-accent-soft text-accent">
                    📚
                </span>
                <div>
                    <p class="text-sm font-medium text-foreground">Matières</p>
                    <p class="mt-1 text-xs text-muted">Configuer les matières évaluées</p>
                </div>
            </x-ui.card>

            <x-ui.card
                interactive
                as="a"
                href="{{ route('admin.periodes.index') }}"
                class="flex flex-col items-start gap-3 p-4"
            >
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-accent-soft text-accent">
                    📅
                </span>
                <div>
                    <p class="text-sm font-medium text-foreground">Périodes</p>
                    <p class="mt-1 text-xs text-muted">Planifier les campagnes d'évaluation</p>
                </div>
            </x-ui.card>
        </div>
    </div>
</x-app-layout>
