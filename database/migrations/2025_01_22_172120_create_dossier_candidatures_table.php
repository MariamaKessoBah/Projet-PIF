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
        Schema::create('dossier_candidatures', function (Blueprint $table) {
            $table->id();
            $table->string('num_dossier')->unique();
            $table->string('intitule_activite');
            $table->enum('etat', ['en_attente','validé', 'évalué', 'terminé'])->default('en_attente'); // État de la tâche
            $table->text('description_activite');
            $table->text('effet_impact');
            $table->text('innovation');
            $table->date('date_debut_intervention');
            $table->date('date_fin_intervention');
            // Colonnes pour les fichiers joints
            $table->string('rapport_activite');
            $table->string('fichier_ninea')->nullable();
            $table->string('fichier_rccm')->nullable();
            $table->string('fichier_agrement')->nullable();
            $table->string('decret_creation')->nullable();
            $table->string('quitus_fiscal')->nullable();
            $table->integer('nbr_homme_toucher')->nullable();
            $table->integer('nbr_femme_toucher')->nullable();
            $table->integer('nbr_jeune_toucher')->nullable();
            $table->integer('nbr_handicape_toucher')->nullable();
            
            // Clé étrangère vers la table service_roles
            $table->unsignedBigInteger('id_prix');
            $table->foreign('id_prix')
                  ->references('id') 
                  ->on('prix') 
                  ->onDelete('cascade'); // Suppression en cascade

                  // Clé étrangère vers la table service_roles
            $table->unsignedBigInteger('id_structure');
            $table->foreign('id_structure')
                  ->references('id') 
                  ->on('structures') 
                  ->onDelete('cascade'); // Suppression en cascade
            
            $table->decimal('note_finale', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossier_candidatures');
    }
};
