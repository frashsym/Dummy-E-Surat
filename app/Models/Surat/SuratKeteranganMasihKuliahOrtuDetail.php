<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganMasihKuliahOrtuDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'ts_id',
        'user_id',
        'nama_dosen',
        'nidn',
        'jabatan_dosen',
        'pada_perguruan_tinggi',
        'nama_mhs',
        'npm',
        'tk_semester',
        'prodi',
        'thn_akademik',
        'no_hp',
        'nama_ortu',
        'nip_nrp_nik',
        'pangkat_gol_ruang',
        'instansi_perusahaan',
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
