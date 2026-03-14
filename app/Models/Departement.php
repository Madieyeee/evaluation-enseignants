<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Département académique (regroupe des filières et des enseignants).
 */
class Departement extends Model
{
    /**
     * Attributs modifiables en masse.
     */
    protected $fillable = [
        'nom',
        'code',
        'description',
    ];

    /**
     * Enseignants rattachés à ce département.
     */
    public function enseignants()
    {
        return $this->hasMany(Enseignant::class);
    }

    /**
     * Filières rattachées à ce département.
     */
    public function filieres()
    {
        return $this->hasMany(Filiere::class);
    }
}
