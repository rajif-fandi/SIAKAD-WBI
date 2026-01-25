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
            $table->string('nik', 16)->nullable()->after('nama');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('nik');
            $table->string('tempat_lahir')->nullable()->after('tanggal_lahir');
            $table->string('bidang_keahlian')->nullable()->after('no_hp');
            $table->string('sinta_id')->nullable()->after('bidang_keahlian');
            $table->string('status_kepegawaian')->nullable()->after('sinta_id');
            $table->string('status_dosen')->nullable()->after('status_kepegawaian');
            $table->date('tanggal_mulai')->nullable()->after('status_dosen');
            $table->string('no_sertifikat')->nullable()->after('tanggal_mulai');
            
            // S1
            $table->string('s1_univ')->nullable();
            $table->string('s1_prodi')->nullable();
            $table->string('s1_tahun')->nullable();
            $table->string('s1_gelar')->nullable();
            
            // S2
            $table->string('s2_univ')->nullable();
            $table->string('s2_prodi')->nullable();
            $table->string('s2_tahun')->nullable();
            $table->string('s2_gelar')->nullable();
            
            // S3
            $table->string('s3_univ')->nullable();
            $table->string('s3_prodi')->nullable();
            $table->string('s3_tahun')->nullable();
            $table->string('s3_gelar')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->dropColumn([
                'nik', 'jenis_kelamin', 'tempat_lahir', 'bidang_keahlian', 'sinta_id',
                'status_kepegawaian', 'status_dosen', 'tanggal_mulai', 'no_sertifikat',
                's1_univ', 's1_prodi', 's1_tahun', 's1_gelar',
                's2_univ', 's2_prodi', 's2_tahun', 's2_gelar',
                's3_univ', 's3_prodi', 's3_tahun', 's3_gelar'
            ]);
        });
    }
};
