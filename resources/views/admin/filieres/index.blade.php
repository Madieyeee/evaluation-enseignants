<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Filieres</h2>
            <x-ui.button as="a" href="{{ route('admin.filieres.create') }}" variant="primary" size="sm" icon="plus">Nouvelle filiere</x-ui.button>
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
                            <th class="px-4 py-3 text-left">Departement</th>
                            <th class="px-4 py-3 text-left">Etudiants</th>
                            <th class="px-4 py-3 text-left">Matieres</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($filieres as $filiere)
                            <tr class="border-t border-borderColor/30 hover:bg-surface-muted/30 transition-colors">
                                <td class="px-4 py-3 font-mono text-xs text-muted">{{ $filiere->code }}</td>
                                <td class="px-4 py-3 font-medium text-foreground">{{ $filiere->nom }}</td>
                                <td class="px-4 py-3 text-muted">{{ $filiere->departement?->nom ?? '-' }}</td>
                                <td class="px-4 py-3 text-muted">{{ $filiere->etudiants_count }}</td>
                                <td class="px-4 py-3 text-muted">{{ $filiere->matieres_count }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-1">
                                        <x-ui.button as="a" href="{{ route('admin.filieres.show', $filiere) }}" variant="ghost" size="xs" icon="eye">Voir</x-ui.button>
                                        <x-ui.button as="a" href="{{ route('admin.filieres.edit', $filiere) }}" variant="ghost" size="xs" icon="pencil">Modifier</x-ui.button>
                                        <form action="{{ route('admin.filieres.destroy', $filiere) }}" method="POST" onsubmit="return confirm('Supprimer cette filiere ?')">
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
            @if($filieres->hasPages())
                <div class="border-t border-borderColor/30 px-4 py-3">{{ $filieres->links() }}</div>
            @endif
        </x-ui.card>
    </div>
</x-app-layout>
