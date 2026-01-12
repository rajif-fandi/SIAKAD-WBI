<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $primaryKey = 'jadwal_id';
    protected $fillable = ['kelas_id', 'hari', 'jam_mulai', 'jam_selesai', 'ruangan'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
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
