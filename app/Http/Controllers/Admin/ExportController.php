<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enseignant;
use App\Models\Etudiant;
use App\Models\Evaluation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function enseignantsPdf(Request $request)
    {
        $enseignants = Enseignant::with(['user', 'departement', 'matieres'])->orderBy('id')->get();

        $pdf = Pdf::loadView('admin.exports.enseignants-pdf', [
            'enseignants' => $enseignants,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('enseignants.pdf');
    }

    public function etudiantsPdf(Request $request)
    {
        $etudiants = Etudiant::with(['user', 'filiere'])->orderBy('id')->get();

        $pdf = Pdf::loadView('admin.exports.etudiants-pdf', [
            'etudiants' => $etudiants,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('etudiants.pdf');
    }

    public function evaluationsPdf(Request $request)
    {
        $evaluations = Evaluation::with(['etudiant.user', 'enseignant.user', 'matiere', 'periodeEvaluation'])
            ->latest()
            ->take(200)
            ->get();

        $pdf = Pdf::loadView('admin.exports.evaluations-pdf', [
            'evaluations' => $evaluations,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('evaluations.pdf');
    }

    public function enseignantsExcel(Request $request)
    {
        return Excel::download(new \App\Exports\EnseignantsExport(), 'enseignants.xlsx');
    }

    public function etudiantsExcel(Request $request)
    {
        return Excel::download(new \App\Exports\EtudiantsExport(), 'etudiants.xlsx');
    }

    public function evaluationsExcel(Request $request)
    {
        return Excel::download(new \App\Exports\EvaluationsExport(), 'evaluations.xlsx');
    }
}

