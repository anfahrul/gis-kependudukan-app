<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    /** @use HasFactory<\Database\Factories\KeluargaFactory> */
    use HasFactory;

    protected $fillable = [
        'no_kk',
        'alamat_rumah',
        'kecamatan_id'
    ];
}
