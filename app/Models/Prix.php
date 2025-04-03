<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prix extends Model
{
    protected $table = 'prix'; // Nom de la table

    // Colonnes modifiables
    protected $fillable = ['designation', 'annee','etat'];

    // Laravel gère les timestamps automatiquement
    public $timestamps = true;
}
