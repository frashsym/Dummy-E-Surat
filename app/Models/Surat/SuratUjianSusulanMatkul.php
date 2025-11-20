<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratUjianSusulanMatkul extends Model
{
    protected $fillable = [
        'ts_id',
        'lampiran',
        'perihal',
        'kepada',
        'nama_mhs',
        'npm',
        'tingkat_semester',
        'prodi',
        'matkul',
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
