<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;

    protected $table = 'pertemuan';
    protected $primaryKey = 'pertemuan_id';
    protected $fillable = ['jadwal_id', 'tanggal', 'pertemuan_ke', 'materi_pembahasan', 'catatan'];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function presensis()
    {
        return $this->hasMany(Presensi::class, 'pertemuan_id');
    }
}
