<x-admin-layout>
    <x-slot:title> {{ $title }} </x-slot:title>

    <div class="col-span-12">
        @if (session('success'))
            <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700">
                ✅ {{ session('success') }}
            </div>
        @endif

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
                        Tambah Penduduk
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

                            <span class="flex-1 text-left">Kembali</span>

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

                <div x-data="familySelect()" x-init="init()">
                    <form @submit.prevent="submitPenduduk" class="space-y-4">
                        @csrf

                        <!-- hidden keluarga_id -->
                        <input type="hidden" name="keluarga_id" :value="selectedId">

                        <!-- ========== PILIH / TAMBAH KELUARGA ========== -->
                        <div>
                            <label class="block text-sm font-medium">Keluarga (Ketikkan No. KK)</label>

                            <!-- input pencarian keluarga -->
                            <input type="text" x-model="query" @input.debounce.300="search"
                                placeholder="Cari no KK atau alamat..." class="w-full px-3 py-2 border rounded">

                            <div class="mt-2">
                                <template x-for="opt in options" :key="opt.id">
                                    <div class="p-2 hover:bg-gray-100 cursor-pointer" @click="select(opt)">
                                        <span x-text="opt.text"></span>
                                    </div>
                                </template>

                                <!-- tombol tambah keluarga -->
                                <div x-show="options.length===0 && query.length>0 && !selectedId"
                                    class="mt-2 text-sm text-gray-500">
                                    Tidak ditemukan.
                                    <button type="button" @click="openModal" class="ml-2 text-indigo-600 underline">
                                        + Tambah Keluarga
                                    </button>
                                </div>
                            </div>

                            <!-- Modal Tambah Keluarga -->
                            <div x-show="isModalOpen"
                                class="fixed inset-0 flex items-center justify-center bg-black/40">
                                <div class="bg-white p-6 rounded w-96">
                                    <h3 class="font-bold mb-3">Tambah Keluarga Baru</h3>

                                    {{-- <div class="mb-2">
                                        <label>No KK</label>
                                        <input x-ref="no_kk" class="w-full border rounded px-2 py-1" required>
                                    </div> --}}
                                    <div class="mb-2">
                                        <label>No KK</label>
                                        <input name="modal_no_kk" x-ref="no_kk" class="w-full border rounded px-2 py-1"
                                            required :disabled="true">
                                    </div>

                                    {{-- <div class="mb-2">
                                        <label>Alamat</label>
                                        <input x-ref="alamat" class="w-full border rounded px-2 py-1" required>
                                    </div> --}}
                                    <div class="mb-3">
                                        <label>Kecamatan</label>
                                        <select name="modal_kecamatan" x-ref="kecamatan"
                                            class="w-full border rounded px-2 py-1" required :disabled="true">
                                            @foreach ($kecamatans as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama_kecamatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Kecamatan</label>
                                        <select x-ref="kecamatan" class="w-full border rounded px-2 py-1" required>
                                            @foreach ($kecamatans as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama_kecamatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="flex justify-end space-x-2">
                                        <button type="button" @click="closeModal()"
                                            class="px-3 py-1 border rounded">Batal</button>
                                        <button type="button" @click="submitFamily()"
                                            class="px-3 py-1 bg-indigo-600 text-white rounded">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ========== FORM PENDUDUK ========== -->
                        <div x-show="selectedId" x-cloak>
                            <!-- input nama -->
                            <div>
                                <label class="block text-sm font-medium">Nama Penduduk</label>
                                <input x-model="formPenduduk.nama" type="text"
                                    class="w-full px-3 py-2 border rounded" required>
                            </div>

                            <!-- input NIK -->
                            <div>
                                <label class="block text-sm font-medium">NIK</label>
                                <input x-model="formPenduduk.nik" type="text" class="w-full px-3 py-2 border rounded"
                                    required>
                            </div>

                            <!-- jenis kelamin -->
                            <div>
                                <label class="block text-sm font-medium">Jenis Kelamin</label>
                                <select x-model="formPenduduk.jenis_kelamin" class="w-full px-3 py-2 border rounded"
                                    required>
                                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>

                            <!-- tanggal lahir -->
                            <div>
                                <label class="block text-sm font-medium">Tanggal Lahir</label>
                                <input x-model="formPenduduk.tanggal_lahir" type="date"
                                    class="w-full px-3 py-2 border rounded" required>
                            </div>

                            <!-- agama -->
                            <div>
                                <label class="block text-sm font-medium">Agama</label>
                                <select x-model="formPenduduk.agama" class="w-full px-3 py-2 border rounded">
                                    <option value="" disabled selected>-- Pilih Agama --</option>
                                    <template x-for="a in ['Islam','Protestan','Katolik','Hindu','Buddha','Konghucu']"
                                        :key="a">
                                        <option :value="a" x-text="a"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- golongan darah -->
                            <div>
                                <label class="block text-sm font-medium">Golongan Darah</label>
                                <select x-model="formPenduduk.golongan_darah" class="w-full px-3 py-2 border rounded">
                                    <option value="" disabled selected>-- Pilih Golongan Darah --</option>
                                    <template x-for="gd in ['A','B','AB','O']" :key="gd">
                                        <option :value="gd" x-text="gd"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- pekerjaan -->
                            <div>
                                <label class="block text-sm font-medium">Pekerjaan</label>
                                <select x-model="formPenduduk.pekerjaan_id" class="w-full px-3 py-2 border rounded"
                                    required>
                                    <option value="" disabled selected>-- Pilih Pekerjaan --</option>
                                    <template x-for="p in pekerjaanList" :key="p.id">
                                        <option :value="p.id" x-text="p.nama"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- pendidikan -->
                            <div>
                                <label class="block text-sm font-medium">Pendidikan</label>
                                <select x-model="formPenduduk.pendidikan" class="w-full px-3 py-2 border rounded">
                                    <option value="" disabled selected>-- Pilih Pendidikan --</option>
                                    <template x-for="pd in pendidikanList" :key="pd">
                                        <option :value="pd" x-text="pd"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- peran dalam keluarga -->
                            <div>
                                <label class="block text-sm font-medium">Peran dalam Keluarga</label>
                                <select x-model="formPenduduk.peran_dalam_keluarga"
                                    class="w-full px-3 py-2 border rounded">
                                    <option value="" disabled selected>-- Pilih Peran --</option>
                                    <template x-for="r in ['Kepala Keluarga','Istri','Anak','Lainnya']"
                                        :key="r">
                                        <option :value="r" x-text="r"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- tombol simpan penduduk -->
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">
                                Simpan Penduduk
                            </button>
                        </div>
                    </form>

                    <!-- daftar penduduk -->
                    <div class="mt-4" x-show="selectedId" x-cloak>
                        <h4 class="font-bold mb-2">Daftar Penduduk</h4>
                        <p>Berikut Daftar Penduduk pada Keluarga dengan No. KK</p>
                        <ul class="list-disc pl-5 text-sm">
                            <template x-for="p in penduduk" :key="p.id">
                                <li x-text="p.nama"></li>
                            </template>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function familySelect() {
            return {
                query: '',
                options: [],
                selectedId: null,
                isModalOpen: false,
                penduduk: [],
                pekerjaanList: [],
                pendidikanList: [
                    'PAUD', 'SD Sederajat', 'SMP Sederajat', 'SMA/SMK Sederajat',
                    'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'
                ],
                formPenduduk: {
                    keluarga_id: null,
                    nama: '',
                    nik: '',
                    jenis_kelamin: '',
                    tanggal_lahir: '',
                    agama: '',
                    golongan_darah: '',
                    pekerjaan_id: '',
                    pendidikan: '',
                    peran_dalam_keluarga: ''
                },

                init() {
                    fetch('/api/pekerjaan')
                        .then(res => res.json())
                        .then(data => this.pekerjaanList = data)
                        .catch(() => this.pekerjaanList = []);
                },

                async search() {
                    if (this.query.length < 2) {
                        this.options = [];
                        return;
                    }
                    const res = await fetch(`{{ route('families.search') }}?q=` + encodeURIComponent(this.query));
                    this.options = await res.json();
                },

                select(opt) {
                    this.selectedId = opt.id;
                    this.query = opt.text;
                    this.options = [];
                    this.formPenduduk.keluarga_id = opt.id;
                    this.loadPenduduk();
                },

                openModal() {
                    this.isModalOpen = true
                },
                closeModal() {
                    this.isModalOpen = false
                },

                async submitFamily() {
                    try {
                        const formData = new FormData();
                        formData.append('no_kk', this.$refs.no_kk.value);
                        formData.append('alamat_rumah', this.$refs.alamat.value);
                        formData.append('kecamatan_id', this.$refs.kecamatan.value);

                        const res = await fetch('{{ route('families.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        });

                        const json = await res.json();
                        if (json.success) {
                            this.selectedId = json.data.id;
                            this.query = json.data.text;
                            this.formPenduduk.keluarga_id = json.data.id;
                            this.closeModal();
                            this.loadPenduduk();
                            alert('Keluarga baru berhasil ditambahkan');
                        } else {
                            alert('Gagal menyimpan keluarga');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Terjadi kesalahan jaringan.');
                    }
                },

                async loadPenduduk() {
                    if (!this.selectedId) return;
                    const res = await fetch(`/penduduk/by-family/${this.selectedId}`);
                    this.penduduk = await res.json();
                },

                async submitPenduduk() {
                    try {
                        this.formPenduduk.keluarga_id = this.selectedId;

                        const formData = new FormData();
                        for (const key in this.formPenduduk) {
                            formData.append(key, this.formPenduduk[key]);
                        }

                        const res = await fetch('/penduduk', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(this.formPenduduk)
                        });


                        const json = await res.json();
                        if (json.success) {
                            this.penduduk.push(json.data);
                            alert('Penduduk berhasil ditambahkan');
                            // reset form
                            this.formPenduduk = {
                                keluarga_id: this.selectedId,
                                nama: '',
                                nik: '',
                                jenis_kelamin: 'L',
                                tanggal_lahir: '',
                                agama: 'Islam',
                                golongan_darah: 'A',
                                pekerjaan_id: '',
                                pendidikan: 'SD Sederajat',
                                peran_dalam_keluarga: 'Lainnya'
                            };
                        } else {
                            alert('Gagal menyimpan penduduk');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Terjadi kesalahan jaringan.');
                    }
                }
            }
        }
    </script>


    </div>
    </div>
    <!-- ====== Chart Three End -->
    </div>
</x-admin-layout>
