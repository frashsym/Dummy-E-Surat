<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateSurat extends Model
{
    protected $fillable = [
        'jenis_surat_id',
        'nama_template',
    ];

    public function jenis()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }

    public function transaksi()
    {
        return $this->hasMany(TransaksiSurat::class, 'template_surat_id');
    }
}
