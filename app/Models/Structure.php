<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Structure extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_structure',
        'type',
        'siege_social',
        'date_creation',
        'tel_structure',
        'ninea',
        'agreement',
        'num_decret',
        'statut_juridique',
        'registre_commerce',
        'nom_contact',
        'prenom_contact',
        'fonction_contact',
        'tel_contact',
        'email_contact',
        'id_user',
    ];
}
