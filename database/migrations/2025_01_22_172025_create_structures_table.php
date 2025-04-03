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
        Schema::create('structures', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('nom_structure');
            $table->string('siege_social');
            $table->date('date_creation');
            $table->integer('tel_structure');
            $table->string('ninea')->nullable();
            $table->string('agreement')->nullable();
            $table->string('num_decret')->nullable();
            $table->string('registre_commerce')->nullable();
            $table->integer('nbre_membre');
            $table->string('nom_contact');
            $table->string('prenom_contact');
            $table->string('fonction_contact');
            $table->integer('tel_contact');
            $table->string('email_contact');
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
        Schema::dropIfExists('structures');
    }
};
