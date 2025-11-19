<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPengajuanPermohonanPerpindahanKeKelasRegulerSore extends Model
{
    use HasFactory;

    protected $table = 'surat_pengajuan_permohonan_perpindahan_ke_kelas_reguler_sores';

    protected $fillable = [
        'transaksi_surat_id',
        'user_id',
        'yth',
        'nama_mhs',
        'npm',
        'prodi',
        'no_hp',
        'semester',
        'thn_akademik',
        'alasan',
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
