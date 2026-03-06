<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Filières</h2>
            <a href="{{ route('admin.filieres.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Nouvelle filière</a>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Département</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Étudiants</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Matières</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($filieres as $filiere)
                            <tr class="border-b">
                                <td class="px-6 py-4">{{ $filiere->code }}</td>
                                <td class="px-6 py-4">{{ $filiere->nom }}</td>
                                <td class="px-6 py-4">{{ $filiere->departement?->nom ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $filiere->etudiants_count }}</td>
                                <td class="px-6 py-4">{{ $filiere->matieres_count }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.filieres.show', $filiere) }}" class="text-blue-600 hover:underline mr-2">Voir</a>
                                    <a href="{{ route('admin.filieres.edit', $filiere) }}" class="text-yellow-600 hover:underline mr-2">Modifier</a>
                                    <form action="{{ route('admin.filieres.destroy', $filiere) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cette filière ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $filieres->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
