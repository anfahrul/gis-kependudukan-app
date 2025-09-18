<x-admin-layout>
    <x-slot:title> {{ $title }} </x-slot:title>

    <div class="col-span-12">
        @if (session('success'))
            <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- ====== Chart Three Start -->
        <div
            class="rounded-2xl border border-gray-200 bg-white px-5 pb-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
            <div class="flex flex-col gap-5 mb-6 sm:flex-row sm:justify-between">
                <div class="w-full">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Data Kecamatan
                    </h3>
                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                        Tambah, edit, dan hapus data kecamatan
                    </p>
                </div>

                <div class="flex items-start w-full gap-3 sm:justify-end">
                    <div class="relative w-fit">
                        <a href="/admin-kecamatan/tambah"
                            class="h-10 w-full max-w-11 rounded-lg border border-gray-200 bg-white hover:bg-gray-200 py-2.5 pl-[34px] pr-4 
          text-theme-sm font-medium text-gray-700 shadow-theme-xs focus:outline-hidden focus:ring-0 
          focus-visible:outline-hidden dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 
          xl:max-w-fit xl:pl-11 relative flex items-center">

                            <span class="flex-1 text-left">Tambah Kecamatan</span>

                            <div class="absolute inset-0 right-auto flex items-center pointer-events-none left-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>


                            </div>
                        </a>

                    </div>
                </div>
            </div>
            <div class="max-w-full overflow-x-auto custom-scrollbar">
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
                                    <div class="flex">
                                        <div class="flex-1">
                                            <a href="{{ route('kecamatan.edit', $kecamatan->kode_kecamatan) }}"
                                                class="inline-flex items-center px-2 py-1 text-sm font-small text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                                <!-- Icon Info -->
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                </svg>

                                                Edit
                                            </a>
                                        </div>
                                        <div class="flex-1">
                                            <a href="#"
                                                class="inline-flex items-center px-2 py-1 text-sm font-small text-white bg-red-600 rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                                <!-- Icon Info -->
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18 18 6M6 6l12 12" />
                                                </svg>

                                                Hapus
                                            </a>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- ====== Chart Three End -->
    </div>
</x-admin-layout>
