<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Périodes d'évaluation</h2>
            <a href="{{ route('admin.periodes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Nouvelle période</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date début</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date fin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Évaluations</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($periodes as $periode)
                            <tr class="border-b">
                                <td class="px-6 py-4">{{ $periode->nom }}</td>
                                <td class="px-6 py-4">{{ $periode->date_debut->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">{{ $periode->date_fin->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    @if($periode->est_active)
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">Active</span>
                                    @else
                                        <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-sm">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $periode->evaluations->count() }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.periodes.show', $periode) }}" class="text-blue-600 hover:underline mr-2">Voir</a>
                                    <a href="{{ route('admin.periodes.edit', $periode) }}" class="text-yellow-600 hover:underline mr-2">Modifier</a>
                                    <form action="{{ route('admin.periodes.destroy', $periode) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cette période ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $periodes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
