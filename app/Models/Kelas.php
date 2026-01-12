<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'kelas_id';
    protected $fillable = [
        'kode_kelas', 
        'matakuliah_id', 
        'prodi_id', 
        'semester_ajaran_id',
        'bobot_kehadiran',
        'bobot_tugas',
        'bobot_uts',
        'bobot_uas'
    ];

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'matakuliah_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function semesterAjaran()
    {
        return $this->belongsTo(SemesterAjaran::class, 'semester_ajaran_id');
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'kelas_id');
    }

    public function dosenPengampu()
    {
        return $this->hasMany(DosenPengampu::class, 'kelas_id');
    }

    public function krsDetails()
    {
        return $this->hasMany(KrsDetail::class, 'kelas_id');
    }
}
