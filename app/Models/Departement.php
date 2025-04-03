<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departement extends Model
{
    use HasFactory;

    protected $table = 'departements'; // Nom de la table

    // Colonnes modifiables
    protected $fillable = ['nom_departement', 'id_region'];

    // Laravel gère les timestamps automatiquement
    public $timestamps = true;
}
