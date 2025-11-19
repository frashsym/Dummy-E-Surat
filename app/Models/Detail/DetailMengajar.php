<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailMengajar extends Model
{
    protected $fillable = [
        'surat_tugas_mengajar_id',
        'mata_kuliah',
        'kode_mk',
        'kelas',
        'sks',
        'tanggal',
        'ruang',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function surat()
    {
        return $this->belongsTo(SuratTugasMengajar::class, 'surat_tugas_mengajar_id');
    }
}
