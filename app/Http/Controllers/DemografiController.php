<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemografiController extends Controller
{
    public function indexAgama()
    {
        // $list_kecamatan =  Desa::all();

        // return view('demografi-agama', [
        //     "title" => "Demografi Agama",
        //     "list_kecamatan" => $list_kecamatan
        // ]);

        // Ambil semua desa beserta jumlah penduduk berdasarkan agama
        $data = Desa::with(['keluargas.penduduks'])->get()->map(function ($desa) {
            $agamaCounts = [
                'Islam' => 0,
                'Protestan' => 0,
                'Katolik' => 0,
                'Hindu' => 0,
                'Buddha' => 0,
                'Konghucu' => 0
            ];

            foreach ($desa->keluargas as $keluarga) {
                foreach ($keluarga->penduduks as $penduduk) {
                    if (isset($agamaCounts[$penduduk->agama])) {
                        $agamaCounts[$penduduk->agama]++;
                    }
                }
            }

            return [
                'nama_desa' => $desa->nama_desa,
                'agama' => $agamaCounts,
                'total' => array_sum($agamaCounts)
            ];
        });

        return view('demografi-agama', [
            'title' => 'Demografi Agama per Desa',
            'data' => $data
        ]);
    }

    public function indexGolonganDarah()
    {
        $data = \App\Models\Desa::with(['keluargas.penduduks'])->get()->map(function ($desa) {
            $golonganCounts = [
                'A' => 0,
                'B' => 0,
                'AB' => 0,
                'O' => 0
            ];

            foreach ($desa->keluargas as $keluarga) {
                foreach ($keluarga->penduduks as $penduduk) {
                    if (isset($golonganCounts[$penduduk->golongan_darah])) {
                        $golonganCounts[$penduduk->golongan_darah]++;
                    }
                }
            }

            return [
                'nama_desa' => $desa->nama_desa,
                'golongan' => $golonganCounts,
                'total' => array_sum($golonganCounts)
            ];
        });

        return view('demografi-golongan-darah', [
            'title' => 'Demografi Golongan Darah per Desa',
            'data' => $data
        ]);
    }

    public function indexJenisKelamin()
    {
        $data = \App\Models\Desa::with(['keluargas.penduduks'])->get()->map(function ($desa) {
            $genderCounts = [
                'L' => 0,
                'P' => 0,
            ];

            foreach ($desa->keluargas as $keluarga) {
                foreach ($keluarga->penduduks as $penduduk) {
                    if (isset($genderCounts[$penduduk->jenis_kelamin])) {
                        $genderCounts[$penduduk->jenis_kelamin]++;
                    }
                }
            }

            return [
                'nama_desa' => $desa->nama_desa,
                'jenis_kelamin' => $genderCounts,
                'total' => array_sum($genderCounts)
            ];
        });

        return view('demografi-jenis-kelamin', [
            'title' => 'Demografi Jenis Kelamin per Desa',
            'data' => $data
        ]);
    }

    // public function indexPekerjaan()
    // {
    //     // Ambil semua desa dan relasinya
    //     $data = \App\Models\Desa::with(['keluargas.penduduks.pekerjaan'])->get()->map(function ($desa) {
    //         // Hitung jumlah penduduk per pekerjaan di desa ini
    //         $pekerjaanCounts = [];

    //         foreach ($desa->keluargas as $keluarga) {
    //             foreach ($keluarga->penduduks as $penduduk) {
    //                 $namaPekerjaan = $penduduk->pekerjaan->nama_pekerjaan ?? 'Tidak Diketahui';
    //                 if (!isset($pekerjaanCounts[$namaPekerjaan])) {
    //                     $pekerjaanCounts[$namaPekerjaan] = 0;
    //                 }
    //                 $pekerjaanCounts[$namaPekerjaan]++;
    //             }
    //         }

    //         // Urutkan dari terbesar ke terkecil dan ambil 5 teratas
    //         arsort($pekerjaanCounts);
    //         $top5 = array_slice($pekerjaanCounts, 0, 5, true);

    //         return [
    //             'nama_desa' => $desa->nama_desa,
    //             'pekerjaan' => $top5,
    //             'total' => array_sum($pekerjaanCounts),
    //         ];
    //     });

    //     return view('demografi-pekerjaan', [
    //         'title' => 'Top 5 Pekerjaan per Desa',
    //         'data' => $data
    //     ]);
    // }

    public function indexPendidikan()
    {
        $levels = [
            'PAUD',
            'SD Sederajat',
            'SMP Sederajat',
            'SMA/SMK Sederajat',
            'D1',
            'D2',
            'D3',
            'D4',
            'S1',
            'S2',
            'S3'
        ];

        $data = Desa::with(['keluargas.penduduks'])->get()->map(function ($desa) use ($levels) {
            // inisialisasi semua level dengan 0 supaya urutannya konsisten
            $counts = array_fill_keys($levels, 0);

            foreach ($desa->keluargas as $keluarga) {
                foreach ($keluarga->penduduks as $penduduk) {
                    $pend = $penduduk->pendidikan;
                    if ($pend && array_key_exists($pend, $counts)) {
                        $counts[$pend]++;
                    }
                }
            }

            return [
                'nama_desa' => $desa->nama_desa,
                'pendidikan' => $counts,
                'total' => array_sum($counts)
            ];
        });

        return view('demografi-pendidikan', [
            'title' => 'Demografi Pendidikan per Desa',
            'data' => $data
        ]);
    }
}
