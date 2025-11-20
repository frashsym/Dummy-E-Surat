<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'npm',
        'fakultas',
        'prodi',
        'angkatan',
        'kelas',
        'jenis_kelamin',
        'tgl_lahir',
        'no_hp',
        'alamat',
    ];

    // Relasi: Mahasiswa dimiliki 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
