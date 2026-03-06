<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tableau de bord Enseignant</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-2">Bienvenue, {{ auth()->user()->name }} !</h3>
                <p class="text-gray-600">Département: {{ $enseignant->departement?->nom ?? 'Non assigné' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Statistiques</h3>
                    <p><strong>Matières enseignées:</strong> {{ $enseignant->matieres->count() }}</p>
                    <p><strong>Évaluations reçues:</strong> {{ $enseignant->evaluations->count() }}</p>
                    <p><strong>Moyenne globale:</strong> 
                        <span class="font-bold text-lg {{ $enseignant->moyenne >= 4 ? 'text-green-600' : ($enseignant->moyenne >= 3 ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ number_format($enseignant->moyenne, 2) }}/5
                        </span>
                    </p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Moyenne par critère</h3>
                    @foreach($moyenneParCritere as $critere => $moyenne)
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm">{{ $critere }}</span>
                            <span class="font-bold {{ $moyenne >= 4 ? 'text-green-600' : ($moyenne >= 3 ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ number_format($moyenne, 2) }}/5
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            @if($evaluations->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Évaluations récentes</h3>
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2 px-4">Date</th>
                                <th class="text-left py-2 px-4">Matière</th>
                                <th class="text-left py-2 px-4">Moyenne</th>
                                <th class="text-left py-2 px-4">Commentaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($evaluations as $evaluation)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $evaluation->created_at->format('d/m/Y') }}</td>
                                    <td class="py-2 px-4">{{ $evaluation->matiere->nom }}</td>
                                    <td class="py-2 px-4">
                                        <span class="font-bold {{ $evaluation->moyenne >= 4 ? 'text-green-600' : ($evaluation->moyenne >= 3 ? 'text-yellow-600' : 'text-red-600') }}">
                                            {{ number_format($evaluation->moyenne, 2) }}/5
                                        </span>
                                    </td>
                                    <td class="py-2 px-4">{{ $evaluation->commentaire_general ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $evaluations->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
