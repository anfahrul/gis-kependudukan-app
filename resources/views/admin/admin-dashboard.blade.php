<x-admin-layout>
    <x-slot:title> {{ $title }} </x-slot:title>

    <div class="col-span-12">

        <!-- ====== Chart Three Start -->
        <div
            class="rounded-2xl border border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">

            {{-- main --}}

            {{-- Section Titik Kecamatan --}}
            <div class="bg-white-900 py-8">
                {{-- SUMMARY CARDS --}}

                <div class="mx-auto max-w-4xl px-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 mb-8">
                        <x-summary-card title="Jumlah Desa" :value="$jumlahDesa" color="" />
                        <x-summary-card title="Jumlah Jumlah Penduduk" :value="$jumlahPenduduk" color="" />
                        <x-summary-card title="Jumlah Kartu Keluarga (KK)" :value="$jumlahKepalaKeluarga" color="" />
                    </div>

                    {{-- Map tampil disini --}}
                    <div id="map" class="w-full h-[500px] rounded-xl shadow-md"></div>
                </div>
            </div>

        </div>
        <!-- ====== Chart Three End -->
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
</x-admin-layout>
