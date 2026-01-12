<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->decimal('bobot_kehadiran', 5, 2)->default(10.00)->after('semester_ajaran_id');
            $table->decimal('bobot_tugas', 5, 2)->default(20.00)->after('bobot_kehadiran');
            $table->decimal('bobot_uts', 5, 2)->default(30.00)->after('bobot_tugas');
            $table->decimal('bobot_uas', 5, 2)->default(40.00)->after('bobot_uts');
        });

        Schema::table('nilai', function (Blueprint $table) {
            $table->decimal('nilai_kehadiran', 5, 2)->nullable()->after('dosen_id');
            $table->decimal('nilai_tugas', 5, 2)->nullable()->after('nilai_kehadiran');
            $table->decimal('nilai_uts', 5, 2)->nullable()->after('nilai_tugas');
            $table->decimal('nilai_uas', 5, 2)->nullable()->after('nilai_uts');
        });
    }

    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropColumn(['bobot_kehadiran', 'bobot_tugas', 'bobot_uts', 'bobot_uas']);
        });

        Schema::table('nilai', function (Blueprint $table) {
            $table->dropColumn(['nilai_kehadiran', 'nilai_tugas', 'nilai_uts', 'nilai_uas']);
        });
    }
};
