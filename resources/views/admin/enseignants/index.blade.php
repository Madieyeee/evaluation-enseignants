<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">
                Enseignants
            </h2>
            <x-ui.button
                as="a"
                href="{{ route('admin.enseignants.create') }}"
                variant="primary"
                size="sm"
                icon="user-plus"
            >
                Nouvel enseignant
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
                        Liste des enseignants
                    </h3>
                    <p class="text-xs text-muted">
                        Vue synthétique des enseignants et de leurs informations principales.
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <x-ui.button
                        as="a"
                        href="{{ route('admin.exports.enseignants.pdf') }}"
                        variant="ghost"
                        size="sm"
                        icon="file-down"
                    >
                        PDF
                    </x-ui.button>
                    <x-ui.button
                        as="a"
                        href="{{ route('admin.exports.enseignants.excel') }}"
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
                            <th class="px-4 py-2 text-left">Nom</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Département</th>
                            <th class="px-4 py-2 text-left">Matières</th>
                            <th class="px-4 py-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enseignants as $enseignant)
                            <tr class="border-t border-borderColor/30">
                                <td class="px-4 py-2 text-sm text-foreground">
                                    {{ $enseignant->user->name }}
                                </td>
                                <td class="px-4 py-2 text-sm text-muted">
                                    {{ $enseignant->user->email }}
                                </td>
                                <td class="px-4 py-2 text-sm text-muted">
                                    {{ $enseignant->departement?->nom ?? '-' }}
                                </td>
                                <td class="px-4 py-2 text-sm text-muted">
                                    {{ $enseignant->matieres->count() }}
                                </td>
                                <td class="px-4 py-2 text-right text-sm">
                                    <div class="inline-flex items-center gap-1">
                                        <x-ui.button
                                            as="a"
                                            href="{{ route('admin.enseignants.show', $enseignant) }}"
                                            variant="ghost"
                                            size="sm"
                                            icon="eye"
                                        >
                                            Voir
                                        </x-ui.button>
                                        <x-ui.button
                                            as="a"
                                            href="{{ route('admin.enseignants.edit', $enseignant) }}"
                                            variant="ghost"
                                            size="sm"
                                            icon="pencil"
                                        >
                                            Modifier
                                        </x-ui.button>
                                        <form
                                            action="{{ route('admin.enseignants.destroy', $enseignant) }}"
                                            method="POST"
                                            class="inline-flex"
                                            onsubmit="return confirm('Supprimer cet enseignant ?')"
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
                {{ $enseignants->links() }}
            </div>
        </x-ui.card>
    </div>
</x-app-layout>
