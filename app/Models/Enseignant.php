<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $fillable = [
        'user_id',
        'departement_id',
        'telephone',
        'bio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function getMoyenneAttribute()
    {
        return $this->evaluations()->avg('moyenne') ?? 0;
    }

    public function getNombreEvaluationsAttribute()
    {
        return $this->evaluations()->count();
    }
}
