<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganMasihKuliahDenganOrtu extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan_masih_kuliah_ortu_details';

    protected $fillable = [
        'transaksi_surat_id',
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
        return $this->belongsTo(TransaksiSurat::class, 'transaksi_surat_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
