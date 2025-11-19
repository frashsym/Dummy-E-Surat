<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPermohonanIzinObservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_surat_id',
        'user_id',
        'lampiran',
        'perihal',
        'kepada_yth',
        'tgl_pelaksanaan',
        'nama_mhs',
        'nim',
        'prodi',
        'no_hp',
        'dosen_pembimbing',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(TransaksiSurat::class, 'transaksi_surat_id');
    }

    public function details()
    {
        return $this->hasMany(DetaIlMhsObservasi::class, 'surat_observasi_id');
    }
}
