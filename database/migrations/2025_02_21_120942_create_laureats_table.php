<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('laureats', function (Blueprint $table) {
            $table->id();
            $table->integer('rang')->nullable(); // Ajout du rang
            $table->date('date_selection')->useCurrent(); // Utilisation correcte du default now()
            $table->unsignedBigInteger('candidature_id'); // Clé étrangère pour la candidature
            $table->string('observation_jury')->nullable(); // Correction du double point-virgule
            $table->timestamps();

            // Clé étrangère
            $table->foreign('candidature_id')->references('id')->on('dossier_candidatures')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('laureats');
    }
};
