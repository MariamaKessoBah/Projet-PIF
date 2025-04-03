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
        Schema::table('notes', function (Blueprint $table) {
            // Supprimer la clé étrangère 'id_user' existante
            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');
    
            // Ajouter la nouvelle clé étrangère 'id_evaluateur'
            $table->unsignedBigInteger('id_evaluateur');
            $table->foreign('id_evaluateur')
                  ->references('id')
                  ->on('evaluateurs') // La table des évaluateurs
                  ->onDelete('cascade'); // Suppression en cascade
        });
    }
    
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            // Supprimer la clé étrangère 'id_evaluateur' et la colonne
            $table->dropForeign(['id_evaluateur']);
            $table->dropColumn('id_evaluateur');
    
            // Restauration de l'ancienne clé étrangère 'id_user'
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                  ->references('id')
                  ->on('users') // La table des utilisateurs
                  ->onDelete('cascade'); // Suppression en cascade
        });
    }
    
};
