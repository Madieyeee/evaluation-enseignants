<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tableau de bord Étudiant</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-2">Bienvenue, {{ auth()->user()->name }} !</h3>
                @if(auth()->user()->etudiant)
                    <p class="text-gray-600">Matricule: {{ auth()->user()->etudiant->matricule ?? 'Non défini' }}</p>
                    <p class="text-gray-600">Filière: {{ auth()->user()->etudiant->filiere?->nom ?? 'Non assignée' }}</p>
                @else
                    <p class="text-gray-600">Profil étudiant en cours de création...</p>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('etudiant.evaluations.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
                    <div class="text-3xl mb-2">📝</div>
                    <h3 class="text-lg font-semibold">Évaluer les enseignants</h3>
                    <p class="text-gray-600">Donnez votre avis sur vos enseignants</p>
                </a>
                <a href="{{ route('etudiant.evaluations.historique') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
                    <div class="text-3xl mb-2">📊</div>
                    <h3 class="text-lg font-semibold">Mes évaluations</h3>
                    <p class="text-gray-600">Consultez vos évaluations passées</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
