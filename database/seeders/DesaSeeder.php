<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $desaData = [
            [
                'kode_desa' => '1001',
                'nama_desa' => 'Anaiwoi',
                'latitude' => -3.97509036,
                'longitude' => 122.48781275,
                'OBJECTID' => 44039
            ],
            [
                'kode_desa' => '1002',
                'nama_desa' => 'Lalonggolosua',
                'latitude' => -3.97509036,
                'longitude' => 122.48781275,
                'OBJECTID' => 44549
            ],
            [
                'kode_desa' => '1003',
                'nama_desa' => 'Lamedai',
                'latitude' => -3.97509036,
                'longitude' => 122.48781275,
                'OBJECTID' => 44602
            ],
            [
                'kode_desa' => '1004',
                'nama_desa' => 'Lamoiko',
                'latitude' => -3.97509036,
                'longitude' => 122.48781275,
                'OBJECTID' => 44616
            ],
            [
                'kode_desa' => '1005',
                'nama_desa' => 'Oneeha',
                'latitude' => -3.97509036,
                'longitude' => 122.48781275,
                'OBJECTID' => 45025
            ],
            [
                'kode_desa' => '1006',
                'nama_desa' => 'Palewai',
                'latitude' => -3.97509036,
                'longitude' => 122.48781275,
                'OBJECTID' => 45052
            ],
            [
                'kode_desa' => '1007',
                'nama_desa' => 'Petudua',
                'latitude' => -3.97509036,
                'longitude' => 122.48781275,
                'OBJECTID' => 45107
            ],
            [
                'kode_desa' => '1008',
                'nama_desa' => 'Pewisoa Jaya',
                'latitude' => -3.97509036,
                'longitude' => 122.48781275,
                'OBJECTID' => 45108
            ],
            [
                'kode_desa' => '1009',
                'nama_desa' => 'Popalia',
                'latitude' => -3.97509036,
                'longitude' => 122.48781275,
                'OBJECTID' => 45144
            ],
            [
                'kode_desa' => '1010',
                'nama_desa' => 'Puundaipa',
                'latitude' => -3.97509036,
                'longitude' => 122.48781275,
                'OBJECTID' => 45198
            ],
            [
                'kode_desa' => '1011',
                'nama_desa' => 'Rahanggada',
                'latitude' => -3.97509036,
                'longitude' => 122.48781275,
                'OBJECTID' => 45236
            ],
            [
                'kode_desa' => '1012',
                'nama_desa' => 'Tanggetada',
                'latitude' => -3.97509036,
                'longitude' => 122.48781275,
                'OBJECTID' => 45409
            ],
            [
                'kode_desa' => '1013',
                'nama_desa' => 'Tinggo',
                'latitude' => -3.97509036,
                'longitude' => 122.48781275,
                'OBJECTID' => 45490
            ],
            [
                'kode_desa' => '1014',
                'nama_desa' => 'Tondowolio',
                'latitude' => -3.97509036,
                'longitude' => 122.48781275,
                'OBJECTID' => 45537
            ]

        ];

        foreach ($desaData as $key => $value) {
            Desa::create($value);
        };
    }
}
