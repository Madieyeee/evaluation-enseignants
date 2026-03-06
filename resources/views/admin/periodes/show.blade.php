<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $periode->nom }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <p><strong>Date début:</strong> {{ $periode->date_debut->format('d/m/Y') }}</p>
                    <p><strong>Date fin:</strong> {{ $periode->date_fin->format('d/m/Y') }}</p>
                    <p><strong>Statut:</strong> 
                        @if($periode->est_active)
                            <span class="text-green-600 font-bold">Active</span>
                        @else
                            <span class="text-gray-500">Inactive</span>
                        @endif
                    </p>
                    <p><strong>Évaluations:</strong> {{ $periode->evaluations->count() }}</p>
                </div>
            </div>

            @if($periode->evaluations->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Évaluations de cette période</h3>
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2 px-4">Date</th>
                                <th class="text-left py-2 px-4">Étudiant</th>
                                <th class="text-left py-2 px-4">Enseignant</th>
                                <th class="text-left py-2 px-4">Matière</th>
                                <th class="text-left py-2 px-4">Moyenne</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($periode->evaluations as $evaluation)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $evaluation->created_at->format('d/m/Y') }}</td>
                                    <td class="py-2 px-4">{{ $evaluation->etudiant->user->name }}</td>
                                    <td class="py-2 px-4">{{ $evaluation->enseignant->user->name }}</td>
                                    <td class="py-2 px-4">{{ $evaluation->matiere->nom }}</td>
                                    <td class="py-2 px-4">{{ number_format($evaluation->moyenne, 2) }}/5</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('admin.periodes.index') }}" class="text-blue-600 hover:underline">← Retour à la liste</a>
            </div>
        </div>
    </div>
</x-app-layout>
