<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
