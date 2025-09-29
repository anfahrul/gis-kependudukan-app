<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    /** @use HasFactory<\Database\Factories\PendudukFactory> */
    use HasFactory;

    protected $fillable = [
        'keluarga_id',
        'nama',
        'nik',
        'jenis_kelamin',
        'tanggal_lahir',
        'agama',
        'golongan_darah',
        'pendidikan',
        'pekerjaan_id',
        'peran_dalam_keluarga',
    ];

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }
}
