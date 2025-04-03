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
        Schema::table('evaluateurs', function (Blueprint $table) {
            // Suppression des colonnes existantes si elles existent
            if (Schema::hasColumn('evaluateurs', 'origine_structure')) {
                $table->dropColumn('origine_structure');
            }
            if (Schema::hasColumn('evaluateurs', 'nom')) {
                $table->dropColumn('nom');
            }
            if (Schema::hasColumn('evaluateurs', 'prenom')) {
                $table->dropColumn('prenom');
            }
            if (Schema::hasColumn('evaluateurs', 'id_prix')) {
                $table->dropForeign(['id_prix']); // Supprimer la clé étrangère
                $table->dropColumn('id_prix');
            }

            // Ajout de la colonne user_id si elle n'existe pas
            if (!Schema::hasColumn('evaluateurs', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
                // Ajout de la clé étrangère pour la suppression en cascade
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluateurs', function (Blueprint $table) {
            // Restauration des colonnes supprimées dans le "down"
            $table->string('origine_structure')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->unsignedBigInteger('id_prix')->nullable();
            $table->foreign('id_prix')->references('id')->on('prix')->onDelete('cascade');

            // Suppression de la clé étrangère 'user_id'
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};

