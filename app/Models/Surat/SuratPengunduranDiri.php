<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratPengunduranDiri extends Model
{
    protected $fillable = [
        'transaksi_surat_id',
        'yth',
        'nama_mhs',
        'npm',
        'tingkat_semester',
        'prodi',
        'nama_ortu',
    ];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiSurat::class, 'transaksi_surat_id');
    }
}
