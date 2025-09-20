<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Http\Requests\StoreKecamatanRequest;
use App\Http\Requests\UpdateKecamatanRequest;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_kecamatan =  Kecamatan::all();
        return view('data-kecamatan', [
            "title" => "Daftar Kecamatan",
            "list_kecamatan" => $list_kecamatan
        ]);
    }

    public function indexAdmin()
    {
        $list_kecamatan =  Kecamatan::all();
        return view('admin.admin-data-kecamatan', [
            "title" => "Admin - Data Kecamatan",
            "list_kecamatan" => $list_kecamatan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin-add-kecamatan', [
            "title" => "Admin - Add Kecamatan"
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
        Kecamatan::create([
            'kode_kecamatan' => $data['kode_kecamatan'],
            'nama_kecamatan' => $data['nama_kecamatan'],
            'latitude'       => $data['latitude'],
            'longitude'      => $data['longitude'],
        ]);

        // Redirect balik dengan pesan sukses
        return redirect()->route('kecamatan.index')
            ->with('success', 'Kecamatan baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kecamatan $kode_kecamatan)
    {
        return view('admin.admin-edit-kecamatan', [
            "title" => "Admin - Edit Kecamatan",
            "kecamatan" => $kode_kecamatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKecamatanRequest $request, Kecamatan $kode_kecamatan)
    {
        try {
            $data = $request->validated();

            $kode_kecamatan->update([
                'nama_kecamatan' => $data['nama_kecamatan'],
                'latitude'       => $data['latitude'],
                'longitude'      => $data['longitude'],
            ]);

            return redirect()->route('kecamatan.index')
                ->with('success', 'Data kecamatan berhasil diperbarui!');
        } catch (\Exception $e) {
            // Jika ada error
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui kecamatan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kecamatan $kode_kecamatan)
    {
        $kode_kecamatan->delete();

        return redirect()->route('kecamatan.index')
            ->with('success', 'Kecamatan berhasil dihapus!');
    }
}
