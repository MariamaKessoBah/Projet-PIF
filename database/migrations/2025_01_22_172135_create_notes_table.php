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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->text('observation')->nullable();
            $table->string('etat_note');
            $table->integer('note_critere');
            $table->enum('etat', ['en_attente','enregistré', 'validé'])->default('en_attente'); // État de la tâche


             // Clé étrangère vers la table service_roles
             $table->unsignedBigInteger('id_critere');
             $table->foreign('id_critere')
                   ->references('id') 
                   ->on('criteres') 
                   ->onDelete('cascade'); // Suppression en cascade
 
                   // Clé étrangère vers la table service_roles
             $table->unsignedBigInteger('id_candidature');
             $table->foreign('id_candidature')
                   ->references('id') 
                   ->on('dossier_candidatures') 
                   ->onDelete('cascade'); // Suppression en cascade

                      // Clé étrangère vers la table service_roles
             $table->unsignedBigInteger('id_user');
             $table->foreign('id_user')
                   ->references('id') 
                   ->on('users') 
                   ->onDelete('cascade'); // Suppression en cascade
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
