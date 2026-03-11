<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">
                Étudiants
            </h2>
            <x-ui.button
                as="a"
                href="{{ route('admin.etudiants.create') }}"
                variant="primary"
                size="sm"
                icon="user-plus"
            >
                Nouvel étudiant
            </x-ui.button>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if (session('success'))
            <x-ui.card class="border border-success/20 bg-success/5 text-success text-sm">
                {{ session('success') }}
            </x-ui.card>
        @endif

        <x-ui.card class="p-0">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex flex-col gap-1">
                    <h3 class="text-sm font-semibold text-foreground">
                        Liste des étudiants
                    </h3>
                    <p class="text-xs text-muted">
                        Vue synthétique des étudiants et de leurs informations principales.
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <x-ui.button
                        as="a"
                        href="{{ route('admin.exports.etudiants.pdf') }}"
                        variant="ghost"
                        size="sm"
                        icon="file-down"
                    >
                        PDF
                    </x-ui.button>
                    <x-ui.button
                        as="a"
                        href="{{ route('admin.exports.etudiants.excel') }}"
                        variant="ghost"
                        size="sm"
                        icon="file-spreadsheet"
                    >
                        Excel
                    </x-ui.button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-t border-borderColor/40 text-sm">
                    <thead class="bg-surface-muted/60 text-xs uppercase tracking-wide text-muted">
                        <tr>
                            <th class="px-4 py-2 text-left">Matricule</th>
                            <th class="px-4 py-2 text-left">Nom</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Filière</th>
                            <th class="px-4 py-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($etudiants as $etudiant)
                            <tr class="border-t border-borderColor/30">
                                <td class="px-4 py-2 text-sm text-foreground">
                                    {{ $etudiant->matricule }}
                                </td>
                                <td class="px-4 py-2 text-sm text-foreground">
                                    {{ $etudiant->user->name }}
                                </td>
                                <td class="px-4 py-2 text-sm text-muted">
                                    {{ $etudiant->user->email }}
                                </td>
                                <td class="px-4 py-2 text-sm text-muted">
                                    {{ $etudiant->filiere?->nom ?? '-' }}
                                </td>
                                <td class="px-4 py-2 text-right text-sm">
                                    <div class="inline-flex items-center gap-1">
                                        <x-ui.button
                                            as="a"
                                            href="{{ route('admin.etudiants.show', $etudiant) }}"
                                            variant="ghost"
                                            size="sm"
                                            icon="eye"
                                        >
                                            Voir
                                        </x-ui.button>
                                        <x-ui.button
                                            as="a"
                                            href="{{ route('admin.etudiants.edit', $etudiant) }}"
                                            variant="ghost"
                                            size="sm"
                                            icon="pencil"
                                        >
                                            Modifier
                                        </x-ui.button>
                                        <form
                                            action="{{ route('admin.etudiants.destroy', $etudiant) }}"
                                            method="POST"
                                            class="inline-flex"
                                            onsubmit="return confirm('Supprimer cet étudiant ?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <x-ui.button
                                                type="submit"
                                                variant="ghost"
                                                size="sm"
                                                icon="trash-2"
                                                class="text-danger hover:text-danger"
                                            >
                                                Supprimer
                                            </x-ui.button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-t border-borderColor/40 px-6 py-3">
                {{ $etudiants->links() }}
            </div>
        </x-ui.card>
    </div>
</x-app-layout>
