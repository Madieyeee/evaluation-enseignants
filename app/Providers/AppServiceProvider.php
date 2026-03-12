<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer('components.layout.sidebar', function ($view) {
            $user = auth()->user();
            if (!$user) return;

            $items = [];

            if ($user->role === 'admin') {
                $items = [
                    ['label' => 'Tableau de bord', 'icon' => 'layout-dashboard', 'route' => 'admin.dashboard'],
                    ['label' => 'Departements',     'icon' => 'building-2',       'route' => 'admin.departements.index'],
                    ['label' => 'Filieres',          'icon' => 'git-branch',       'route' => 'admin.filieres.index'],
                    ['label' => 'Matieres',          'icon' => 'book-open',        'route' => 'admin.matieres.index'],
                    ['label' => 'Enseignants',       'icon' => 'users',            'route' => 'admin.enseignants.index'],
                    ['label' => 'Etudiants',         'icon' => 'graduation-cap',   'route' => 'admin.etudiants.index'],
                    ['label' => 'Criteres',          'icon' => 'list-checks',      'route' => 'admin.criteres.index'],
                    ['label' => 'Periodes',          'icon' => 'calendar-range',   'route' => 'admin.periodes.index'],
                ];
            } elseif ($user->role === 'enseignant') {
                $items = [
                    ['label' => 'Tableau de bord', 'icon' => 'layout-dashboard', 'route' => 'enseignant.dashboard'],
                    ['label' => 'Mes evaluations', 'icon' => 'star',             'route' => 'enseignant.evaluations.index'],
                ];
            } elseif ($user->role === 'etudiant') {
                $items = [
                    ['label' => 'Tableau de bord', 'icon' => 'layout-dashboard', 'route' => 'etudiant.dashboard'],
                    ['label' => 'Evaluer',          'icon' => 'clipboard-check',  'route' => 'etudiant.evaluations.index'],
                    ['label' => 'Historique',       'icon' => 'history',          'route' => 'etudiant.evaluations.historique'],
                ];
            }

            $items = array_map(function ($item) {
                $item['active'] = request()->routeIs($item['route'] . '*');
                return $item;
            }, $items);

            $view->with('items', $items);
        });
    }
}
