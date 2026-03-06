<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $matiere->nom }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <p><strong>Code:</strong> {{ $matiere->code }}</p>
                    <p><strong>Enseignant:</strong> {{ $matiere->enseignant?->user->name ?? '-' }}</p>
                    <p><strong>Filière:</strong> {{ $matiere->filiere?->nom ?? '-' }}</p>
                    <p><strong>Volume horaire:</strong> {{ $matiere->volume_horaire ?? '-' }}h</p>
                    <p><strong>Crédits:</strong> {{ $matiere->credits ?? '-' }}</p>
                    <p><strong>Évaluations:</strong> {{ $matiere->evaluations->count() }}</p>
                </div>
                @if($matiere->description)
                    <p class="mt-4"><strong>Description:</strong> {{ $matiere->description }}</p>
                @endif
            </div>

            @if($matiere->evaluations->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Évaluations reçues</h3>
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2 px-4">Date</th>
                                <th class="text-left py-2 px-4">Étudiant</th>
                                <th class="text-left py-2 px-4">Moyenne</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($matiere->evaluations as $evaluation)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $evaluation->created_at->format('d/m/Y') }}</td>
                                    <td class="py-2 px-4">{{ $evaluation->etudiant->user->name }}</td>
                                    <td class="py-2 px-4">{{ number_format($evaluation->moyenne, 2) }}/5</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('admin.matieres.index') }}" class="text-blue-600 hover:underline">← Retour à la liste</a>
            </div>
        </div>
    </div>
</x-app-layout>
