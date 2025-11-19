<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPermohonanPindahKuliah extends Model
{
    use HasFactory;

    protected $table = 'surat_permohonan_pindah_kuliahs';

    protected $fillable = [
        'transaksi_surat_id',
        'user_id',
        'yth',
        'nama_mhs',
        'npm',
        'prodi',
        'fakultas',
        'no_hp',
        'nama_ortu',
    ];

    public function transaksiSurat()
    {
        return $this->belongsTo(\App\Models\TransaksiSurat::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
