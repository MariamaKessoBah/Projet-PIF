<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    use HasFactory;

    // Table associée
    protected $table = 'pays';

    // Colonnes modifiables
    protected $fillable = [
        'national', 'candidature_id',
    ];

    // Relation avec DossierCandidature
    public function candidature()
    {
        return $this->belongsTo(DossierCandidature::class, 'candidature_id');
    }
}
