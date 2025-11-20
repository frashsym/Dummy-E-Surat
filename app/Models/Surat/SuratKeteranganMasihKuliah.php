<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganMasihKuliah extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan_masih_kuliahs';

    protected $fillable = [
        'ts_id',
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
        return $this->belongsTo(TransaksiSurat::class, 'ts_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
