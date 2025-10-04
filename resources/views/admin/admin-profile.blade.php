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

            <div class="flex flex-col gap-5 mb-2 sm:flex-row sm:justify-between">
                <div class="w-full">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Profil Akun
                    </h3>
                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                        Profil akun admin yang sedang login
                    </p>
                </div>
            </div>

            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="w-full text-sm border">
                    <tr>
                        <td class="border bg-gray-50 text-gray-700 px-2 py-1 w-[25%]">Nama</td>
                        <td class="border px-2 py-1">{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <td class="border bg-gray-50 text-gray-700 px-2 py-1 w-[25%]">Email</td>
                        <td class="border px-2 py-1">{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <td class="border bg-gray-50 text-gray-700 px-2 py-1 w-[25%]">Role</td>
                        <td class="border px-2 py-1">{{ ucfirst(Auth::user()->role) }}</td>
                    </tr>
                    <tr>
                        <td class="border bg-gray-50 text-gray-700 px-2 py-1 w-[25%]">Terdaftar Sejak</td>
                        <td class="border px-2 py-1">{{ Auth::user()->created_at->format('d M Y') }}</td>
                    </tr>
                </table>
            </div>

            <h3 class="text-lg font-semibold text-gray-800 mt-5 mb-2">Ubah Password</h3>

            <form action="{{ route('admin-profile.updatePassword') }}" method="POST" class="space-y-4 max-w-md">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700">Password Lama</label>
                    <input type="password" name="current_password" required
                        class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('current_password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Password Baru</label>
                    <input type="password" name="new_password" required
                        class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('new_password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" required
                        class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <button type="submit"
                    class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg 
                    hover:from-blue-700 hover:to-indigo-700 transform hover:-translate-y-0.5 transition duration-300 ease-in-out 
                    focus:outline-none focus:ring-4 focus:ring-indigo-400">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>
