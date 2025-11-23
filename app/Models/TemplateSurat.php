<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateSurat extends Model
{
    protected $fillable = [
        'jenis_surat_id',
        'nama_template',
        'slug',
        'kop_surat',
        'body_template',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function jenis()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }

    public function transaksi()
    {
        return $this->hasMany(TransaksiSurat::class, 'template_surat_id');
    }

    public function pimpinan()
    {
        return $this->belongsTo(Pimpinan::class, 'pimpinan_id');
    }
}
