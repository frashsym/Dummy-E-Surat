<?php

namespace App\Models\Surat;

use App\Models\TransaksiSurat;
use App\Models\User;
use App\Models\Detail\DetailMengajar;
use Illuminate\Database\Eloquent\Model;

class SuratTugasMengajar extends Model
{
    protected $fillable = [
        'ts_id',
        'nama_dosen',
        'nidn_nidk',
        'prodi',
        'thn_akademik',
        'semester',
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
        return $this->hasMany(DetailMengajar::class, 'surat_tugas_mengajar_id');
    }
}
