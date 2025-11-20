<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPermohonanPindahKuliah extends Model
{
    use HasFactory;

    protected $table = 'surat_permohonan_pindah_kuliahs';

    protected $fillable = [
        'ts_id',
        'user_id',
        'yth',
        'nama_mhs',
        'npm',
        'prodi',
        'fakultas',
        'no_hp',
        'nama_ortu',
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
