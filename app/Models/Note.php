<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Note donnée pour un critère précis dans le cadre d'une évaluation.
 */
class Note extends Model
{
    /**
     * Attributs modifiables en masse.
     */
    protected $fillable = [
        'evaluation_id',
        'critere_id',
        'note',
        'commentaire',
    ];

    /**
     * Casting des attributs.
     */
    protected $casts = [
        'note' => 'integer',
    ];

    /**
     * Évaluation à laquelle cette note appartient.
     */
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    /**
     * Critère concerné par cette note.
     */
    public function critere()
    {
        return $this->belongsTo(Critere::class);
    }
}
