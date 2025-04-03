<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Critere extends Model
{
    use HasFactory;

    // Si le nom de la table ne suit pas la convention Laravel, vous pouvez le définir explicitement
    protected $table = 'criteres';

    // Liste des champs qui peuvent être affectés en masse
    protected $fillable = [
        'designation',
        'coefficient',
        'bareme',
        'id_prix',
    ];

    public function notes()
    {
        return $this->hasMany(Note::class, 'id_critere');
    }
}
