<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika sesuai konvensi Laravel)
    protected $table = 'layanans';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'nama_layanan',
        'deskripsi',
    ];
}
