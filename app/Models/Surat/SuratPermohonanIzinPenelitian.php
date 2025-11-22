<?php

namespace App\Models\Surat;

use App\Models\TransaksiSurat;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPermohonanIzinPenelitian extends Model
{
    use HasFactory;

    protected $fillable = [
        'ts_id',
        'user_id',
        'lampiran',
        'perihal',
        'kepada_yth',
        'nama_mhs',
        'npm',
        'tingkat_semester',
        'prodi_konsen',
        'no_hp',
        'dosen_kolab',
        'tmpt_penelitian',
    ];

    /**
     * Relasi ke transaksi surat
     */
    public function transaksiSurat()
    {
        return $this->belongsTo(TransaksiSurat::class, 'ts_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
