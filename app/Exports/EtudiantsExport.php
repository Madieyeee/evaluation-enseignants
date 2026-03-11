<?php

namespace App\Exports;

use App\Models\Etudiant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EtudiantsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Etudiant::with(['user', 'filiere'])
            ->get()
            ->map(function ($etudiant) {
                return [
                    'Matricule' => $etudiant->matricule,
                    'Nom' => $etudiant->user->name,
                    'Email' => $etudiant->user->email,
                    'Filière' => $etudiant->filiere?->nom ?? '',
                    'Niveau' => $etudiant->niveau ?? '',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Matricule',
            'Nom',
            'Email',
            'Filière',
            'Niveau',
        ];
    }
}

