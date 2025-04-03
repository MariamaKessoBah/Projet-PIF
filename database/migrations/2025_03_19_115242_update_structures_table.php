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
        Schema::table('structures', function (Blueprint $table) {
            $table->string('statut_juridique')->nullable()->after('num_decret');
            $table->dropColumn('nbre_membre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('structures', function (Blueprint $table) {
            $table->integer('nbre_membre')->after('registre_commerce');
            $table->dropColumn('statut_juridique');
        });
    }
};
