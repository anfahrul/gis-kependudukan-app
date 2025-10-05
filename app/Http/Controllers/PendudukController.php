<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Kecamatan;
use App\Http\Requests\StorePendudukRequest;
use App\Http\Requests\UpdatePendudukRequest;
use App\Models\Desa;
use App\Models\Keluarga;
use App\Models\Pekerjaan;
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
        // $list_penduduk =  Penduduk::all();
        $list_penduduk =  Penduduk::with('keluarga')->get();
        return view('admin.admin-data-penduduk', [
            "title" => "Admin - Data Penduduk",
            "list_penduduk" => $list_penduduk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_desa =  Desa::all();
        return view('admin.admin-add-penduduk', [
            "title" => "Admin - Add Penduduk",
            "desas" => $list_desa
        ]);
    }

    public function byFamily($id)
    {
        $penduduk = Penduduk::with('pekerjaan') // relasi ke tabel pekerjaan
            ->where('keluarga_id', $id)
            ->get([
                'id',
                'nama',
                'nik',
                'jenis_kelamin',
                'tanggal_lahir',
                'agama',
                'golongan_darah',
                'pekerjaan_id',
                'pendidikan',
                'peran_dalam_keluarga',
                'status_wajib_ktp',
                'punya_ktp',
            ]);

        // ubah pekerjaan_id jadi nama pekerjaan biar langsung kebaca
        $penduduk->transform(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'nik' => $item->nik,
                'jenis_kelamin' => $item->jenis_kelamin,
                'tanggal_lahir' => $item->tanggal_lahir,
                'agama' => $item->agama,
                'golongan_darah' => $item->golongan_darah,
                'pendidikan' => $item->pendidikan,
                'peran_dalam_keluarga' => $item->peran_dalam_keluarga,
                'pekerjaan' => $item->pekerjaan ? $item->pekerjaan->nama_pekerjaan : null,
                'status_wajib_ktp' => $item->status_wajib_ktp ? 'Ya' : 'Belum',
                'punya_ktp' => $item->punya_ktp ? 'Ya' : 'Belum'
            ];
        });

        return response()->json($penduduk);
    }


    /**
     * Store a newly created resource in storage.
     */

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
            'punya_ktp' => 'required|boolean'
        ]);

        $penduduk = new Penduduk($validated);
        $penduduk->status_wajib_ktp = $penduduk->calculateWajibKtp();
        $penduduk->save();

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
        $list_pekerjaan =  Pekerjaan::all();
        $list_keluarga =  Keluarga::with('kecamatan')->get();

        return view('admin.admin-edit-penduduk', [
            "title" => "Admin - Edit Penduduk",
            "penduduk" => $penduduk,
            "pekerjaans" => $list_pekerjaan,
            "keluargas" => $list_keluarga
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePendudukRequest $request, Penduduk $penduduk)
    {
        try {
            $validated = $request->validated();

            // $penduduk->update([
            //     'keluarga_id'           => $data['keluarga_id'],
            //     'nama'                  => $data['nama'],
            //     'nik'                   => $data['nik'],
            //     'jenis_kelamin'         => $data['jenis_kelamin'],
            //     'tanggal_lahir'         => $data['tanggal_lahir'],
            //     'agama'                 => $data['agama'],
            //     'golongan_darah'        => $data['golongan_darah'],
            //     'pekerjaan_id'          => $data['pekerjaan_id'],
            //     'pendidikan'            => $data['pendidikan'],
            //     'peran_dalam_keluarga'  => $data['peran_dalam_keluarga'],
            // ]);

            $penduduk->fill($validated);
            $penduduk->wajib_ktp = $penduduk->calculateWajibKtp();
            $penduduk->save();

            return redirect()->route('penduduk.index')
                ->with('success', 'Data penduduk berhasil diperbarui!');
        } catch (\Exception $e) {
            // Jika ada error
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui penduduk: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()->route('penduduk.index')
            ->with('success', 'Penduduk berhasil dihapus!');
    }
}
