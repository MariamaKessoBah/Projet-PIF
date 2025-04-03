<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SecteurIntervention extends Model
{
    use HasFactory;

    protected $table = 'secteur_interventions'; // Nom de la table

    // Colonnes modifiables
    protected $fillable = ['designation_secteur', 'descripion_secteur'];

    // Laravel gère les timestamps automatiquement
    public $timestamps = false;
}
