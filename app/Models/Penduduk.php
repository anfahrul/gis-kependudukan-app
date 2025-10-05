<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'status_wajib_ktp',
        'punya_ktp'
    ];

    // protected static function booted()
    // {
    //     static::saving(function ($penduduk) {
    //         $penduduk->status_wajib_ktp = Carbon::parse($penduduk->tanggal_lahir)->age >= 17;
    //     });
    // }

    protected static function booted()
    {
        static::creating(function ($penduduk) {
            $penduduk->status_wajib_ktp = $penduduk->calculateWajibKtp();
        });

        static::updating(function ($penduduk) {
            $penduduk->status_wajib_ktp = $penduduk->calculateWajibKtp();
        });
    }

    public function calculateWajibKtp()
    {
        $umur = \Carbon\Carbon::parse($this->tanggal_lahir)->age;
        return $umur >= 17;
    }


    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'keluarga_id');
    }
}
