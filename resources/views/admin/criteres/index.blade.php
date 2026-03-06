<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Critères d'évaluation</h2>
            <a href="{{ route('admin.criteres.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Nouveau critère</a>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ordre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($criteres as $critere)
                            <tr class="border-b">
                                <td class="px-6 py-4">{{ $critere->ordre }}</td>
                                <td class="px-6 py-4">{{ $critere->nom }}</td>
                                <td class="px-6 py-4">{{ Str::limit($critere->description, 50) }}</td>
                                <td class="px-6 py-4">
                                    @if($critere->est_actif)
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">Actif</span>
                                    @else
                                        <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-sm">Inactif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.criteres.edit', $critere) }}" class="text-yellow-600 hover:underline mr-2">Modifier</a>
                                    <form action="{{ route('admin.criteres.destroy', $critere) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce critère ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $criteres->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
