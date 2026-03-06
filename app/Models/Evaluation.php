<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'etudiant_id',
        'enseignant_id',
        'matiere_id',
        'periode_evaluation_id',
        'commentaire_general',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function periodeEvaluation()
    {
        return $this->belongsTo(PeriodeEvaluation::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function getMoyenneAttribute()
    {
        return $this->notes()->avg('note') ?? 0;
    }
}
