<?php

namespace Database\Seeders;

use App\Models\Pekerjaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobData = [
            [
                'nama_pekerjaan' => 'Petani/Pekebun',
            ],
            [
                'nama_pekerjaan' => 'Nelayan',
            ],
            [
                'nama_pekerjaan' => 'Pedagang',
            ],
            [
                'nama_pekerjaan' => 'Buruh/Karyawan Swasta',
            ],
            [
                'nama_pekerjaan' => 'Pegawai Negeri Sipil (PNS)',
            ],
            [
                'nama_pekerjaan' => 'Pelajar/Belum Bekerja',
            ],
            [
                'nama_pekerjaan' => 'Lainnya',
            ]
        ];

        foreach ($jobData as $key => $value) {
            Pekerjaan::create($value);
        };
    }
}
