<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $primaryKey = 'jadwal_id';
    protected $fillable = ['kelas_id', 'ruangan_id', 'hari', 'jam_mulai', 'jam_selesai'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function pertemuans()
    {
        return $this->hasMany(Pertemuan::class, 'jadwal_id');
    }

    public function getEnrolledStudentsCount()
    {
        return $this->kelas->krsDetails()->whereHas('krs', function($q) {
            $q->whereIn('status', ['disetujui_wali', 'verified']);
        })->count();
    }
}
