<x-admin-layout>
    <x-slot:title> {{ $title }} </x-slot:title>

    <div class="col-span-12">
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- ====== Chart Three Start -->
        <div
            class="rounded-2xl border border-gray-200 bg-white px-5 pb-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
            <div class="flex flex-col gap-5 mb-6 sm:flex-row sm:justify-between">
                <div class="w-full">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Edit Penduduk
                    </h3>
                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">

                    </p>
                </div>

                <div class="flex items-start w-full gap-3 sm:justify-end">
                    <div class="relative w-fit">
                        <a href="/admin-penduduk"
                            class="h-10 w-full max-w-11 rounded-lg border border-gray-200 bg-white hover:bg-gray-200 py-2.5 pl-[34px] pr-4 
          text-theme-sm font-medium text-gray-700 shadow-theme-xs focus:outline-hidden focus:ring-0 
          focus-visible:outline-hidden dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 
          xl:max-w-fit xl:pl-11 relative flex items-center">

                            <span class="flex-1 text-left">Batal</span>

                            <div class="absolute inset-0 right-auto flex items-center pointer-events-none left-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                </svg>

                            </div>
                        </a>

                    </div>
                </div>
            </div>
            <div class="max-w-full overflow-x-auto custom-scrollbar">
                {{-- Form Edit --}}
                <form action="{{ route('penduduk.update', $penduduk->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div>
                        <label for="nama" class="block text-sm font-semibold mb-1">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $penduduk->nama) }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400"
                            placeholder="Masukkan nama penduduk" required>
                    </div>

                    {{-- NIK --}}
                    <div>
                        <label for="nik" class="block text-sm font-semibold mb-1">NIK</label>
                        <input type="text" id="nik" name="nik" value="{{ old('nik', $penduduk->nik) }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400"
                            placeholder="Masukkan NIK" required>
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-semibold mb-1">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400"
                            required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L"
                                {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="P"
                                {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-semibold mb-1">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                            value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir) }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400"
                            required>
                    </div>

                    {{-- Agama --}}
                    <div>
                        <label for="agama" class="block text-sm font-semibold mb-1">Agama</label>
                        <select id="agama" name="agama"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400"
                            required>
                            @foreach (['Islam', 'Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                <option value="{{ $agama }}"
                                    {{ old('agama', $penduduk->agama) == $agama ? 'selected' : '' }}>
                                    {{ $agama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Golongan Darah --}}
                    <div>
                        <label for="golongan_darah" class="block text-sm font-semibold mb-1">Golongan Darah</label>
                        <select id="golongan_darah" name="golongan_darah"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400"
                            required>
                            @foreach (['A', 'B', 'AB', 'O'] as $gol)
                                <option value="{{ $gol }}"
                                    {{ old('golongan_darah', $penduduk->golongan_darah) == $gol ? 'selected' : '' }}>
                                    {{ $gol }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pendidikan --}}
                    <div>
                        <label for="pendidikan" class="block text-sm font-semibold mb-1">Pendidikan Terakhir</label>
                        <select id="pendidikan" name="pendidikan"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400"
                            required>
                            @foreach (['PAUD', 'SD Sederajat', 'SMP Sederajat', 'SMA/SMK Sederajat', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'] as $pd)
                                <option value="{{ $pd }}"
                                    {{ old('pendidikan', $penduduk->pendidikan) == $pd ? 'selected' : '' }}>
                                    {{ $pd }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pekerjaan --}}
                    <div>
                        <label for="pekerjaan_id" class="block text-sm font-semibold mb-1">Pekerjaan</label>
                        <select id="pekerjaan_id" name="pekerjaan_id"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400"
                            required>
                            <option value="">Pilih Pekerjaan</option>
                            @foreach ($pekerjaans as $p)
                                <option value="{{ $p->id }}"
                                    {{ old('pekerjaan_id', $penduduk->pekerjaan_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_pekerjaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Keluarga --}}
                    <div>
                        <label for="keluarga_id" class="block text-sm font-semibold mb-1">Nomor KK (Keluarga)</label>
                        <select id="keluarga_id" name="keluarga_id"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400"
                            required>
                            @foreach ($keluargas as $k)
                                <option value="{{ $k->id }}"
                                    {{ old('keluarga_id', $penduduk->keluarga_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->no_kk }} - Kecamatan {{ $k->kecamatan->nama_kecamatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Peran dalam Keluarga --}}
                    <div>
                        <label for="peran_dalam_keluarga" class="block text-sm font-semibold mb-1">Peran dalam
                            Keluarga</label>
                        <select id="peran_dalam_keluarga" name="peran_dalam_keluarga"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400"
                            required>
                            @foreach (['Kepala Keluarga', 'Istri', 'Anak', 'Lainnya'] as $peran)
                                <option value="{{ $peran }}"
                                    {{ old('peran_dalam_keluarga', $penduduk->peran_dalam_keluarga) == $peran ? 'selected' : '' }}>
                                    {{ $peran }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="pt-4">
                        <button type="submit"
                            class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ====== Chart Three End -->
    </div>
</x-admin-layout>
