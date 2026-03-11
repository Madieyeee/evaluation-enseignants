<x-app-layout>
    <x-slot name="header">
        <h2 class="text-sm font-medium text-muted">
            Tableau de bord Étudiant
        </h2>
    </x-slot>

    <div class="space-y-8">
        @if (session('success'))
            <x-ui.card class="border border-success/20 bg-success/5 text-success text-sm">
                {{ session('success') }}
            </x-ui.card>
        @endif

        <x-ui.card class="p-6">
            <h3 class="text-sm font-semibold text-foreground">
                Bienvenue, {{ auth()->user()->name }} !
            </h3>

            <div class="mt-3 text-sm text-muted">
                @if (auth()->user()->etudiant)
                    <p>
                        Matricule :
                        <span class="font-medium text-foreground">
                            {{ auth()->user()->etudiant->matricule ?? 'Non défini' }}
                        </span>
                    </p>
                    <p class="mt-1">
                        Filière :
                        <span class="font-medium text-foreground">
                            {{ auth()->user()->etudiant->filiere?->nom ?? 'Non assignée' }}
                        </span>
                    </p>
                @else
                    <p>Profil étudiant en cours de création...</p>
                @endif
            </div>
        </x-ui.card>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-ui.card
                interactive
                as="a"
                href="{{ route('etudiant.evaluations.index') }}"
                class="flex flex-col gap-2 p-6"
            >
                <span
                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-accent-soft text-accent text-xl"
                >
                    📝
                </span>
                <h3 class="text-sm font-medium text-foreground">
                    Évaluer les enseignants
                </h3>
                <p class="text-sm text-muted">
                    Donnez votre avis sur vos enseignants.
                </p>
            </x-ui.card>

            <x-ui.card
                interactive
                as="a"
                href="{{ route('etudiant.evaluations.historique') }}"
                class="flex flex-col gap-2 p-6"
            >
                <span
                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-accent-soft text-accent text-xl"
                >
                    📊
                </span>
                <h3 class="text-sm font-medium text-foreground">
                    Mes évaluations
                </h3>
                <p class="text-sm text-muted">
                    Consultez vos évaluations passées.
                </p>
            </x-ui.card>
        </div>
    </div>
</x-app-layout>
