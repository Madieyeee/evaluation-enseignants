<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeEvaluation extends Model
{
    protected $fillable = [
        'nom',
        'date_debut',
        'date_fin',
        'est_active',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'est_active' => 'boolean',
    ];

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function scopeActive($query)
    {
        return $query->where('est_active', true);
    }

    public function scopeEnCours($query)
    {
        return $query->where('est_active', true)
            ->where('date_debut', '<=', now())
            ->where('date_fin', '>=', now());
    }

    public function getEstOuverteAttribute()
    {
        return $this->est_active && $this->date_debut <= now() && $this->date_fin >= now();
    }
}
