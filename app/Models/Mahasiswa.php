<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'mahasiswas';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'nim',
        'profile',
    ];

    protected $hidden = [
        'password',
    ];
}
