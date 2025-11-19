<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $fillable = [
        'nama',
    ];

    public function templates()
    {
        return $this->hasMany(TemplateSurat::class, 'jenis_surat_id');
    }
}
