<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('matakuliah', function (Blueprint $table) {
            if (!Schema::hasColumn('matakuliah', 'prodi_id')) {
                $table->unsignedBigInteger('prodi_id')->nullable()->after('matakuliah_id');
                $table->foreign('prodi_id')->references('prodi_id')->on('prodi')->nullOnDelete();
            }
            if (!Schema::hasColumn('matakuliah', 'jenis')) {
                $table->enum('jenis', ['Teori', 'Praktikum', 'Gabungan'])->default('Teori')->after('sks');
            }
            if (!Schema::hasColumn('matakuliah', 'status')) {
                $table->enum('status', ['Wajib', 'Pilihan'])->default('Wajib')->after('jenis');
            }
        });

        Schema::table('kurikulum', function (Blueprint $table) {
            if (!Schema::hasColumn('kurikulum', 'status')) {
                $table->enum('status', ['Aktif', 'Arsip'])->default('Aktif')->after('tahun_berlaku');
            }
        });

        Schema::table('kelas', function (Blueprint $table) {
            if (!Schema::hasColumn('kelas', 'kapasitas')) {
                $table->integer('kapasitas')->default(40)->after('semester_ajaran_id');
            }
            if (!Schema::hasColumn('kelas', 'status')) {
                $table->enum('status', ['Aktif', 'Selesai', 'Dibatalkan'])->default('Aktif')->after('kapasitas');
            }
        });
    }

    public function down(): void
    {
        Schema::table('matakuliah', function (Blueprint $table) {
            $table->dropForeign(['prodi_id']);
            $table->dropColumn(['prodi_id', 'jenis', 'status']);
        });

        Schema::table('kurikulum', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('kelas', function (Blueprint $table) {
            $table->dropColumn(['kapasitas', 'status']);
        });
    }
};
