<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';
    protected $primaryKey = 'matakuliah_id';
    protected $fillable = ['kode_mk', 'nama_mk', 'sks', 'semester_paket', 'deskripsi', 'prodi_id', 'jenis', 'status'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'matakuliah_id');
    }

    public function kurikulum()
    {
        return $this->belongsToMany(Kurikulum::class, 'kurikulum_matkul', 'matkul_id', 'kurikulum_id')
                    ->withPivot(['semester_ke', 'tipe_semester', 'wajib']);
    }
}
