<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use App\Http\Requests\StorePekerjaanRequest;
use App\Http\Requests\UpdatePekerjaanRequest;

class PekerjaanController extends Controller
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
        $list_pekerjaan =  Pekerjaan::all();
        return view('admin.admin-jenis-pekerjaan', [
            "title" => "Admin - Input Jenis Pekerjaan",
            "list_pekerjaan" => $list_pekerjaan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin-add-jenis-pekerjaan', [
            "title" => "Admin - Add Pekerjaan"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePekerjaanRequest $request)
    {
        // Ambil semua input yang sudah tervalidasi
        $data = $request->validated();

        // Simpan ke database
        Pekerjaan::create([
            'nama_pekerjaan' => $data['nama_pekerjaan'],
        ]);

        // Redirect balik dengan pesan sukses
        return redirect()->route('pekerjaan.index')
            ->with('success', 'Pekerjaan baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pekerjaan $id)
    {
        return view('admin.admin-edit-jenis-pekerjaan', [
            "title" => "Admin - Edit Pekerjaan",
            "pekerjaan" => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePekerjaanRequest $request, Pekerjaan $id)
    {
        try {
            $data = $request->validated();

            $id->update([
                'nama_pekerjaan' => $data['nama_pekerjaan'],
            ]);

            return redirect()->route('pekerjaan.index')
                ->with('success', 'Data Pekerjaan berhasil diperbarui!');
        } catch (\Exception $e) {
            // Jika ada error
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui pekerjaan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pekerjaan $id)
    {
        $id->delete();

        return redirect()->route('pekerjaan.index')
            ->with('success', 'Pekerjaan berhasil dihapus!');
    }
}
