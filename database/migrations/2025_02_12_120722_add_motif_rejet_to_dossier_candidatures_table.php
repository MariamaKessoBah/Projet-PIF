<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('dossier_candidatures', function (Blueprint $table) {
            $table->text('motif_rejet')->nullable()->after('etat'); // Ajoutez la colonne motif_rejet après la colonne "etat"
        });
    }
    
    public function down()
    {
        Schema::table('dossier_candidatures', function (Blueprint $table) {
            $table->dropColumn('motif_rejet');
        });
    }
    
};
