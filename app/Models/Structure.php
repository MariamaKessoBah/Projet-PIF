<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Structure extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_structure',
        'siege_social',
        'date_creation',
        'tel_structure',
        'ninea_',
        'registre_commerce',
        'agreement',
        'numdecret',
        'nbre_membre',
        'nom_contact',
        'prenom_contact',
        'fonction_contact',
        'tel_contact',
        'email_contact',
        'id_user',
    ];
}
