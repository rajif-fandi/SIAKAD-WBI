<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SemesterAjaran extends Model
{
    protected $table = 'semester_ajaran';
    protected $primaryKey = 'semester_ajaran_id';
    protected $fillable = ['tahun_ajaran', 'semester', 'is_active'];

    public function getNamaSemesterAttribute()
    {
        return $this->tahun_ajaran . ' ' . ucfirst($this->semester);
    }
}
