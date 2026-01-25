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
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropColumn('ruangan');
            // Change hari to string to accommodate 'Senin', 'Selasa', etc.
            $table->string('hari', 20)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal', function (Blueprint $table) {
            $table->string('ruangan', 50);
            $table->enum('hari', ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'])->change();
        });
    }
};
