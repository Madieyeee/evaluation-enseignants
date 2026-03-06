<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mes évaluations</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($evaluations->count() > 0)
                @foreach($evaluations as $evaluation)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-4">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-semibold text-lg">{{ $evaluation->enseignant->user->name }}</h3>
                                <p class="text-gray-600">{{ $evaluation->matiere->nom }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-500 text-sm">{{ $evaluation->created_at->format('d/m/Y') }}</p>
                                <p class="text-2xl font-bold {{ $evaluation->moyenne >= 4 ? 'text-green-600' : ($evaluation->moyenne >= 3 ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ number_format($evaluation->moyenne, 2) }}/5
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($evaluation->notes as $note)
                                <div class="bg-gray-50 p-3 rounded">
                                    <p class="text-sm text-gray-600">{{ $note->critere->nom }}</p>
                                    <p class="font-bold text-lg">{{ $note->note }}/5</p>
                                </div>
                            @endforeach
                        </div>

                        @if($evaluation->commentaire_general)
                            <p class="mt-4 text-gray-600 italic">"{{ $evaluation->commentaire_general }}"</p>
                        @endif
                    </div>
                @endforeach
                {{ $evaluations->links() }}
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-gray-500">Vous n'avez pas encore effectué d'évaluation.</p>
                    <a href="{{ route('etudiant.evaluations.index') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Commencer à évaluer
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
