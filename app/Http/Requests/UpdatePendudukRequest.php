<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePendudukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $penduduk = $this->route('penduduk');
        $pendudukId = $penduduk instanceof \App\Models\Penduduk ? $penduduk->id : $penduduk;

        return [
            'keluarga_id'   => 'required|exists:keluargas,id',
            'nama'          => 'required|string|max:100',
            'nik'           => 'required|string|max:50|unique:penduduks,nik,' . $pendudukId . ',id',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'agama'         => 'required|in:Islam,Protestan,Katolik,Hindu,Buddha,Konghucu',
            'golongan_darah'    => 'required|in:A,B,AB,O',
            'pekerjaan_id'  => 'required|exists:pekerjaans,id',
            'pendidikan'    => 'required',
            'peran_dalam_keluarga' => 'required|in:Kepala Keluarga,Istri,Anak,Lainnya',
            'peran_dalam_keluarga' => 'required|in:Kepala Keluarga,Istri,Anak,Lainnya',
            'memiliki_ktp' => 'required|boolean',
        ];
    }
}
