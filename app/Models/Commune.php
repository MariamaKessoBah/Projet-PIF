<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Commune extends Model
{
    use HasFactory;

    protected $table = 'communes'; // Nom de la table

    // Colonnes modifiables
    protected $fillable = ['nom_commune', 'id_departement'];

    // Laravel gère les timestamps automatiquement
    public $timestamps = true;
}
