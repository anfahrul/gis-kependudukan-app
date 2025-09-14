<x-layout>
    {{-- Section Header --}}
    <x-slot:title>
        SIG Kependudukan Kabupaten Kolaka
    </x-slot:title>
    <x-slot:title-description>
        Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat
        veniam occaecat.
    </x-slot:title-description>

    {{-- Section Data Demografi --}}
    <div id="data-demografi" class="bg-white-900 py-24 sm:py-24">

        <div class="mx-auto mb-16 max-w-7xl px-6 lg:px-8">
            <div class="mx-auto text-center">
                <h2 class="text-5xl font-semibold tracking-tight text-gray-800 sm:text-7xl">
                    Data Demografi
                </h2>
                <p class="mt-4 text-sm font-normal text-pretty text-gray-400 sm:text-xl/8">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem odit exercitationem, deserunt, cum
                    dolores natus ducimus ut, quisquam reprehenderit blanditiis distinctio quasi numquam? Nam, quos?
                </p>
            </div>
        </div>

        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-4">
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base/7 text-gray-400">Jumlah Penduduk</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-800 sm:text-5xl">1000
                    </dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base/7 text-gray-400">Jumlah Kepala Keluarga</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-800 sm:text-5xl">1000
                    </dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base/7 text-gray-400">Jumlah Laki-Laki</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-800 sm:text-5xl">1000</dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base/7 text-gray-400">Jumlah Perempuan</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-800 sm:text-5xl">1000</dd>
                </div>
            </dl>
        </div>
    </div>

    {{-- Section Titik Kecamatan --}}
    <div class="bg-white-900 border-t-2 border-gray-200 py-24 sm:py-24">

        <div class="mx-auto mb-16 max-w-7xl px-6 lg:px-8">
            <div class="mx-auto text-center">
                <h2 class="text-5xl font-semibold tracking-tight text-gray-800 sm:text-7xl">
                    Titik Kecamatan
                </h2>
                <p class="mt-4 text-sm font-normal text-pretty text-gray-400 sm:text-xl/8">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem odit exercitationem, deserunt, cum
                    dolores natus ducimus ut, quisquam reprehenderit blanditiis distinctio quasi numquam? Nam, quos?
                </p>
            </div>
        </div>

        <div class="mx-auto max-w-4xl px-6">
            <img src="https://plus.unsplash.com/premium_photo-1696544014078-0099c3b9ea78?q=80&w=1332&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="">
        </div>

    </div>
</x-layout>
