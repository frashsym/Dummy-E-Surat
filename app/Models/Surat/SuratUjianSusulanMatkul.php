<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratUjianSusulanMatkul extends Model
{
    protected $fillable = [
        'transaksi_surat_id',
        'lampiran',
        'perihal',
        'kepada',
        'nama_mhs',
        'npm',
        'tingkat_semester',
        'prodi',
        'matkul',
    ];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiSurat::class, 'transaksi_surat_id');
    }
}
