<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Keluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicHomeController extends Controller
{
    public function index()
    {
        $jumlahDesa = Desa::count();
        $jumlahPenduduk = Penduduk::count();
        $jumlahKepalaKeluarga = Keluarga::count();

        return view('dashboard', [
            "title" => "Dashboard",
            "jumlahDesa" => $jumlahDesa,
            "jumlahPenduduk" => $jumlahPenduduk,
            "jumlahKepalaKeluarga" => $jumlahKepalaKeluarga,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($objectId)
    {
        $desa = Desa::where('OBJECTID', $objectId)->firstOrFail();

        // Ambil semua penduduk di desa ini
        $penduduks = Penduduk::whereHas('keluarga', function ($q) use ($desa) {
            $q->where('desa_id', $desa->id);
        })->get();

        // === SUMMARY ===
        $totalPenduduk = $penduduks->count();
        $totalKK = $penduduks->groupBy('keluarga_id')->count();

        $laki = $penduduks->where('jenis_kelamin', 'L')->count();
        $perempuan = $penduduks->where('jenis_kelamin', 'P')->count();

        $wajibKtp = $penduduks->where('status_wajib_ktp', true)->count();
        $punyaKtp = $penduduks->where('punya_ktp', true)->count();
        $persenKtp = $wajibKtp > 0 ? round(($punyaKtp / $wajibKtp) * 100, 1) : 0;

        // === REKAP LAINNYA ===
        $pendidikan = $penduduks->groupBy('pendidikan')->map->count();
        $pekerjaan = DB::table('penduduks')
            ->join('pekerjaans', 'penduduks.pekerjaan_id', '=', 'pekerjaans.id')
            ->select('pekerjaans.nama_pekerjaan', DB::raw('count(*) as jumlah'))
            ->whereIn('penduduks.id', $penduduks->pluck('id'))
            ->groupBy('pekerjaans.nama_pekerjaan')
            ->orderByDesc('jumlah')
            ->limit(5)
            ->get();

        $golonganDarah = $penduduks->groupBy('golongan_darah')->map->count();
        $agama = $penduduks->groupBy('agama')->map->count();

        return view('dashboard-show-desa', [
            "title" => "Detail Desa X",
            "desa" => $desa,
            'totalPenduduk' => $totalPenduduk,
            'totalKK' => $totalKK,
            'laki' => $laki,
            'perempuan' => $perempuan,
            'wajibKtp' => $wajibKtp,
            'punyaKtp' => $punyaKtp,
            'persenKtp' => $persenKtp,
            'pendidikan' => $pendidikan,
            'pekerjaan' => $pekerjaan,
            'golonganDarah' => $golonganDarah,
            'agama' => $agama,
        ]);
    }
}
