<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Surat extends Model
{
    use HasFactory, SoftDeletes;

    // Nama tabel (opsional, sesuai konvensi Laravel)
    protected $table = 'surats';

    use SoftDeletes;

    protected $fillable = [
        'template_id',
        'header_logo',
        'header_info',

        'nomor',
        'perihal',
        'jenis',
        'kepada_yth',
        'tujuan',
        'tanggal_surat',
        'tanggal_diterima',

        // mahasiswa manual
        'mhs_nama',
        'mhs_npm',
        'mhs_tingkat',
        'mhs_semester',
        'mhs_konsentrasi',
        'mhs_nohp',

        // penandatangan manual
        'penandatangan_jabatan',
        'penandatangan_nama',
        'penandatangan_signature',

        'pengirim',
        'penerima',

        'isi_html',
        'lampiran',
        'status',
    ];

    protected $casts = [
        'header_info' => 'array',
        'tanggal_surat' => 'date',
        'tanggal_diterima' => 'date',
    ];

    public function pengirimUser()
    {
        return $this->belongsTo(User::class, 'pengirim');
    }

    public function penerimaUser()
    {
        return $this->belongsTo(User::class, 'penerima');
    }

    public function template()
    {
        return $this->belongsTo(TemplateSurat::class, 'template_id');
    }

    /**
     * Contoh accessor (opsional)
     * Mengambil status dengan format huruf besar di awal.
     */
    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }
}
