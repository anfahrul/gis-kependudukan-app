<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeoJsonController extends Controller
{
    public function getTanggetada()
    {
        // 🔹 Ambil jumlah penduduk per desa
        // $jumlahPenduduk = DB::table('penduduks')
        //     ->join('keluargas', 'penduduks.keluarga_id', '=', 'keluargas.id')
        //     ->join('desa', 'keluargas.desa_id', '=', 'desa.id') // tambahkan join ke desa
        //     ->select('desa.OBJECTID', DB::raw('COUNT(penduduks.id) as total'))
        //     ->groupBy('desa.OBJECTID')
        //     ->pluck('total', 'desa.OBJECTID'); // hasilnya: [OBJECTID => jumlah]

        $jumlahPenduduk = DB::table('penduduks')
            ->join('keluargas', 'penduduks.keluarga_id', '=', 'keluargas.id')
            ->join('desa', 'keluargas.desa_id', '=', 'desa.id')
            ->select(
                'desa.OBJECTID',
                DB::raw('COUNT(penduduks.id) as total'),
                DB::raw('SUM(CASE WHEN penduduks.status_wajib_ktp = 1 THEN 1 ELSE 0 END) as wajib_ktp')
            )
            ->groupBy('desa.OBJECTID')
            ->get()
            ->keyBy('OBJECTID');


        // 🔹 Baca file GeoJSON desa
        $path = public_path('/geojson/geo-tanggetada.geojson');

        if (!file_exists($path)) {
            return response()->json(['error' => 'File GeoJSON tidak ditemukan'], 404);
        }

        $geojson = json_decode(file_get_contents($path), true);

        // 🔹 Tambahkan jumlah penduduk berdasarkan desa_id
        // foreach ($geojson['features'] as &$feature) {
        //     $desaId = (int) $feature['properties']['OBJECTID'];
        //     $feature['properties']['jumlah_penduduk'] = $jumlahPenduduk[$desaId] ?? 0;
        // }

        foreach ($geojson['features'] as &$feature) {
            $desaId = (int) $feature['properties']['OBJECTID'];

            $data = $jumlahPenduduk[$desaId] ?? null;

            $total = $data->total ?? 0;
            $wajib = $data->wajib_ktp ?? 0;
            $belum = $total - $wajib;

            $feature['properties']['jumlah_penduduk'] = $total;
            $feature['properties']['jumlah_wajib_ktp'] = $wajib;
            $feature['properties']['jumlah_belum_wajib_ktp'] = $belum;
        }

        return response()->json($geojson);
    }

    // public function getDesa($objectId)
    // {
    //     // Ambil file GeoJSON asli
    //     $geojsonPath = public_path('/geojson/geo-tanggetada.geojson');
    //     $geojson = json_decode(file_get_contents($geojsonPath), true);

    //     // Filter berdasarkan OBJECTID
    //     $filtered = collect($geojson['features'])
    //         ->where('properties.OBJECTID', (int) $objectId)
    //         ->values()
    //         ->all();

    //     // Hanya kirim feature yang cocok
    //     $geojson['features'] = $filtered;

    //     // Ambil jumlah penduduk dari DB
    //     $desa = \App\Models\Desa::where('OBJECTID', $objectId)->first();
    //     $jumlahPenduduk = DB::table('penduduks')
    //         ->join('keluargas', 'penduduks.keluarga_id', '=', 'keluargas.id')
    //         ->where('keluargas.desa_id', $desa->id)
    //         ->count();

    //     // Tambahkan jumlah penduduk ke properties
    //     if (!empty($geojson['features'])) {
    //         $geojson['features'][0]['properties']['jumlah_penduduk'] = $jumlahPenduduk;
    //     }

    //     return response()->json($geojson);
    // }

    public function getDesa($objectId)
    {
        // 🔹 Ambil file GeoJSON
        $geojsonPath = public_path('/geojson/geo-tanggetada.geojson');

        if (!file_exists($geojsonPath)) {
            return response()->json(['error' => 'File GeoJSON tidak ditemukan'], 404);
        }

        $geojson = json_decode(file_get_contents($geojsonPath), true);

        // 🔹 Filter berdasarkan OBJECTID
        $filtered = collect($geojson['features'])
            ->where('properties.OBJECTID', (int) $objectId)
            ->values()
            ->all();

        $geojson['features'] = $filtered;

        // 🔹 Ambil data desa
        $desa = \App\Models\Desa::where('OBJECTID', $objectId)->first();

        if (!$desa) {
            return response()->json(['error' => 'Desa tidak ditemukan'], 404);
        }

        // 🔥 🔹 Ambil agregasi data (1 query)
        $data = DB::table('penduduks')
            ->join('keluargas', 'penduduks.keluarga_id', '=', 'keluargas.id')
            ->where('keluargas.desa_id', $desa->id)
            ->select(
                DB::raw('COUNT(penduduks.id) as total'),
                DB::raw('SUM(CASE WHEN penduduks.status_wajib_ktp = 1 THEN 1 ELSE 0 END) as wajib_ktp')
            )
            ->first();

        $total = $data->total ?? 0;
        $wajib = $data->wajib_ktp ?? 0;
        $belum = max(0, $total - $wajib);

        // 🔹 Inject ke GeoJSON
        if (!empty($geojson['features'])) {
            $geojson['features'][0]['properties']['jumlah_penduduk'] = $total;
            $geojson['features'][0]['properties']['jumlah_wajib_ktp'] = $wajib;
            $geojson['features'][0]['properties']['jumlah_belum_wajib_ktp'] = $belum;
        }

        return response()->json($geojson);
    }
}
