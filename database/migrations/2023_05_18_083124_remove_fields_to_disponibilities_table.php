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
        Schema::table('disponibilities', function (Blueprint $table) {
            $table->dropColumn('jours');
            $table->dropColumn('mois');
            $table->date('debut')->change();
            $table->date('fin')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disponibilities', function (Blueprint $table) {
            //
        });
    }
};