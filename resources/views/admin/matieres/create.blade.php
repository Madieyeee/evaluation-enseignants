<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nouvelle matière</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.matieres.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Code</label>
                            <input type="text" name="code" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                            <input type="text" name="nom" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Enseignant</label>
                            <select name="enseignant_id" class="w-full border rounded px-3 py-2">
                                <option value="">-- Sélectionner --</option>
                                @foreach($enseignants as $enseignant)
                                    <option value="{{ $enseignant->id }}">{{ $enseignant->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Filière</label>
                            <select name="filiere_id" class="w-full border rounded px-3 py-2">
                                <option value="">-- Sélectionner --</option>
                                @foreach($filieres as $filiere)
                                    <option value="{{ $filiere->id }}">{{ $filiere->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Volume horaire</label>
                            <input type="number" name="volume_horaire" class="w-full border rounded px-3 py-2" min="1">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Crédits</label>
                            <input type="number" name="credits" class="w-full border rounded px-3 py-2" min="1">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                        <textarea name="description" class="w-full border rounded px-3 py-2" rows="3"></textarea>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.matieres.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
