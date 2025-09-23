<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKeluargaRequest;
use App\Http\Requests\UpdateKeluargaRequest;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function search(Request $request)
    {
        $q = $request->query('q', '');
        $results = Keluarga::where('no_kk', 'like', "%{$q}%")
            ->orWhere('alamat_rumah', 'like', "%{$q}%")
            ->limit(15)
            ->get(['id', 'no_kk', 'alamat_rumah']);

        // return array yang mudah dipakai di select
        return response()->json($results->map(fn($k) => [
            'id' => $k->id,
            'text' => 'No. KK' . $k->no_kk . ' — ' . Str::limit($k->alamat_rumah, 40),
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKeluargaRequest $request)
    {
        $data = $request->validated();

        try {
            $kel = Keluarga::create($data);
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $kel->id,
                    'text' => $kel->no_kk . ' — ' . Str::limit($kel->alamat_rumah, 40),
                ]
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // handle duplicate no_kk
            return response()->json(['success' => false, 'errors' => ['no_kk' => 'No KK sudah digunakan']], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Keluarga $keluarga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keluarga $keluarga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeluargaRequest $request, Keluarga $keluarga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keluarga $keluarga)
    {
        //
    }
}
