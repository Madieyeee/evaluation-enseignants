<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de bord Administrateur
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Messages flash -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-3xl font-bold text-blue-600">{{ $stats['enseignants'] }}</div>
                    <div class="text-gray-600">Enseignants</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-3xl font-bold text-green-600">{{ $stats['etudiants'] }}</div>
                    <div class="text-gray-600">Étudiants</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-3xl font-bold text-purple-600">{{ $stats['matieres'] }}</div>
                    <div class="text-gray-600">Matières</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-3xl font-bold text-orange-600">{{ $stats['evaluations'] }}</div>
                    <div class="text-gray-600">Évaluations</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-3xl font-bold text-indigo-600">{{ $stats['departements'] }}</div>
                    <div class="text-gray-600">Départements</div>
                </div>
            </div>

            <!-- Période active -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold mb-4">Période d'évaluation active</h3>
                @if($periodeActive)
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="font-medium">{{ $periodeActive->nom }}</span>
                            <span class="text-gray-600 ml-2">
                                ({{ $periodeActive->date_debut->format('d/m/Y') }} - {{ $periodeActive->date_fin->format('d/m/Y') }})
                            </span>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Active</span>
                    </div>
                @else
                    <p class="text-gray-500">Aucune période d'évaluation active.</p>
                    <a href="{{ route('admin.periodes.create') }}" class="mt-2 inline-block text-blue-600 hover:underline">
                        Créer une période d'évaluation
                    </a>
                @endif
            </div>

            <!-- Top enseignants -->
            @if($topEnseignants->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Top 5 des enseignants les mieux notés</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-2 px-4">Rang</th>
                                    <th class="text-left py-2 px-4">Enseignant</th>
                                    <th class="text-left py-2 px-4">Département</th>
                                    <th class="text-left py-2 px-4">Évaluations</th>
                                    <th class="text-left py-2 px-4">Moyenne</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topEnseignants as $index => $enseignant)
                                    <tr class="border-b">
                                        <td class="py-2 px-4">{{ $index + 1 }}</td>
                                        <td class="py-2 px-4">{{ $enseignant->user->name }}</td>
                                        <td class="py-2 px-4">{{ $enseignant->departement?->nom ?? '-' }}</td>
                                        <td class="py-2 px-4">{{ $enseignant->evaluations_count }}</td>
                                        <td class="py-2 px-4">
                                            <span class="font-bold {{ $enseignant->moyenne >= 4 ? 'text-green-600' : ($enseignant->moyenne >= 3 ? 'text-yellow-600' : 'text-red-600') }}">
                                                {{ number_format($enseignant->moyenne, 2) }}/5
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Liens rapides -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                <a href="{{ route('admin.enseignants.index') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition text-center">
                    <div class="text-2xl mb-2">👨‍🏫</div>
                    <div class="font-medium">Enseignants</div>
                </a>
                <a href="{{ route('admin.etudiants.index') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition text-center">
                    <div class="text-2xl mb-2">👨‍🎓</div>
                    <div class="font-medium">Étudiants</div>
                </a>
                <a href="{{ route('admin.matieres.index') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition text-center">
                    <div class="text-2xl mb-2">📚</div>
                    <div class="font-medium">Matières</div>
                </a>
                <a href="{{ route('admin.periodes.index') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition text-center">
                    <div class="text-2xl mb-2">📅</div>
                    <div class="font-medium">Périodes</div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
