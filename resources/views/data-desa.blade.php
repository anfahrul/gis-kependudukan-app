<x-layout>
    <x-slot:title> {{ $title }} </x-slot:title>
    <x-slot:title-description>
        Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat
        veniam occaecat.
    </x-slot:title-description>

    {{-- Section Titik Kecamatan --}}
    <div class="bg-white-900 border-t-2 border-gray-200 py-24 sm:py-24">
        <div class="mx-auto max-w-4xl px-6">
            <div>
                {{-- <table id="tabelDesa" class="w-full text-sm border mt-2"> --}}
                <table class="w-full text-sm border mt-2">
                    <thead class="bg-gray-100">
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border px-2 py-1">Kode Desa</th>
                            <th class="border px-2 py-1">Nama Desa</th>
                            <th class="border px-2 py-1">Latitude</th>
                            <th class="border px-2 py-1">Longitude</th>
                            <th class="border px-2 py-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_desa as $desa)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="border px-2 py-1">{{ $desa->kode_desa }}</td>
                                <td class="border px-2 py-1">{{ $desa->nama_desa }}</td>
                                <td class="border px-2 py-1">{{ $desa->latitude }}</td>
                                <td class="border px-2 py-1">{{ $desa->longitude }}</td>
                                <td class="border px-2 py-1 flex justify-center items-center">
                                    <a href="{{ route('desa.show', $desa->OBJECTID) }}"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                        <!-- Icon Info -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11.25 9V7.5m0 6v-3m0 6h.008v.008H11.25V16.5zm9-4.5a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Detail
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.tailwindcss.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#tabelDesa').DataTable({
                responsive: true,
                pageLength: 10,
                language: {
                    search: "Cari Desa:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data tersedia",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "›",
                        previous: "‹"
                    },
                },
                columnDefs: [{
                    orderable: false,
                    targets: -1 // kolom aksi (Detail) tidak bisa di-sort
                }]
            });
        });
    </script>

</x-layout>
