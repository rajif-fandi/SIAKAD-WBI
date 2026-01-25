<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;

    protected $table = 'kurikulum';
    protected $primaryKey = 'kurikulum_id';
    protected $fillable = ['prodi_id', 'nama_kurikulum', 'tahun_berlaku', 'status', 'created_by'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function matakuliah()
    {
        return $this->belongsToMany(Matakuliah::class, 'kurikulum_matkul', 'kurikulum_id', 'matkul_id')
                    ->withPivot(['semester_ke', 'tipe_semester', 'wajib']);
    }
}
