<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Enseignants</h2>
            <a href="{{ route('admin.enseignants.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Nouvel enseignant
            </a>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Département</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Matières</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enseignants as $enseignant)
                            <tr class="border-b">
                                <td class="px-6 py-4">{{ $enseignant->user->name }}</td>
                                <td class="px-6 py-4">{{ $enseignant->user->email }}</td>
                                <td class="px-6 py-4">{{ $enseignant->departement?->nom ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $enseignant->matieres->count() }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.enseignants.show', $enseignant) }}" class="text-blue-600 hover:underline mr-2">Voir</a>
                                    <a href="{{ route('admin.enseignants.edit', $enseignant) }}" class="text-yellow-600 hover:underline mr-2">Modifier</a>
                                    <form action="{{ route('admin.enseignants.destroy', $enseignant) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cet enseignant ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $enseignants->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
