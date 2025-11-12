<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pimpinan extends Authenticatable
{
    use Notifiable;

    protected $table = 'pimpinans';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'wd',
        'signature',
        'profile',
    ];

    protected $hidden = [
        'password',
    ];
}
