<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = [
        'nom',
        'code',
        'description',
    ];

    public function enseignants()
    {
        return $this->hasMany(Enseignant::class);
    }

    public function filieres()
    {
        return $this->hasMany(Filiere::class);
    }
}
