<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';
    protected $fillable = [
        'mahasiswa_id', 
        'kelas_id', 
        'dosen_id', 
        'nilai_kehadiran', 
        'nilai_tugas', 
        'nilai_uts', 
        'nilai_uas', 
        'nilai_angka', 
        'nilai_huruf', 
        'bobot', 
        'status_kunci'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}
