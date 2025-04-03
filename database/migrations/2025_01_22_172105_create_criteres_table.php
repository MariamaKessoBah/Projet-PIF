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
        Schema::create('criteres', function (Blueprint $table) {
            $table->id();
            $table->integer('coefficient');
            $table->string('designation');
            $table->integer('bareme');

            // Clé étrangère vers la table service_roles
            $table->unsignedBigInteger('id_prix');
            $table->foreign('id_prix')
                  ->references('id') 
                  ->on('prix') 
                  ->onDelete('cascade'); // Suppression en cascade

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteres');
    }
};
