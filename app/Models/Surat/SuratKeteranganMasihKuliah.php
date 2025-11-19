<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganMasihKuliah extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan_masih_kuliahs';

    protected $fillable = [
        'transaksi_surat_id',
        'user_id',
        'nama_dosen',
        'nidn',
        'jabatan_dosen',
        'pada_perguruan_tinggi',
        'nama_mhs',
        'nim',
        'prodi',
        'tingkat_semester',
        'thn_akademik',
    ];

    public function transaksiSurat()
    {
        return $this->belongsTo(TransaksiSurat::class, 'transaksi_surat_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
