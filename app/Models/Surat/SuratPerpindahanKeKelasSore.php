<?php

namespace App\Models\Surat;

use App\Models\TransaksiSurat;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPerpindahanKeKelasSore extends Model
{
    use HasFactory;

    protected $table = 'surat_pengajuan_permohonan_perpindahan_ke_kelas_reguler_sores';

    protected $fillable = [
        'ts_id',
        'user_id',
        'yth',
        'nama_mhs',
        'npm',
        'prodi',
        'no_hp',
        'semester',
        'thn_akademik',
        'alasan',
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
