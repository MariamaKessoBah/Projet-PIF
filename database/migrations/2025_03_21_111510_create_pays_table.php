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
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->string('national'); // Utiliser 'nom_pays' pour plus de clarté
            $table->unsignedBigInteger('candidature_id'); // Clé étrangère pour la candidature

            $table->timestamps();

            // Définir la clé étrangère avec la table 'dossier_candidatures'
            $table->foreign('candidature_id')->references('id')->on('dossier_candidatures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pays');
    }
};
