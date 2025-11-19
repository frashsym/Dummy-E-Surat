<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratTugasMengajar extends Model
{
    protected $fillable = [
        'transaksi_surat_id',
        'nama_dosen',
        'nidn_nidk',
        'prodi',
        'thn_akademik',
        'semester',
    ];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiSurat::class, 'transaksi_surat_id');
    }

    public function details()
    {
        return $this->hasMany(DetailMengajar::class, 'surat_tugas_mengajar_id');
    }
}
