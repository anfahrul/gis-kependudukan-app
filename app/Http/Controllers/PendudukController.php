<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Kecamatan;
use App\Http\Requests\StorePendudukRequest;
use App\Http\Requests\UpdatePendudukRequest;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function indexAdmin()
    {
        // $list_kecamatan =  Kecamatan::all();
        return view('admin.admin-data-penduduk', [
            "title" => "Admin - Data Penduduk",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_kecamatan =  Kecamatan::all();
        return view('admin.admin-add-penduduk', [
            "title" => "Admin - Add Penduduk",
            "kecamatans" => $list_kecamatan
        ]);
    }

    public function byFamily($id)
    {
        $penduduk = Penduduk::where('keluarga_id', $id)->get(['id', 'nama']);
        return response()->json($penduduk);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'keluarga_id' => 'required|exists:keluargas,id',
    //         'nama' => 'required|string|max:100',
    //         'nik' => 'required|string|max:50|unique:penduduks,nik',
    //         'jenis_kelamin' => 'required|in:L,P',
    //         'tanggal_lahir' => 'required|date',
    //         'agama' => 'required|in:Islam,Protestan,Katolik,Hindu,Buddha,Konghucu',
    //         'golongan_darah' => 'required|in:A,B,AB,O',
    //         'pekerjaan_id' => 'required|exists:pekerjaans,id',
    //         'pendidikan' => 'required',
    //         'peran_dalam_keluarga' => 'required|in:Kepala Keluarga,Istri,Anak,Lainnya',
    //     ]);

    //     $penduduk = Penduduk::create($validated);

    //     return response()->json([
    //         'success' => true,
    //         'data' => $penduduk
    //     ]);
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'keluarga_id' => 'required|exists:keluargas,id',
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:50|unique:penduduks,nik',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|in:Islam,Protestan,Katolik,Hindu,Buddha,Konghucu',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'pekerjaan_id' => 'required|exists:pekerjaans,id',
            'pendidikan' => 'required',
            'peran_dalam_keluarga' => 'required|in:Kepala Keluarga,Istri,Anak,Lainnya',
        ]);

        $penduduk = Penduduk::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $penduduk
            ]);
        }

        return redirect()->back()->with('success', 'Penduduk berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(Penduduk $penduduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penduduk $penduduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePendudukRequest $request, Penduduk $penduduk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penduduk $penduduk)
    {
        //
    }
}
