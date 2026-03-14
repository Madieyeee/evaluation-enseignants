<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Profil métier d'un enseignant (rattaché à un User).
 *
 * Contient les informations pédagogiques et les relations
 * vers les matières enseignées et les évaluations reçues.
 */
class Enseignant extends Model
{
    /**
     * Attributs modifiables en masse.
     */
    protected $fillable = [
        'user_id',
        'departement_id',
        'telephone',
        'bio',
    ];

    /**
     * Compte utilisateur associé (auth).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Département académique auquel l'enseignant est rattaché.
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    /**
     * Matières enseignées par cet enseignant.
     */
    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }

    /**
     * Évaluations reçues de la part des étudiants.
     */
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    /**
     * Moyenne globale de l'enseignant (moyenne des moyennes d'évaluation).
     */
    public function getMoyenneAttribute()
    {
        return $this->evaluations()->avg('moyenne') ?? 0;
    }

    /**
     * Nombre total d'évaluations reçues.
     */
    public function getNombreEvaluationsAttribute()
    {
        return $this->evaluations()->count();
    }
}
