<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluateur extends Model
{
    use HasFactory;

    protected $table = 'evaluateurs'; // Nom de la table

    protected $fillable = [
        'id_user',
        'structure',
        'fonction',
        'tel',
    ];

    /**
     * Relation avec l'utilisateur (User)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
