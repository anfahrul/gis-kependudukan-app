<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Kecamatan;
use App\Http\Requests\StorePendudukRequest;
use App\Http\Requests\UpdatePendudukRequest;

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
    public function store(StorePendudukRequest $request)
    {
        //
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
