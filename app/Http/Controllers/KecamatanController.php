<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Http\Requests\StoreKecamatanRequest;
use App\Http\Requests\UpdateKecamatanRequest;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_desa =  Desa::all();
        return view('data-kecamatan', [
            "title" => "Daftar Kecamatan",
            "list_desa" => $list_desa
        ]);
    }

    public function indexAdmin()
    {
        $list_desa =  Desa::all();
        return view('admin.admin-data-desa', [
            "title" => "Admin - Data Desa",
            "list_desa" => $list_desa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin-add-desa', [
            "title" => "Admin - Add Desa"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKecamatanRequest $request)
    {
        // Ambil semua input yang sudah tervalidasi
        $data = $request->validated();

        // Simpan ke database
        Desa::create([
            'kode_desa' => $data['kode_desa'],
            'nama_desa' => $data['nama_desa'],
            'latitude'       => $data['latitude'],
            'longitude'      => $data['longitude'],
        ]);

        // Redirect balik dengan pesan sukses
        return redirect()->route('desa.index')
            ->with('success', 'Desa baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Desa $kecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Desa $kode_desa)
    {
        return view('admin.admin-edit-desa', [
            "title" => "Admin - Edit desa",
            "desa" => $kode_desa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKecamatanRequest $request, Desa $kode_desa)
    {
        try {
            $data = $request->validated();

            $kode_desa->update([
                'nama_desa' => $data['nama_desa'],
                'latitude'       => $data['latitude'],
                'longitude'      => $data['longitude'],
            ]);

            return redirect()->route('desa.index')
                ->with('success', 'Data desa berhasil diperbarui!');
        } catch (\Exception $e) {
            // Jika ada error
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui desa: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Desa $kode_desa)
    {
        $kode_desa->delete();

        return redirect()->route('desa.index')
            ->with('success', 'desa berhasil dihapus!');
    }
}
