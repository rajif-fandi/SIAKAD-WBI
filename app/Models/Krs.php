<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $table = 'krs';
    protected $primaryKey = 'krs_id';
    protected $fillable = ['mahasiswa_id', 'semester_ajaran_id', 'status', 'total_sks', 'tanggal_pengajuan', 'tanggal_validasi', 'catatan'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function semesterAjaran()
    {
        return $this->belongsTo(SemesterAjaran::class, 'semester_ajaran_id');
    }

    public function details()
    {
        return $this->hasMany(KrsDetail::class, 'krs_id');
    }
}
