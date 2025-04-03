<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('dossier_candidatures', function (Blueprint $table) {
            // Recréation de la colonne 'etat' avec l'ajout de 'rejeté'
            $table->enum('etat', ['en_attente', 'validé', 'évalué', 'terminé', 'rejeté'])->default('en_attente')->change();
        });
    }
    
    public function down(): void
    {
        Schema::table('dossier_candidatures', function (Blueprint $table) {
            // Restauration de la colonne 'etat' sans 'rejeté'
            $table->enum('etat', ['en_attente', 'validé', 'évalué', 'terminé'])->default('en_attente')->change();
        });
    }
    
};
