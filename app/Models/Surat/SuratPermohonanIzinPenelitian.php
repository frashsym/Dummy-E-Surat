<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPermohonanIzinPenelitian extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_surat_id',
        'user_id',
        'lampiran',
        'perihal',
        'kepada_yth',
        'nama_mhs',
        'npm',
        'tingkat_semester',
        'prodi_konsen',
        'no_hp',
        'dosen_kolab',
        'tmpt_penelitian',
    ];

    /**
     * Relasi ke transaksi surat
     */
    public function transaksiSurat()
    {
        return $this->belongsTo(TransaksiSurat::class, 'transaksi_surat_id');
    }
}
