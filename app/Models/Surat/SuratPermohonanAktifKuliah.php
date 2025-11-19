<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPermohonanAktifKuliah extends Model
{
    use HasFactory;

    protected $table = 'surat_permohonan_aktif_kuliahs';

    protected $fillable = [
        'transaksi_surat_id',
        'user_id',
        'perihal',
        'yth',
        'nama_mhs',
        'npm',
        'prodi',
        'fakultas',
        'no_hp',
        'semester',
        'thn_akademik',
        'alasan',
    ];

    public function transaksiSurat()
    {
        return $this->belongsTo(\App\Models\TransaksiSurat::class, 'transaksi_surat_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
