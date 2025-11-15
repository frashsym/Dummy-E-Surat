<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemplateSurat extends Model
{
    use HasFactory;

    protected $table = 'template_surats';

    protected $fillable = [
        'nama_template',
        'html_template',
        'editable_fields',
    ];

    protected $casts = [
        'editable_fields' => 'array', // otomatis decode/encode JSON
    ];

    // Relasi ke surat
    public function surats()
    {
        return $this->hasMany(Surat::class, 'template_id');
    }
}
