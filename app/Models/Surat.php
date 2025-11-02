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

    // Kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'nomor_surat',
        'jenis_surat',
        'perihal',
        'tanggal_surat',
        'tanggal_diterima',
        'pengirim',
        'penerima',
        'isi_singkat',
        'lampiran',
        'status',
        'user_id',
    ];

    // Jika kamu ingin meng-cast tanggal agar otomatis jadi Carbon instance
    protected $casts = [
        'tanggal_surat' => 'date',
        'tanggal_diterima' => 'date',
    ];

    /**
     * Relasi ke model User (pembuat surat)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
