<?php

namespace App\Models;

use App\Models\Keluarga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    /** @use HasFactory<\Database\Factories\KecamatanFactory> */
    use HasFactory;
    protected $table = 'kecamatan';

    protected $fillable = [
        'kode_kecamatan',
        'nama_kecamatan',
        'latitude',
        'longitude',
    ];

    public function getRouteKeyName()
    {
        return 'kode_kecamatan';
    }

    public function keluargas()
    {
        return $this->hasMany(Keluarga::class);
    }
}
