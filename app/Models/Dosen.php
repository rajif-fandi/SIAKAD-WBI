<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'dosen_id';

    protected $fillable = [
        'user_id', 
        'nip', 
        'nama',
        'nik',
        'jenis_kelamin',
        'tanggal_lahir', 
        'tempat_lahir',
        'alamat_detail', 
        'no_hp', 
        'bidang_keahlian',
        'sinta_id',
        'status_kepegawaian',
        'status_dosen',
        'tanggal_mulai',
        'no_sertifikat',
        'prodi_id', 
        'is_wali', 
        'jabatan',
        's1_univ', 's1_prodi', 's1_tahun', 's1_gelar',
        's2_univ', 's2_prodi', 's2_tahun', 's2_gelar',
        's3_univ', 's3_prodi', 's3_tahun', 's3_gelar'
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bimbingan()
    {
        return $this->hasMany(Mahasiswa::class, 'dosen_wali_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
