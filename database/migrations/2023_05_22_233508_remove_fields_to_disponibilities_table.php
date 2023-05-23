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
            $table->time('debut')->change();
            $table->time('fin')->change();
            $table->dropColumn('etat');
            $table->string('jours')->nullable();
            //$table->time('debut')->nullable();
            //$table->time('fin')->nullable();
            $table->time('duration')->nullable();
            $table->time('break_begin')->nullable();
            $table->time('break_end')->nullable();

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
