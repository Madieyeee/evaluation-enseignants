<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Matieres</h2>
            <x-ui.button as="a" href="{{ route('admin.matieres.create') }}" variant="primary" size="sm" icon="plus">Nouvelle matiere</x-ui.button>
        </div>
    </x-slot>
    <div class="space-y-6">
        @if(session('success'))
            <x-ui.card class="border border-success/20 bg-success/5 text-success text-sm">{{ session('success') }}</x-ui.card>
        @endif
        <x-ui.card class="p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-surface-muted/60 text-xs uppercase tracking-wide text-muted">
                        <tr>
                            <th class="px-4 py-3 text-left">Code</th>
                            <th class="px-4 py-3 text-left">Nom</th>
                            <th class="px-4 py-3 text-left">Enseignant</th>
                            <th class="px-4 py-3 text-left">Filiere</th>
                            <th class="px-4 py-3 text-left">Credits</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matieres as $matiere)
                            <tr class="border-t border-borderColor/30 hover:bg-surface-muted/30 transition-colors">
                                <td class="px-4 py-3 font-mono text-xs text-muted">{{ $matiere->code }}</td>
                                <td class="px-4 py-3 font-medium text-foreground">{{ $matiere->nom }}</td>
                                <td class="px-4 py-3 text-muted">{{ $matiere->enseignant?->user?->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-muted">{{ $matiere->filiere?->nom ?? '-' }}</td>
                                <td class="px-4 py-3 text-muted">{{ $matiere->credits ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-1">
                                        <x-ui.button as="a" href="{{ route('admin.matieres.show', $matiere) }}" variant="ghost" size="xs" icon="eye">Voir</x-ui.button>
                                        <x-ui.button as="a" href="{{ route('admin.matieres.edit', $matiere) }}" variant="ghost" size="xs" icon="pencil">Modifier</x-ui.button>
                                        <form action="{{ route('admin.matieres.destroy', $matiere) }}" method="POST" onsubmit="return confirm('Supprimer cette matiere ?')">
                                            @csrf @method('DELETE')
                                            <x-ui.button type="submit" variant="ghost" size="xs" icon="trash-2" class="text-danger hover:bg-danger/10">Supprimer</x-ui.button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($matieres->hasPages())
                <div class="border-t border-borderColor/30 px-4 py-3">{{ $matieres->links() }}</div>
            @endif
        </x-ui.card>
    </div>
</x-app-layout>
