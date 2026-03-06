<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Évaluer {{ $enseignant->user->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-4">
                <p class="text-gray-600"><strong>Matière:</strong> {{ $matiere->nom }}</p>
                <p class="text-gray-600"><strong>Enseignant:</strong> {{ $enseignant->user->name }}</p>
            </div>

            <form action="{{ route('etudiant.evaluations.store', [$enseignant, $matiere]) }}" method="POST">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Critères d'évaluation</h3>
                    <p class="text-gray-500 mb-4">Notez chaque critère de 1 à 5 (1 = Très insatisfait, 5 = Très satisfait)</p>

                    @foreach($criteres as $critere)
                        <div class="mb-6 border-b pb-4">
                            <label class="block text-gray-700 font-medium mb-2">{{ $critere->nom }}</label>
                            <p class="text-gray-500 text-sm mb-2">{{ $critere->description }}</p>
                            
                            <div class="flex gap-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="notes[{{ $critere->id }}]" value="{{ $i }}" class="hidden peer" required>
                                        <span class="inline-block w-10 h-10 text-center leading-10 border rounded peer-checked:bg-blue-600 peer-checked:text-white hover:bg-gray-100">
                                            {{ $i }}
                                        </span>
                                    </label>
                                @endfor
                            </div>
                            
                            <textarea name="commentaires[{{ $critere->id }}]" placeholder="Commentaire (optionnel)" class="mt-2 w-full border rounded px-3 py-2 text-sm" rows="2"></textarea>
                        </div>
                    @endforeach

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Commentaire général (optionnel)</label>
                        <textarea name="commentaire_general" class="w-full border rounded px-3 py-2" rows="3" placeholder="Partagez vos impressions générales..."></textarea>
                    </div>
                </div>

                <div class="flex gap-2 mt-4">
                    <a href="{{ route('etudiant.evaluations.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Soumettre l'évaluation</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
