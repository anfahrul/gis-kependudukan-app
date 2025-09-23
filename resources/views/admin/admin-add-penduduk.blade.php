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

                <!-- resources/views/penduduk/create.blade.php -->
                <form action="{{ route('penduduk.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- other penduduk fields... -->

                    <!-- Keluarga select + tombol create -->
                    <div x-data="familySelect()" x-init="init()">
                        <label class="block text-sm font-medium">Keluarga (No. KK)</label>

                        <!-- hidden input menyimpan id -->
                        <input type="hidden" name="keluarga_id" :value="selectedId">

                        <!-- visible custom select (search) -->
                        <input type="text" x-model="query" @input.debounce.300="search"
                            placeholder="Cari no KK atau alamat..." class="w-full px-3 py-2 border rounded">

                        <div class="mt-2">
                            <template x-for="opt in options" :key="opt.id">
                                <div class="p-2 hover:bg-gray-100 cursor-pointer" @click="select(opt)">
                                    <span x-text="opt.text"></span>
                                </div>
                            </template>

                            <div x-show="options.length===0 && query.length>0" class="mt-2 text-sm text-gray-500">
                                Tidak ditemukan.
                                <button type="button" @click="openModal" class="ml-2 text-indigo-600 underline">
                                    + Tambah Keluarga
                                </button>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div x-show="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-black/40">
                            <div class="bg-white p-6 rounded w-96">
                                <h3 class="font-bold mb-3">Tambah Keluarga Baru</h3>

                                <!-- input keluarga -->
                                <div class="mb-2">
                                    <label>No KK</label>
                                    <input x-ref="no_kk" class="w-full border rounded px-2 py-1" required>
                                </div>
                                <div class="mb-2">
                                    <label>Alamat</label>
                                    <input x-ref="alamat" class="w-full border rounded px-2 py-1" required>
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

                                    <!-- PENTING: jangan submit form utama -->
                                    <button type="button" @click="submitFamily()"
                                        class="px-3 py-1 bg-indigo-600 text-white rounded">Simpan</button>
                                </div>
                            </div>
                        </div>

                        <!-- Tempat tampil daftar penduduk -->
                        <div class="mt-4" x-show="selectedId" x-cloak>
                            <h4 class="font-bold mb-2">Daftar Penduduk</h4>
                            <ul class="list-disc pl-5 text-sm">
                                <template x-for="p in penduduk" :key="p.id">
                                    <li x-text="p.nama"></li>
                                </template>
                            </ul>
                        </div>
                    </div>

                    <!-- tombol simpan penduduk -->
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">
                        Simpan Penduduk
                    </button>
                </form>


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
                init() {},
                async search() {
                    if (this.query.length < 2) {
                        this.options = [];
                        return;
                    }
                    const res = await fetch(`{{ route('families.search') }}?q=` + encodeURIComponent(this.query));
                    const data = await res.json();
                    this.options = data;
                },
                select(opt) {
                    this.selectedId = opt.id;
                    this.query = opt.text;
                    this.options = [];
                    this.loadPenduduk();
                },
                openModal() {
                    this.isModalOpen = true;
                },
                closeModal() {
                    this.isModalOpen = false;
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

                        if (res.status === 422) {
                            const err = await res.json();
                            alert(Object.values(err.errors || {
                                error: 'Validasi gagal'
                            }).flat().join("\n"));
                            return;
                        }

                        if (!res.ok) {
                            // tampilkan error dari server jika ada
                            const text = await res.text();
                            console.error('Server error:', text);
                            alert('Terjadi kesalahan: ' + res.status);
                            return;
                        }

                        const json = await res.json();
                        if (json.success) {
                            this.selectedId = json.data.id;
                            this.query = json.data.text;
                            this.closeModal();
                            alert('Keluarga baru berhasil ditambahkan');
                            this.loadPenduduk(); // load penduduk (kosong untuk keluarga baru)
                        } else {
                            alert('Gagal menyimpan keluarga');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Terjadi kesalahan jaringan.');
                    }
                },

                async loadPenduduk() {
                    // if (!this.selectedId) return;

                    // const res = await fetch(`/penduduk/by-family/${this.selectedId}`);
                    // const data = await res.json();


                    // // render ke <ul>
                    // if (!this.$refs.pendudukList) return;
                    // this.$refs.pendudukList.innerHTML = '';
                    // if (data.length === 0) {
                    //     this.$refs.pendudukList.innerHTML = '<li class="text-gray-500">Belum ada penduduk</li>';
                    // } else {
                    //     data.forEach(p => {
                    //         console.log(p);
                    //         const li = document.createElement('li');
                    //         li.textContent = p.nama;
                    //         this.$refs.pendudukList.appendChild(li);
                    //     });
                    // }

                    if (!this.selectedId) return;

                    const res = await fetch(`/penduduk/by-family/${this.selectedId}`);
                    this.penduduk = await res.json(); // simpan ke state Alpine
                }

            }
        }
    </script>

    </div>
    </div>
    <!-- ====== Chart Three End -->
    </div>
</x-admin-layout>
