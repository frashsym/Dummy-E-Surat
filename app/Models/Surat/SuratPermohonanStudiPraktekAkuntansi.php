<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPermohonanStudiPraktekAkuntansi extends Model
{
    use HasFactory;

    // Field yang boleh diisi (mass assignment)
    protected $fillable = [
        'transaksi_surat_id',
        'user_id',
        'lampiran',
        'perihal',
        'tgl_mulai',
        'tgl_selesai',
        'kepada_yth',
        'nama_mhs',
        'npm',
        'tingkat_semester',
        'konsentrasi',
        'no_hp',
    ];

    /**
     * Relasi: Surat Permohonan -> Transaksi Surat
     * Banyak surat permohonan terkait 1 transaksi surat
     */
    public function transaksiSurat()
    {
        return $this->belongsTo(TransaksiSurat::class, 'transaksi_surat_id');
    }
}
