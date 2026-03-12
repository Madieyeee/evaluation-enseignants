<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-medium text-muted">Periodes d'evaluation</h2>
            <x-ui.button as="a" href="{{ route('admin.periodes.create') }}" variant="primary" size="sm" icon="plus">Nouvelle periode</x-ui.button>
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
                            <th class="px-4 py-3 text-left">Nom</th>
                            <th class="px-4 py-3 text-left">Date debut</th>
                            <th class="px-4 py-3 text-left">Date fin</th>
                            <th class="px-4 py-3 text-left">Statut</th>
                            <th class="px-4 py-3 text-left">Evaluations</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($periodes as $periode)
                            <tr class="border-t border-borderColor/30 hover:bg-surface-muted/30 transition-colors">
                                <td class="px-4 py-3 font-medium text-foreground">{{ $periode->nom }}</td>
                                <td class="px-4 py-3 text-muted">{{ $periode->date_debut->format('d/m/Y') }}</td>
                                <td class="px-4 py-3 text-muted">{{ $periode->date_fin->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">
                                    @if($periode->est_active)
                                        <span class="inline-flex items-center rounded-full bg-success/10 px-2 py-0.5 text-xs font-medium text-success">Active</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-surface-muted px-2 py-0.5 text-xs font-medium text-muted">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-muted">{{ $periode->evaluations->count() }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-1">
                                        <x-ui.button as="a" href="{{ route('admin.periodes.show', $periode) }}" variant="ghost" size="xs" icon="eye">Voir</x-ui.button>
                                        <x-ui.button as="a" href="{{ route('admin.periodes.edit', $periode) }}" variant="ghost" size="xs" icon="pencil">Modifier</x-ui.button>
                                        <form action="{{ route('admin.periodes.destroy', $periode) }}" method="POST" onsubmit="return confirm('Supprimer cette periode ?')">
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
            @if($periodes->hasPages())
                <div class="border-t border-borderColor/30 px-4 py-3">{{ $periodes->links() }}</div>
            @endif
        </x-ui.card>
    </div>
</x-app-layout>
