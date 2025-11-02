<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karir extends Model
{
    // Nama tabel (opsional jika sesuai konvensi Laravel)
    protected $table = 'karirs';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'nama_karir',
        'deskripsi',
    ];
}
