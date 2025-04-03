<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laureat extends Model
{
    use HasFactory;

    // Table associée au modèle
    protected $table = 'laureats';  // Pas besoin de spécifier si c'est déjà au pluriel (Laravel le fait par défaut)

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'candidature_id', 'rang', 'date_selection', 'observation_jury'
    ];

    // Si tu veux avoir la relation avec le modèle Candidature
    public function candidature()
    {
        return $this->belongsTo(DossierCandidature::class, 'candidature_id');
    }

    // Si tu veux avoir une relation avec les évaluateurs ou tout autre modèle (optionnel)
    // public function evaluateur()
    // {
    //     return $this->belongsTo(Evaluateur::class);
    // }
}
