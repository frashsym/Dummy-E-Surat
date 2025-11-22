<?php

namespace App\Models\Surat;

use App\Models\TransaksiSurat;
use App\Models\User;
use App\Models\Detail\DetailMhsObservasi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPermohonanIzinObservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'ts_id',
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

    public function transaksiSurat()
    {
        return $this->belongsTo(TransaksiSurat::class, 'ts_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details()
    {
        return $this->hasMany(DetailMhsObservasi::class, 'surat_observasi_id');
    }
}
