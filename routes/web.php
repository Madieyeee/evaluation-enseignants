<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartementController;
use App\Http\Controllers\Admin\FiliereController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\EnseignantController;
use App\Http\Controllers\Admin\EtudiantController;
use App\Http\Controllers\Admin\MatiereController;
use App\Http\Controllers\Admin\PeriodeEvaluationController;
use App\Http\Controllers\Admin\CritereController;
use App\Http\Controllers\Etudiant\EvaluationController as EtudiantEvaluationController;
use App\Http\Controllers\Enseignant\DashboardController as EnseignantDashboardController;
use App\Http\Controllers\Api\NotificationController as ApiNotificationController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes HTTP de l'application
|--------------------------------------------------------------------------
|
| Ce fichier centralise toutes les routes web : API de notifications,
| dashboards spécifiques selon le rôle, back-office admin et espace étudiant.
|
*/

// API REST légère utilisée par le front pour récupérer / marquer les notifications
Route::prefix('api')->middleware(['auth'])->group(function () {
    Route::get('/notifications', [ApiNotificationController::class, 'index'])->name('api.notifications.index');
    Route::post('/notifications/{id}/read', [ApiNotificationController::class, 'markAsRead'])->name('api.notifications.read');
    Route::post('/notifications/read-all', [ApiNotificationController::class, 'markAllAsRead'])->name('api.notifications.read-all');
});

Route::get('/', function () {
    return view('welcome');
});

// Routes web pour consulter / marquer les notifications dans l'interface
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
});

// Redirection vers le dashboard approprié en fonction du rôle de l'utilisateur connecté
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->isEnseignant()) {
        return redirect()->route('enseignant.dashboard');
    }
    return redirect()->route('etudiant.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Back-office Administrateur : gestion des référentiels et des périodes d'évaluation
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('departements', DepartementController::class);
    Route::resource('filieres', FiliereController::class);
    Route::resource('enseignants', EnseignantController::class);
    Route::resource('etudiants', EtudiantController::class);
    Route::resource('matieres', MatiereController::class);
    Route::resource('periodes', PeriodeEvaluationController::class);
    Route::resource('criteres', CritereController::class);

    // Exports PDF
    Route::get('/exports/enseignants/pdf', [ExportController::class, 'enseignantsPdf'])->name('exports.enseignants.pdf');
    Route::get('/exports/etudiants/pdf', [ExportController::class, 'etudiantsPdf'])->name('exports.etudiants.pdf');
    Route::get('/exports/evaluations/pdf', [ExportController::class, 'evaluationsPdf'])->name('exports.evaluations.pdf');

    // Exports Excel
    Route::get('/exports/enseignants/excel', [ExportController::class, 'enseignantsExcel'])->name('exports.enseignants.excel');
    Route::get('/exports/etudiants/excel', [ExportController::class, 'etudiantsExcel'])->name('exports.etudiants.excel');
    Route::get('/exports/evaluations/excel', [ExportController::class, 'evaluationsExcel'])->name('exports.evaluations.excel');
});

// Espace enseignant : un seul dashboard dédié
Route::middleware(['auth', 'enseignant'])->prefix('enseignant')->name('enseignant.')->group(function () {
    Route::get('/', [EnseignantDashboardController::class, '__invoke'])->name('dashboard');
});

// Espace étudiant : dashboard + flux d'évaluation
Route::middleware(['auth', 'etudiant'])->prefix('etudiant')->name('etudiant.')->group(function () {
    Route::get('/', function () {
        return view('etudiant.dashboard');
    })->name('dashboard');
    Route::get('/evaluer', [EtudiantEvaluationController::class, 'index'])->name('evaluations.index');
    Route::get('/evaluer/{enseignant}/{matiere}', [EtudiantEvaluationController::class, 'create'])->name('evaluations.create');
    Route::post('/evaluer/{enseignant}/{matiere}', [EtudiantEvaluationController::class, 'store'])->name('evaluations.store');
    Route::get('/mes-evaluations', [EtudiantEvaluationController::class, 'historique'])->name('evaluations.historique');
});

require __DIR__.'/auth.php';
