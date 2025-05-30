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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('prenom');
            $table->string('nom');

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
        Schema::dropIfExists('admins');
    }
};
