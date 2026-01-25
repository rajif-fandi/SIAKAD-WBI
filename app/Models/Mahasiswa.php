<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'mahasiswa_id';

    protected $fillable = [
        'user_id',
        'foto',
        'npm',
        'nama',
        'angkatan',
        'semester_sekarang',
        'prodi_id',
        'no_hp',
        'no_hp_ortu',
        'email_pribadi',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'nik',
        'agama',
        'kewarganegaraan',
        'nama_ayah',
        'nama_ibu',
        'alamat_detail',
        'ukt_nominal',
        'status_beasiswa',
        'status',
        'dosen_wali_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function dosenWali()
    {
        return $this->belongsTo(Dosen::class, 'dosen_wali_id');
    }

    public function krs()
    {
        return $this->hasMany(Krs::class, 'mahasiswa_id');
    }

    public function activeKrs()
    {
        return $this->hasOne(Krs::class, 'mahasiswa_id')
            ->whereHas('semesterAjaran', function($q) {
                $q->where('is_active', true);
            });
    }

    public function khs()
    {
        return $this->hasMany(Khs::class, 'mahasiswa_id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'mahasiswa_id');
    }
}
