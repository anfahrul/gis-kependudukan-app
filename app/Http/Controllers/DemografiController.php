<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DemografiController extends Controller
{
    public function indexAgama()
    {
        $list_kecamatan =  Kecamatan::all();

        return view('demografi-agama', [
            "title" => "Demografi Agama",
            "list_kecamatan" => $list_kecamatan
        ]);
    }

    public function indexGolonganDarah()
    {
        $list_kecamatan =  Kecamatan::all();

        return view('demografi-golongan-darah', [
            "title" => "Demografi Golongan Darah",
            "list_kecamatan" => $list_kecamatan
        ]);
    }

    public function indexJenisKelamin()
    {
        $list_kecamatan =  Kecamatan::all();

        return view('demografi-jenis-kelamin', [
            "title" => "Demografi Jenis Kelamin",
            "list_kecamatan" => $list_kecamatan
        ]);
    }

    public function indexPekerjaan()
    {
        $list_kecamatan =  Kecamatan::all();

        return view('demografi-pekerjaan', [
            "title" => "Demografi Pekerjaan",
            "list_kecamatan" => $list_kecamatan
        ]);
    }

    public function indexPendidikan()
    {
        $list_kecamatan =  Kecamatan::all();

        return view('demografi-pendidikan', [
            "title" => "Demografi Pendidikan",
            "list_kecamatan" => $list_kecamatan
        ]);
    }
}
