<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TransaksiSurat extends Model
{
    protected $fillable = [
        'template_surat_id',
        'surat_id',
        'nomor_surat',
        'tahun',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate nomor surat otomatis
            $model->nomor_surat = self::generateNomorSurat();
        });
    }

    public static function generateNomorSurat()
    {
        $last = self::orderBy('id', 'desc')->first();
        $next = $last ? $last->id + 1 : 1;

        $bulanRomawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];

        $bulan = $bulanRomawi[Carbon::now()->month];
        $tahun = Carbon::now()->year;

        return "{$next}/K/FEB/01/{$bulan}/{$tahun}";
    }

    public function template()
    {
        return $this->belongsTo(TemplateSurat::class, 'template_surat_id');
    }

    public function surat()
    {
        return $this->morphTo(null, 'template_surat_id', 'surat_id');
    }
}
