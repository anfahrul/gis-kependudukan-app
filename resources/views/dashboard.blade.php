<x-layout>
    {{-- Section Header --}}
    <x-slot:title>
        SIG Kependudukan Kec. Tanggetada
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
            <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base/7 text-gray-400">Jumlah Desa</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-800 sm:text-5xl">
                        {{ $jumlahDesa }}</dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base/7 text-gray-400">Jumlah Penduduk</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-800 sm:text-5xl">
                        {{ $jumlahPenduduk }}
                    </dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base/7 text-gray-400">Jumlah Kartu Keluarga (KK)</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-800 sm:text-5xl">
                        {{ $jumlahKepalaKeluarga }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    {{-- Section Titik Kecamatan --}}
    <div class="bg-white-900 border-t-2 border-gray-200 py-24 sm:py-24">

        <div class="mx-auto mb-16 max-w-7xl px-6 lg:px-8">
            <div class="mx-auto text-center">
                <h2 class="text-5xl font-semibold tracking-tight text-gray-800 sm:text-7xl">
                    Peta Titik Desa
                </h2>
                <p class="mt-4 text-sm font-normal text-pretty text-gray-400 sm:text-xl/8">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem odit exercitationem, deserunt, cum
                    dolores natus ducimus ut, quisquam reprehenderit blanditiis distinctio quasi numquam? Nam, quos?
                </p>
            </div>
        </div>

        <div class="mx-auto max-w-4xl px-6">
            {{-- Map tampil disini --}}
            <div id="map" class="w-full h-[500px] rounded-xl shadow-md"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map').setView([-4.1, 121.6], 11);

            // Layer dasar
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Fungsi pewarnaan berdasarkan jumlah penduduk
            function getColor(jumlah) {
                if (!jumlah || jumlah === 0) {
                    return 'transparent'; // Tidak ada penduduk
                }
                return jumlah > 2000 ? '#E31A1C' : // 🔴 Tinggi
                    jumlah > 1500 ? '#FEB24C' : // 🟠 Sedang
                    '#31A354'; // 🟢 Rendah
            }

            // Style default setiap area
            function style(feature) {
                return {
                    color: '#2563eb',
                    weight: 1.5,
                    fillColor: getColor(feature.properties.jumlah_penduduk),
                    fillOpacity: 0.4
                };
            }

            // Event highlight saat mouse hover
            function highlightFeature(e) {
                const layer = e.target;

                layer.setStyle({
                    weight: 3,
                    color: '#000',
                    fillOpacity: 0.7
                });

                // Tampilkan info di popup atau tooltip
                const props = layer.feature.properties;
                const namaDesa = props.NAMOBJ || "Tanpa Nama";
                const jumlahPenduduk = props.jumlah_penduduk ?? "Belum ada data";

                layer.bindTooltip(`
                    <strong>Desa:</strong> ${namaDesa}<br>
                    <strong>Jumlah Penduduk:</strong> ${jumlahPenduduk}
                `, {
                    sticky: true,
                    direction: 'top',
                    offset: [0, -10],
                }).openTooltip();
            }

            // Kembalikan style semula saat mouse keluar
            function resetHighlight(e) {
                geoLayer.resetStyle(e.target);
                e.target.closeTooltip();
            }

            // 🔹 Saat desa diklik → redirect ke halaman detail
            function zoomToFeature(e) {
                const props = e.target.feature.properties;
                const objectId = props.OBJECTID; // pastikan kolom ini ada di GeoJSON
                const namaDesa = props.NAMOBJ;

                // Misal redirect ke halaman detail Laravel
                window.location.href = `/desa/${objectId}`;
                // kalau mau kirim nama atau kode desa bisa ganti seperti:
                // window.location.href = `/desa/detail?nama=${namaDesa}`;
            }

            // Event listener per-feature
            function onEachFeature(feature, layer) {
                layer.on({
                    mouseover: highlightFeature,
                    mouseout: resetHighlight,
                    click: zoomToFeature
                });
            }

            // Load data GeoJSON dari Laravel API
            fetch("{{ url('/api/geojson/tanggetada') }}")
                .then(response => response.json())
                .then(data => {
                    geoLayer = L.geoJSON(data, {
                        style: style,
                        onEachFeature: onEachFeature
                    }).addTo(map);

                    map.fitBounds(geoLayer.getBounds());
                })
                .catch(err => console.error("Gagal memuat GeoJSON:", err));
        });
    </script>

</x-layout>
