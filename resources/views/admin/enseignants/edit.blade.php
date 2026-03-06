<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier l'enseignant</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.enseignants.update', $enseignant) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nom complet</label>
                            <input type="text" name="name" value="{{ $enseignant->user->name }}" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="email" value="{{ $enseignant->user->email }}" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Département</label>
                            <select name="departement_id" class="w-full border rounded px-3 py-2">
                                <option value="">-- Sélectionner --</option>
                                @foreach($departements as $dept)
                                    <option value="{{ $dept->id }}" {{ $enseignant->departement_id == $dept->id ? 'selected' : '' }}>{{ $dept->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Téléphone</label>
                            <input type="text" name="telephone" value="{{ $enseignant->telephone }}" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Bio</label>
                        <textarea name="bio" class="w-full border rounded px-3 py-2" rows="3">{{ $enseignant->bio }}</textarea>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.enseignants.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
