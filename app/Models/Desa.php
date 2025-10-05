<?php

namespace App\Models;

use App\Models\Keluarga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desa extends Model
{
    /** @use HasFactory<\Database\Factories\KecamatanFactory> */
    use HasFactory;
    protected $table = 'desa';

    protected $fillable = [
        'kode_desa',
        'nama_desa',
        'latitude',
        'longitude',
    ];

    public function getRouteKeyName()
    {
        return 'kode_desa';
    }

    public function keluargas()
    {
        return $this->hasMany(Keluarga::class);
    }
}
