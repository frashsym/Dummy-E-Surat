<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TransaksiSurat;

class SuratPermohonanStudiPraktekManajemen extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_surat_id',
        'user_id',
        'lampiran',
        'perihal',
        'kepada_yth',
        'tgl_mulai',
        'tgl_selesai',
        'nim',
        'nama_mhs',
        'tingkat_semester',
        'konsentrasi',
        'no_hp',
    ];

    public function transaksiSurat()
    {
        return $this->belongsTo(TransaksiSurat::class, 'transaksi_surat_id');
    }
}
