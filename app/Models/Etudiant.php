<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Profil métier d'un étudiant (rattaché à un User).
 *
 * Sert de pivot entre l'utilisateur, la filière et les évaluations réalisées.
 */
class Etudiant extends Model
{
    /**
     * Attributs modifiables en masse.
     */
    protected $fillable = [
        'user_id',
        'filiere_id',
        'matricule',
        'niveau',
    ];

    /**
     * Compte utilisateur associé (auth).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Filière (parcours) à laquelle l'étudiant est rattaché.
     */
    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    /**
     * Évaluations effectuées par cet étudiant.
     */
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    /**
     * Nombre total d'évaluations réalisées.
     */
    public function getNombreEvaluationsAttribute()
    {
        return $this->evaluations()->count();
    }
}
