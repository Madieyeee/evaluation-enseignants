<?php

namespace App\Exports;

use App\Models\Evaluation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EvaluationsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Evaluation::with(['etudiant.user', 'enseignant.user', 'matiere', 'periodeEvaluation'])
            ->get()
            ->map(function ($evaluation) {
                return [
                    'Date' => $evaluation->created_at?->format('d/m/Y H:i') ?? '',
                    'Étudiant' => $evaluation->etudiant?->user?->name ?? '',
                    'Enseignant' => $evaluation->enseignant?->user?->name ?? '',
                    'Matière' => $evaluation->matiere?->nom ?? '',
                    'Période' => $evaluation->periodeEvaluation?->nom ?? '',
                    'Moyenne' => number_format($evaluation->moyenne, 2),
                    'Commentaire' => $evaluation->commentaire_general ?? '',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Date',
            'Étudiant',
            'Enseignant',
            'Matière',
            'Période',
            'Moyenne',
            'Commentaire',
        ];
    }
}

