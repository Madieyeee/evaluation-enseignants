<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Étudiants</h2>
            <a href="{{ route('admin.etudiants.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Nouvel étudiant</a>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Matricule</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Filière</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etudiants as $etudiant)
                            <tr class="border-b">
                                <td class="px-6 py-4">{{ $etudiant->matricule }}</td>
                                <td class="px-6 py-4">{{ $etudiant->user->name }}</td>
                                <td class="px-6 py-4">{{ $etudiant->user->email }}</td>
                                <td class="px-6 py-4">{{ $etudiant->filiere?->nom ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.etudiants.show', $etudiant) }}" class="text-blue-600 hover:underline mr-2">Voir</a>
                                    <a href="{{ route('admin.etudiants.edit', $etudiant) }}" class="text-yellow-600 hover:underline mr-2">Modifier</a>
                                    <form action="{{ route('admin.etudiants.destroy', $etudiant) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cet étudiant ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $etudiants->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
