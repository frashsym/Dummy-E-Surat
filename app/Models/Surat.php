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
        'jenis',
        'tujuan',
        'tanggal_surat',
        'tanggal_diterima',
        'pengirim',
        'penerima',
        'isi',
        'lampiran',
    ];

    // Jika kamu ingin meng-cast tanggal agar otomatis jadi Carbon instance
    protected $casts = [
        'tanggal_surat' => 'date',
        'tanggal_diterima' => 'date',
    ];

    /**
     * Relasi ke model User (pembuat surat)
     */
    // Relasi ke User
    public function pengirimUser()
    {
        return $this->belongsTo(User::class, 'pengirim');
    }

    public function penerimaUser()
    {
        return $this->belongsTo(User::class, 'penerima');
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
