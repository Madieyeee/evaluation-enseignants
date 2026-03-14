<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Matière enseignée dans une filière par un enseignant.
 */
class Matiere extends Model
{
    /**
     * Attributs modifiables en masse.
     */
    protected $fillable = [
        'nom',
        'code',
        'description',
        'enseignant_id',
        'filiere_id',
        'volume_horaire',
        'credits',
    ];

    /**
     * Enseignant responsable de la matière.
     */
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    /**
     * Filière dans laquelle la matière est proposée.
     */
    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    /**
     * Évaluations réalisées pour cette matière.
     */
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
