<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $filiere->nom }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <p><strong>Code:</strong> {{ $filiere->code }}</p>
                    <p><strong>Département:</strong> {{ $filiere->departement?->nom ?? '-' }}</p>
                    <p><strong>Étudiants:</strong> {{ $filiere->etudiants->count() }}</p>
                    <p><strong>Matières:</strong> {{ $filiere->matieres->count() }}</p>
                </div>
                @if($filiere->description)
                    <p class="mt-4"><strong>Description:</strong> {{ $filiere->description }}</p>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Étudiants ({{ $filiere->etudiants->count() }})</h3>
                    @if($filiere->etudiants->count() > 0)
                        <ul class="list-disc list-inside max-h-48 overflow-y-auto">
                            @foreach($filiere->etudiants as $etudiant)
                                <li>{{ $etudiant->user->name }} ({{ $etudiant->matricule }})</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Aucun étudiant</p>
                    @endif
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Matières ({{ $filiere->matieres->count() }})</h3>
                    @if($filiere->matieres->count() > 0)
                        <ul class="list-disc list-inside max-h-48 overflow-y-auto">
                            @foreach($filiere->matieres as $matiere)
                                <li>{{ $matiere->nom }} ({{ $matiere->code }})</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Aucune matière</p>
                    @endif
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.filieres.index') }}" class="text-blue-600 hover:underline">← Retour à la liste</a>
            </div>
        </div>
    </div>
</x-app-layout>
