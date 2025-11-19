<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPermohonanCutiAktifMengundurkanDiri extends Model
{
    use HasFactory;

    protected $table = 'surat_permohonan_cuti_aktif_mengundurkan_diris';

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
