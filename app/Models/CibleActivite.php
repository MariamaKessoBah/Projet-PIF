<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CibleActivite extends Model
{
    protected $table = 'cible_activites'; // Nom de la table

    // Colonnes modifiables
    protected $fillable = ['designation_cible'];

    // Laravel gère les timestamps automatiquement
    public $timestamps = true;
}
