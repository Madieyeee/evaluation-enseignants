<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Représente une évaluation complète d'un enseignant par un étudiant
 * pour une matière et une période données.
 *
 * Une Evaluation est composée de plusieurs notes (une par critère).
 */
class Evaluation extends Model
{
    /**
     * Attributs modifiables en masse.
     */
    protected $fillable = [
        'etudiant_id',
        'enseignant_id',
        'matiere_id',
        'periode_evaluation_id',
        'commentaire_general',
    ];

    /**
     * Étudiant qui a réalisé l'évaluation.
     */
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    /**
     * Enseignant évalué.
     */
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    /**
     * Matière concernée par l'évaluation.
     */
    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    /**
     * Période d'évaluation à laquelle appartient cette évaluation.
     */
    public function periodeEvaluation()
    {
        return $this->belongsTo(PeriodeEvaluation::class);
    }

    /**
     * Notes individuelles par critère pour cette évaluation.
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Calcul de la moyenne agrégée sur l'ensemble des critères.
     */
    public function getMoyenneAttribute()
    {
        return $this->notes()->avg('note') ?? 0;
    }
}
