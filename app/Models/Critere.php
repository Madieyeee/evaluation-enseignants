<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Critere extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'ordre',
        'est_actif',
    ];

    protected $casts = [
        'est_actif' => 'boolean',
    ];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function scopeActifs($query)
    {
        return $query->where('est_actif', true)->orderBy('ordre');
    }
}
