<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Évaluer les enseignants</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">{{ session('error') }}</div>
            @endif

            @if(!$periodeActive)
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
                    Aucune période d'évaluation n'est actuellement active. Veuillez patienter.
                </div>
            @else
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    Période d'évaluation active : <strong>{{ $periodeActive->nom }}</strong> 
                    ({{ $periodeActive->date_debut->format('d/m/Y') }} - {{ $periodeActive->date_fin->format('d/m/Y') }})
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Enseignant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Matière</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enseignants as $enseignant)
                            @foreach($enseignant->matieres as $matiere)
                                @php
                                    $key = $enseignant->id . '_' . $matiere->id;
                                    $dejaEvalue = isset($evaluationsFaites[$key]);
                                @endphp
                                <tr class="border-b">
                                    <td class="px-6 py-4">{{ $enseignant->user->name }}</td>
                                    <td class="px-6 py-4">{{ $matiere->nom }}</td>
                                    <td class="px-6 py-4">
                                        @if($dejaEvalue)
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">Évalué</span>
                                        @else
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm">À évaluer</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($periodeActive && !$dejaEvalue)
                                            <a href="{{ route('etudiant.evaluations.create', [$enseignant, $matiere]) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                                Évaluer
                                            </a>
                                        @elseif($dejaEvalue)
                                            <span class="text-gray-500">Déjà évalué</span>
                                        @else
                                            <span class="text-gray-500">Période fermée</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
