<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions'; // Nom de la table

    // Propriétés $fillable ou $guarded si nécessaire
    protected $fillable = ['nom_region']; // Colonnes modifiables

    // Laravel gère les timestamps automatiquement
    public $timestamps = true;
}
