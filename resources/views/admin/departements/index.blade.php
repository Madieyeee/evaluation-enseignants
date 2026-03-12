<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Departements</h2>
            <x-ui.button as="a" href="{{ route('admin.departements.create') }}" variant="primary" size="sm" icon="plus">Nouveau departement</x-ui.button>
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
                            <th class="px-4 py-3 text-left">Enseignants</th>
                            <th class="px-4 py-3 text-left">Filieres</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departements as $departement)
                            <tr class="border-t border-borderColor/30 hover:bg-surface-muted/30 transition-colors">
                                <td class="px-4 py-3 font-mono text-xs text-muted">{{ $departement->code }}</td>
                                <td class="px-4 py-3 font-medium text-foreground">{{ $departement->nom }}</td>
                                <td class="px-4 py-3 text-muted">{{ $departement->enseignants_count }}</td>
                                <td class="px-4 py-3 text-muted">{{ $departement->filieres_count }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-1">
                                        <x-ui.button as="a" href="{{ route('admin.departements.show', $departement) }}" variant="ghost" size="xs" icon="eye">Voir</x-ui.button>
                                        <x-ui.button as="a" href="{{ route('admin.departements.edit', $departement) }}" variant="ghost" size="xs" icon="pencil">Modifier</x-ui.button>
                                        <form action="{{ route('admin.departements.destroy', $departement) }}" method="POST" onsubmit="return confirm('Supprimer ce departement ?')">
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
            @if($departements->hasPages())
                <div class="border-t border-borderColor/30 px-4 py-3">{{ $departements->links() }}</div>
            @endif
        </x-ui.card>
    </div>
</x-app-layout>
