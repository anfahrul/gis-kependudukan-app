<x-layout>
    <x-slot:title> {{ $title }} </x-slot:title>
    <x-slot:title-description>
        Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat
        veniam occaecat.
    </x-slot:title-description>

    {{-- Section Demografi Agama --}}
    <div class="bg-white-900 border-t-2 border-gray-200 py-24 sm:py-24">

        <div class="mx-auto mb-8 max-w-7xl px-6 lg:px-8">
            <div class="mx-auto text-center">
                {{-- <h2 class="text-5xl font-semibold tracking-tight text-gray-800 sm:text-7xl">
                    Titik Kecamatan
                </h2> --}}
                <p class="text-sm font-normal text-pretty text-gray-800 sm:text-xl/8">
                    Data Demografi Kecamatan Berdasarkan Jenis Kelamin
                </p>
            </div>
        </div>

        <div class="mx-auto max-w-4xl px-6">
            <div class="mt-6 overflow-x-auto rounded-lg shadow">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-800 text-gray-200">
                            <th class="px-6 py-3 text-sm font-semibold">Kode Kecamatan</th>
                            <th class="px-6 py-3 text-sm font-semibold">Nama Kecamatan</th>
                            <th class="px-6 py-3 text-sm font-semibold">Latitude</th>
                            <th class="px-6 py-3 text-sm font-semibold">Longitude</th>
                            <th class="px-6 py-3 text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700 bg-gray-900 text-gray-100">
                        @foreach ($list_kecamatan as $kecamatan)
                            <tr class="hover:bg-gray-800 transition">
                                <td class="px-6 py-3">{{ $kecamatan->kode_kecamatan }}</td>
                                <td class="px-6 py-3">{{ $kecamatan->nama_kecamatan }}</td>
                                <td class="px-6 py-3">{{ $kecamatan->latitude }}</td>
                                <td class="px-6 py-3">{{ $kecamatan->longitude }}</td>
                                <td class="px-6 py-3">
                                    <a href="#"
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

</x-layout>
