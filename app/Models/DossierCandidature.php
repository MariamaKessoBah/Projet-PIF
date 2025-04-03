<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class DossierCandidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_dossier',
        'intitule_activite',
        'etat',
        'description_activite',
        'effet_impact',
        'innovation',
        'date_debut_intervention',
        'date_fin_intervention',
        'note_finale',
        'rapport_activite',
        'fichier_ninea',
        'fichier_rccm',
        'fichier_agrement',
        'decret_creation',
        'quitus_fiscal',
        'id_prix',
        'id_structure',
        'nbr_homme_toucher',
        'nbr_femme_toucher',
        'nbr_jeune_toucher',
        'nbr_handicape_toucher'
    ];

    protected static function booted()
    {
        static::creating(function ($dossier) {
            $dossier->num_dossier = self::generateNumDossier();
        });
    }

    public static function generateNumDossier()
    {
        $currentYear = date('Y');
        $prefix = 'DPC-' . $currentYear . '-';

        $lastDossier = DB::table('dossier_candidatures')
            ->where('num_dossier', 'LIKE', $prefix . '%')
            ->orderBy('num_dossier', 'desc')
            ->first();

        if ($lastDossier) {
            $lastNumber = (int)substr($lastDossier->num_dossier, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    // Relations Many-to-Many
    public function regions()
    {
        return $this->belongsToMany(Region::class, 'region_derouler', 'id_candidature', 'id_region')
                    ->withTimestamps();
    }

    public function departements()
    {
        return $this->belongsToMany(Departement::class, 'dept_deroule', 'id_candidature', 'id_departement')
                    ->withTimestamps();
    }

    public function communes()
    {
        return $this->belongsToMany(Commune::class, 'commune_derouler', 'id_candidature', 'id_commune')
                    ->withTimestamps();
    }

    public function secteurs()
    {
        return $this->belongsToMany(SecteurIntervention::class, 'secteur_toucher', 'id_candidature', 'id_secteur')
                    ->withTimestamps();
    }

    public function cibles()
    {
        return $this->belongsToMany(CibleActivite::class, 'viser_activites', 'id_candidature', 'id_cible')
                    ->withTimestamps();
    }

    // Relation avec Structure
    public function structure()
    {
        return $this->belongsTo(Structure::class, 'id_structure');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'id_candidature');
    }
    
    // Relation avec Pays
    public function pays()
    {
        return $this->hasOne(Pays::class, 'candidature_id');
    }
}