<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailMhsObservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'surat_observasi_id',
        'nama_mhs',
        'nim',
        'prodi',
        'no_hp',
        'dosen_pembimbing',
    ];

    public function suratObservasi()
    {
        return $this->belongsTo(SuratPermohonanIzinObservasi::class, 'surat_observasi_id');
    }
}
