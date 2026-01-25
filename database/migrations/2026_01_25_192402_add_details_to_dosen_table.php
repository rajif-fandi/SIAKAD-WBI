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
        Schema::table('dosen', function (Blueprint $table) {
            if (!Schema::hasColumn('dosen', 'nik')) $table->string('nik', 20)->nullable()->after('nama');
            if (!Schema::hasColumn('dosen', 'tempat_lahir')) $table->string('tempat_lahir', 100)->nullable()->after('tanggal_lahir');
            if (!Schema::hasColumn('dosen', 'jenis_kelamin')) $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('tempat_lahir');
            if (!Schema::hasColumn('dosen', 'bidang_keahlian')) $table->string('bidang_keahlian', 150)->nullable()->after('jabatan');
            if (!Schema::hasColumn('dosen', 'sinta_id')) $table->string('sinta_id', 50)->nullable()->after('bidang_keahlian');
            if (!Schema::hasColumn('dosen', 'status_kepegawaian')) $table->string('status_kepegawaian', 50)->nullable()->after('sinta_id');
            if (!Schema::hasColumn('dosen', 'status_dosen')) $table->string('status_dosen', 50)->default('Aktif')->after('status_kepegawaian');
            if (!Schema::hasColumn('dosen', 'tanggal_mulai')) $table->date('tanggal_mulai')->nullable()->after('status_dosen');
            if (!Schema::hasColumn('dosen', 'no_sertifikat')) $table->string('no_sertifikat', 100)->nullable()->after('tanggal_mulai');
            
            // Education
            if (!Schema::hasColumn('dosen', 's1_univ')) $table->string('s1_univ')->nullable();
            if (!Schema::hasColumn('dosen', 's1_prodi')) $table->string('s1_prodi')->nullable();
            if (!Schema::hasColumn('dosen', 's1_tahun')) $table->year('s1_tahun')->nullable();
            if (!Schema::hasColumn('dosen', 's1_gelar')) $table->string('s1_gelar')->nullable();
            
            if (!Schema::hasColumn('dosen', 's2_univ')) $table->string('s2_univ')->nullable();
            if (!Schema::hasColumn('dosen', 's2_prodi')) $table->string('s2_prodi')->nullable();
            if (!Schema::hasColumn('dosen', 's2_tahun')) $table->year('s2_tahun')->nullable();
            if (!Schema::hasColumn('dosen', 's2_gelar')) $table->string('s2_gelar')->nullable();
            
            if (!Schema::hasColumn('dosen', 's3_univ')) $table->string('s3_univ')->nullable();
            if (!Schema::hasColumn('dosen', 's3_prodi')) $table->string('s3_prodi')->nullable();
            if (!Schema::hasColumn('dosen', 's3_tahun')) $table->year('s3_tahun')->nullable();
            if (!Schema::hasColumn('dosen', 's3_gelar')) $table->string('s3_gelar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->dropColumn([
                'nik', 'tempat_lahir', 'jenis_kelamin', 'bidang_keahlian', 
                'sinta_id', 'status_kepegawaian', 'status_dosen', 'tanggal_mulai', 'no_sertifikat',
                's1_univ', 's1_prodi', 's1_tahun', 's1_gelar',
                's2_univ', 's2_prodi', 's2_tahun', 's2_gelar',
                's3_univ', 's3_prodi', 's3_tahun', 's3_gelar'
            ]);
        });
    }
};
