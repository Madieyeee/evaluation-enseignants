<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $departement->nom }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <p class="text-gray-600 mb-2"><strong>Code:</strong> {{ $departement->code }}</p>
                <p class="text-gray-600 mb-2"><strong>Description:</strong> {{ $departement->description ?? '-' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Enseignants ({{ $departement->enseignants->count() }})</h3>
                    @if($departement->enseignants->count() > 0)
                        <ul class="list-disc list-inside">
                            @foreach($departement->enseignants as $enseignant)
                                <li>{{ $enseignant->user->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Aucun enseignant</p>
                    @endif
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Filières ({{ $departement->filieres->count() }})</h3>
                    @if($departement->filieres->count() > 0)
                        <ul class="list-disc list-inside">
                            @foreach($departement->filieres as $filiere)
                                <li>{{ $filiere->nom }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Aucune filière</p>
                    @endif
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.departements.index') }}" class="text-blue-600 hover:underline">← Retour à la liste</a>
            </div>
        </div>
    </div>
</x-app-layout>
