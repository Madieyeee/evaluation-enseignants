<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $etudiant->user->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="grid grid-cols-2 gap-4">
                    <p><strong>Matricule:</strong> {{ $etudiant->matricule }}</p>
                    <p><strong>Email:</strong> {{ $etudiant->user->email }}</p>
                    <p><strong>Filière:</strong> {{ $etudiant->filiere?->nom ?? '-' }}</p>
                    <p><strong>Niveau:</strong> {{ $etudiant->niveau ?? '-' }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">Évaluations effectuées ({{ $etudiant->evaluations->count() }})</h3>
                @if($etudiant->evaluations->count() > 0)
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2 px-4">Date</th>
                                <th class="text-left py-2 px-4">Enseignant</th>
                                <th class="text-left py-2 px-4">Matière</th>
                                <th class="text-left py-2 px-4">Moyenne</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($etudiant->evaluations as $evaluation)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $evaluation->created_at->format('d/m/Y') }}</td>
                                    <td class="py-2 px-4">{{ $evaluation->enseignant->user->name }}</td>
                                    <td class="py-2 px-4">{{ $evaluation->matiere->nom }}</td>
                                    <td class="py-2 px-4">{{ number_format($evaluation->moyenne, 2) }}/5</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500">Aucune évaluation effectuée</p>
                @endif
            </div>

            <a href="{{ route('admin.etudiants.index') }}" class="text-blue-600 hover:underline">← Retour à la liste</a>
        </div>
    </div>
</x-app-layout>
