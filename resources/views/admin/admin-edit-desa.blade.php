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
                        Edit Desa
                    </h3>
                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">

                    </p>
                </div>

                <div class="flex items-start w-full gap-3 sm:justify-end">
                    <div class="relative w-fit">
                        <a href="/admin-desa"
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
                <form action="{{ route('desa.update', $desa->kode_desa) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Kode desa -->
                    <div>
                        <label for="kode_desa"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Kode desa
                        </label>

                        <input type="text" id="kode_desa" name="kode_desa"
                            value="{{ old('kode_desa', $desa->kode_desa) }}" readonly aria-readonly="true"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 
              bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 cursor-not-allowed
              focus:border-indigo-500 focus:ring-0 transition duration-200">

                    </div>

                    <!-- Nama desa -->
                    <div>
                        <label for="nama_desa"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Nama desa
                        </label>
                        <input type="text" id="nama_desa" name="nama_desa"
                            value="{{ old('nama_desa', $desa->nama_desa) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 
                   bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200
                   focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 transition duration-200"
                            placeholder="Masukkan nama desa" required>
                    </div>

                    <!-- Latitude -->
                    <div>
                        <label for="latitude" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Latitude
                        </label>
                        <input type="number" step="any" id="latitude" name="latitude"
                            value="{{ old('latitude', $desa->latitude) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 
                   bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200
                   focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 transition duration-200"
                            placeholder="Contoh: -3.99876543" required>
                    </div>

                    <!-- Longitude -->
                    <div>
                        <label for="longitude"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Longitude
                        </label>
                        <input type="number" step="any" id="longitude" name="longitude"
                            value="{{ old('longitude', $desa->longitude) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 
                   bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200
                   focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 transition duration-200"
                            placeholder="Contoh: 122.51234567" required>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex justify-left pt-4">
                        <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg 
                    hover:from-blue-700 hover:to-indigo-700 transform hover:-translate-y-0.5 transition duration-300 ease-in-out 
                    focus:outline-none focus:ring-4 focus:ring-indigo-400">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ====== Chart Three End -->
    </div>
</x-admin-layout>
