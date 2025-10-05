<?php

namespace App\Models;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keluarga extends Model
{
    /** @use HasFactory<\Database\Factories\KeluargaFactory> */
    use HasFactory;

    protected $fillable = [
        'no_kk',
        'alamat_rumah',
        'desa_id'
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function penduduks()
    {
        return $this->hasMany(Penduduk::class, 'keluarga_id');
    }
}
