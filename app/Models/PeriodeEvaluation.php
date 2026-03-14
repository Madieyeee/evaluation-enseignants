<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Fenêtre temporelle durant laquelle les étudiants peuvent évaluer
 * leurs enseignants (campagne d'évaluation).
 */
class PeriodeEvaluation extends Model
{
    /**
     * Attributs modifiables en masse.
     */
    protected $fillable = [
        'nom',
        'date_debut',
        'date_fin',
        'est_active',
    ];

    /**
     * Casting des colonnes en types natifs.
     */
    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'est_active' => 'boolean',
    ];

    /**
     * Évaluations rattachées à cette période.
     */
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    /**
     * Scope pour récupérer la période marquée comme active.
     */
    public function scopeActive($query)
    {
        return $query->where('est_active', true);
    }

    /**
     * Scope pour récupérer les périodes actives ET dont les dates
     * encadrent la date courante (campagne réellement en cours).
     */
    public function scopeEnCours($query)
    {
        return $query->where('est_active', true)
            ->where('date_debut', '<=', now())
            ->where('date_fin', '>=', now());
    }

    /**
     * Indique si la période est ouverte à la date courante.
     */
    public function getEstOuverteAttribute()
    {
        return $this->est_active && $this->date_debut <= now() && $this->date_fin >= now();
    }
}
