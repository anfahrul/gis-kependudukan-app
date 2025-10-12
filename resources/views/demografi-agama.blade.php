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
                    Data Demografi Kecamatan Berdasarkan Agama
                </p>
            </div>
        </div>

        <div class="mx-auto max-w-4xl px-6">
            <div class="overflow-x-auto rounded-lg shadow p-6">
                <table id="tabelDemografi" class="w-full text-sm border">
                    <thead class="bg-gray-100">
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border px-2 py-1 text-center">Desa</th>
                            <th class="border px-2 py-1 text-center">Islam</th>
                            <th class="border px-2 py-1 text-center">Protestan</th>
                            <th class="border px-2 py-1 text-center">Katolik</th>
                            <th class="border px-2 py-1 text-center">Hindu</th>
                            <th class="border px-2 py-1 text-center">Buddha</th>
                            <th class="border px-2 py-1 text-center">Konghucu</th>
                            <th class="border px-2 py-1 text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $desa)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="border px-3 py-2 font-semibold">{{ $desa['nama_desa'] }}</td>
                                @foreach ($desa['agama'] as $jumlah)
                                    <td class="border px-2 py-2 text-center">
                                        {{ $jumlah }}
                                        @if ($desa['total'] > 0)
                                            <span class="text-xs text-gray-500">
                                                ({{ number_format(($jumlah / $desa['total']) * 100, 1) }}%)
                                            </span>
                                        @endif
                                    </td>
                                @endforeach
                                <td class="border px-2 py-2 text-center font-semibold">{{ $desa['total'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</x-layout>
