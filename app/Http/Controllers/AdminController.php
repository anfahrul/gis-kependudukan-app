<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Keluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $jumlahDesa = Desa::count();
        $jumlahPenduduk = Penduduk::count();
        $jumlahKepalaKeluarga = Keluarga::count();

        return view('admin.admin-dashboard', [
            "title" => "Admin - Dashboard",
            "jumlahDesa" => $jumlahDesa,
            "jumlahPenduduk" => $jumlahPenduduk,
            "jumlahKepalaKeluarga" => $jumlahKepalaKeluarga,
        ]);
    }
}
