<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPermohonanCutiAktifMengundurkanDiri extends Model
{
    use HasFactory;

    protected $fillable = [
        'ts_id',
        'user_id',
        'perihal',
        'yth',
        'nama_mhs',
        'npm',
        'prodi',
        'fakultas',
        'no_hp',
        'semester',
        'thn_akademik',
        'alasan',
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
