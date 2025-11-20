<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPermohonanStudiPraktekAkuntansi extends Model
{
    use HasFactory;

    // Field yang boleh diisi (mass assignment)
    protected $fillable = [
        'ts_id',
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
        return $this->belongsTo(TransaksiSurat::class, 'ts_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
