<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'observation',
        'etat_note',
        'note_critere',
        'etat',
        'id_critere',
        'id_candidature',
        'id_evaluateur'
    ];

    public function critere()
    {
        return $this->belongsTo(Critere::class, 'id_critere');
    }

    public function candidature()
    {
        return $this->belongsTo(DossierCandidature::class, 'id_candidature');
    }

    public function evaluateur()
    {
        return $this->belongsTo(Evaluateur::class, 'id_evaluateur');
    }
}
