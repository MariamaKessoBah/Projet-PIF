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
        Schema::create('communes', function (Blueprint $table) {
            $table->id();
            $table->string('nom_commune');
            // Clé étrangère vers la table service_roles
            $table->unsignedBigInteger('id_departement');
            $table->foreign('id_departement')
                  ->references('id') 
                  ->on('departements') 
                  ->onDelete('cascade'); // Suppression en cascade

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communes');
    }
};
