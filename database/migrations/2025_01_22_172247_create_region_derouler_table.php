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
        Schema::create('region_derouler', function (Blueprint $table) {
            // Clé étrangère vers la table service_roles
            $table->unsignedBigInteger('id_candidature');
            $table->foreign('id_candidature')
                  ->references('id') 
                  ->on('dossier_candidatures') 
                  ->onDelete('cascade'); // Suppression en cascade

                  // Clé étrangère vers la table service_roles
                  $table->unsignedBigInteger('id_region');
                  $table->foreign('id_region')
                        ->references('id') 
                        ->on('regions') 
                        ->onDelete('cascade'); // Suppression en cascade
                        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('region_derouler');
    }
};
