<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Etudiants</h2>
            <x-ui.button as="a" href="{{ route('admin.etudiants.create') }}" variant="primary" size="sm" icon="plus">
                Nouvel etudiant
            </x-ui.button>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <x-ui.card class="border border-success/20 bg-success/5 text-success text-sm">
                {{ session('success') }}
            </x-ui.card>
        @endif

        <x-ui.card class="p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-surface-muted/60 text-xs uppercase tracking-wide text-muted">
                        <tr>
                            <th class="px-4 py-3 text-left">Matricule</th>
                            <th class="px-4 py-3 text-left">Nom</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Filiere</th>
                            <th class="px-4 py-3 text-left">Niveau</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($etudiants as $etudiant)
                            <tr class="border-t border-borderColor/30 hover:bg-surface-muted/30 transition-colors">
                                <td class="px-4 py-3 font-mono text-xs text-muted">{{ $etudiant->matricule }}</td>
                                <td class="px-4 py-3 font-medium text-foreground">{{ $etudiant->user->name }}</td>
                                <td class="px-4 py-3 text-muted">{{ $etudiant->user->email }}</td>
                                <td class="px-4 py-3 text-muted">{{ $etudiant->filiere?->nom ?? '—' }}</td>
                                <td class="px-4 py-3 text-muted">{{ $etudiant->niveau ?? '—' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-1">
                                        <x-ui.button as="a" href="{{ route('admin.etudiants.show', $etudiant) }}" variant="ghost" size="xs" icon="eye">Voir</x-ui.button>
                                        <x-ui.button as="a" href="{{ route('admin.etudiants.edit', $etudiant) }}" variant="ghost" size="xs" icon="pencil">Modifier</x-ui.button>
                                        <form action="{{ route('admin.etudiants.destroy', $etudiant) }}" method="POST" onsubmit="return confirm('Supprimer cet etudiant ?')">
                                            @csrf @method('DELETE')
                                            <x-ui.button type="submit" variant="ghost" size="xs" icon="trash-2" class="text-danger hover:bg-danger/10">Supprimer</x-ui.button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-muted text-sm">Aucun etudiant enregistre.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($etudiants->hasPages())
                <div class="border-t border-borderColor/30 px-4 py-3">
                    {{ $etudiants->links() }}
                </div>
            @endif
        </x-ui.card>
    </div>
</x-app-layout>
