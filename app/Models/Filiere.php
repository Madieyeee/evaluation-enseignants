<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $fillable = [
        'nom',
        'code',
        'departement_id',
        'description',
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }
}
