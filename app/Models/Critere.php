<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Critère d'évaluation (ex : pédagogie, clarté, ponctualité).
 *
 * Les étudiants attribuent une note par critère lors d'une évaluation.
 */
class Critere extends Model
{
    /**
     * Attributs modifiables en masse.
     */
    protected $fillable = [
        'nom',
        'description',
        'ordre',
        'est_actif',
    ];

    /**
     * Casting des attributs.
     */
    protected $casts = [
        'est_actif' => 'boolean',
    ];

    /**
     * Notes données par les étudiants pour ce critère.
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Scope pour récupérer uniquement les critères actifs dans l'ordre d'affichage.
     */
    public function scopeActifs($query)
    {
        return $query->where('est_actif', true)->orderBy('ordre');
    }
}
