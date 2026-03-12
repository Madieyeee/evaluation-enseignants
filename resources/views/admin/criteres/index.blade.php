<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Criteres d'evaluation</h2>
            <x-ui.button as="a" href="{{ route('admin.criteres.create') }}" variant="primary" size="sm" icon="plus">
                Nouveau critere
            </x-ui.button>
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
                            <th class="px-4 py-3 text-left">Ordre</th>
                            <th class="px-4 py-3 text-left">Nom</th>
                            <th class="px-4 py-3 text-left">Description</th>
                            <th class="px-4 py-3 text-left">Statut</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($criteres as $critere)
                            <tr class="border-t border-borderColor/30 hover:bg-surface-muted/30 transition-colors">
                                <td class="px-4 py-3 text-muted">{{ $critere->ordre }}</td>
                                <td class="px-4 py-3 font-medium text-foreground">{{ $critere->nom }}</td>
                                <td class="px-4 py-3 text-muted">{{ Str::limit($critere->description, 50) }}</td>
                                <td class="px-4 py-3">
                                    @if($critere->est_actif)
                                        <span class="inline-flex items-center rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">Actif</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-surface-muted px-2 py-0.5 text-xs font-medium text-muted">Inactif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-1">
                                        <x-ui.button as="a" href="{{ route('admin.criteres.edit', $critere) }}" variant="ghost" size="xs" icon="pencil">Modifier</x-ui.button>
                                        <form action="{{ route('admin.criteres.destroy', $critere) }}" method="POST" onsubmit="return confirm('Supprimer ce critere ?')">
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
            @if($criteres->hasPages())
                <div class="border-t border-borderColor/30 px-4 py-3">{{ $criteres->links() }}</div>
            @endif
        </x-ui.card>
    </div>
</x-app-layout>
