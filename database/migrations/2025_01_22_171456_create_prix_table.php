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
        Schema::create('prix', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->integer('annee')->unique();
            $table->date('date_ouverture');
            $table->date('date_cloture_depot_dossier');
            $table->date('date_cloture');
            $table->enum('etat', ['en_attente','ouvert', 'fermé'])->default('en_attente'); // État de la tâche
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prix');
    }
};
