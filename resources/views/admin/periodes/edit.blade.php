<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier la période</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.periodes.update', $periode) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nom de la période</label>
                        <input type="text" name="nom" value="{{ $periode->nom }}" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Date de début</label>
                            <input type="date" name="date_debut" value="{{ $periode->date_debut->format('Y-m-d') }}" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Date de fin</label>
                            <input type="date" name="date_fin" value="{{ $periode->date_fin->format('Y-m-d') }}" class="w-full border rounded px-3 py-2" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="est_active" value="1" {{ $periode->est_active ? 'checked' : '' }} class="mr-2">
                            <span class="text-gray-700">Période active</span>
                        </label>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.periodes.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
