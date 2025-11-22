<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nip',
        'nidn',
        'fakultas',
        'prodi',
        'no_hp',
        'alamat',
        'ttd',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
