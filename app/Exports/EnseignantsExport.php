<?php

namespace App\Exports;

use App\Models\Enseignant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EnseignantsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Enseignant::with(['user', 'departement'])
            ->get()
            ->map(function ($enseignant) {
                return [
                    'Nom' => $enseignant->user->name,
                    'Email' => $enseignant->user->email,
                    'Département' => $enseignant->departement?->nom ?? '',
                    'Nombre de matières' => $enseignant->matieres()->count(),
                    'Nombre d\'évaluations' => $enseignant->evaluations()->count(),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Email',
            'Département',
            'Nombre de matières',
            'Nombre d\'évaluations',
        ];
    }
}

