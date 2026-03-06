<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $fillable = [
        'nom',
        'code',
        'description',
        'enseignant_id',
        'filiere_id',
        'volume_horaire',
        'credits',
    ];

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
