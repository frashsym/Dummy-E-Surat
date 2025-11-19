<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiSurat extends Model
{
    protected $fillable = [
        'template_surat_id',
        'surat_id',
        'nomor_surat',
        'tahun',
    ];

    public function template()
    {
        return $this->belongsTo(TemplateSurat::class, 'template_surat_id');
    }

    public function surat()
    {
        return $this->morphTo(null, 'template_surat_id', 'surat_id');
    }
}
