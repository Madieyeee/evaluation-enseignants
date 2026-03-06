<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $enseignant->user->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="grid grid-cols-2 gap-4">
                    <p><strong>Email:</strong> {{ $enseignant->user->email }}</p>
                    <p><strong>Téléphone:</strong> {{ $enseignant->telephone ?? '-' }}</p>
                    <p><strong>Département:</strong> {{ $enseignant->departement?->nom ?? '-' }}</p>
                    <p><strong>Bio:</strong> {{ $enseignant->bio ?? '-' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Matières enseignées ({{ $enseignant->matieres->count() }})</h3>
                    @if($enseignant->matieres->count() > 0)
                        <ul class="list-disc list-inside">
                            @foreach($enseignant->matieres as $matiere)
                                <li>{{ $matiere->nom }} ({{ $matiere->code }})</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Aucune matière assignée</p>
                    @endif
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Statistiques</h3>
                    <p><strong>Évaluations reçues:</strong> {{ $enseignant->evaluations->count() }}</p>
                    <p><strong>Moyenne globale:</strong> 
                        <span class="font-bold {{ $enseignant->moyenne >= 4 ? 'text-green-600' : ($enseignant->moyenne >= 3 ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ number_format($enseignant->moyenne, 2) }}/5
                        </span>
                    </p>
                </div>
            </div>

            @if($enseignant->evaluations->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Évaluations récentes</h3>
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2 px-4">Date</th>
                                <th class="text-left py-2 px-4">Matière</th>
                                <th class="text-left py-2 px-4">Moyenne</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enseignant->evaluations->take(5) as $eval)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $eval->created_at->format('d/m/Y') }}</td>
                                    <td class="py-2 px-4">{{ $eval->matiere->nom }}</td>
                                    <td class="py-2 px-4">{{ number_format($eval->moyenne, 2) }}/5</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('admin.enseignants.index') }}" class="text-blue-600 hover:underline">← Retour à la liste</a>
            </div>
        </div>
    </div>
</x-app-layout>
