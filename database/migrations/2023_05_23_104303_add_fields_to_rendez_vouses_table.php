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
        Schema::table('rendez_vouses', function (Blueprint $table) {
            $table->boolean('contrat')->default(0);
            $table->string('heure_debut')->nullable();
            $table->string('heure_fin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rendez_vouses', function (Blueprint $table) {
            //
        });
    }
};
