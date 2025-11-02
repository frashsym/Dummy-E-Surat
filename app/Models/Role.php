<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Nama tabel (opsional jika sesuai konvensi Laravel)
    protected $table = 'roles';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'nama_role',
    ];
}
