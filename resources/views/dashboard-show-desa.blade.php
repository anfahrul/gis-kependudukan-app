<x-layout>
    {{-- Section Header --}}
    <x-slot:title>
        Detail Desa <u>{{ $desa->nama_desa }}</u>
    </x-slot:title>
    <x-slot:title-description>
        Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat
        veniam occaecat.
    </x-slot:title-description>

    {{-- Section Titik Kecamatan --}}
    <div class="bg-white-900 border-t-2 border-gray-200 py-24 sm:py-24">

        <div class="mx-auto max-w-4xl px-6">
            {{-- Map tampil disini --}}
            <div id="map" class="mb-6 w-full h-[400px] rounded-xl shadow-md"></div>

            {{-- SUMMARY CARDS --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mb-8">
                <x-summary-card title="Jumlah Penduduk" :value="$totalPenduduk" color="blue" />
                <x-summary-card title="Jumlah KK" :value="$totalKK" color="" />
                <x-summary-card title="Jumlah Wajib KTP" :value="$wajibKtp" color="sky" />
                <x-summary-card title="Jumlah KTP" :value="$punyaKtp . ' (' . $persenKtp . '%)'" color="purple" />
            </div>

            {{-- CHARTS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="font-semibold text-center mb-2">Pendidikan</h2>
                    <canvas id="chartEducation"></canvas>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="font-semibold text-center mb-2">Jenis Kelamin</h2>
                    <canvas id="chartGender"></canvas>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="font-semibold text-center mb-2">Agama</h2>
                    <canvas id="chartReligion"></canvas>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="font-semibold text-center mb-2">Golongan Darah</h2>
                    <canvas id="chartBlood"></canvas>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-1">
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="font-semibold text-center mb-2">Pekerjaan Teratas</h2>
                    <canvas id="chartJob"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
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
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map').setView([-4.1, 121.6], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Panggil API GeoJSON untuk desa ini saja
            fetch("{{ url('/api/geojson/desa/' . $desa->OBJECTID) }}")
                .then(res => res.json())
                .then(data => {
                    console.log('data', data);

                    const layer = L.geoJSON(data, {
                        style: {
                            color: '#2563eb',
                            weight: 2,
                            fillColor: '#31A354',
                            fillOpacity: 0.5
                        }
                    }).addTo(map);

                    map.fitBounds(layer.getBounds());

                    // Tambahkan popup info
                    layer.eachLayer(l => {
                        const props = l.feature.properties;
                        l.bindPopup(`
                    <strong>${props.NAMOBJ}</strong><br>
                    Jumlah Penduduk: {{ number_format($totalPenduduk) }}
                `).openPopup();
                    });
                });

            // CHART: Pendidikan
            new Chart(document.getElementById('chartEducation'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($pendidikan->keys()) !!},
                    datasets: [{
                        data: {!! json_encode($pendidikan->values()) !!},
                        backgroundColor: '#FBBF24'
                    }]
                },
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.parsed.y;
                                    const data = context.dataset.data;
                                    const total = data.reduce((a, b) => a + b, 0);
                                    const percent = ((value / total) * 100).toFixed(1);
                                    return `${value} orang (${percent}%)`;
                                }
                            }
                        },
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Penduduk'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tingkat Pendidikan'
                            }
                        }
                    }
                }
            });

            // CHART: Jenis Kelamin
            new Chart(document.getElementById('chartGender'), {
                type: 'pie',
                data: {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        data: [{{ $laki }}, {{ $perempuan }}],
                        backgroundColor: ['#4A90E2', '#FF69B4']
                    }]
                },
                options: {
                    aspectRatio: 2,
                    maintainAspectRatio: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.parsed || 0;
                                    let total = context.chart._metasets[0].total;
                                    let percentage = ((value / total) * 100).toFixed(1);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // CHART: Agama
            const ctxReligion = document.getElementById('chartReligion');
            const dataReligion = {!! json_encode($agama->values()) !!};
            const labelsReligion = {!! json_encode($agama->keys()) !!};

            const totalReligion = dataReligion.reduce((a, b) => a + b, 0);

            new Chart(ctxReligion, {
                type: 'pie',
                data: {
                    labels: labelsReligion,
                    datasets: [{
                        data: dataReligion,
                        backgroundColor: [
                            '#16A34A', '#F59E0B', '#EF4444', '#3B82F6', '#8B5CF6', '#6B7280'
                        ]
                    }]
                },
                options: {
                    aspectRatio: 2,
                    maintainAspectRatio: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed;
                                    const percentage = ((value / totalReligion) * 100).toFixed(1);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        },
                        legend: {
                            position: 'bottom',
                            labels: {
                                generateLabels: function(chart) {
                                    const data = chart.data;
                                    if (data.labels.length && data.datasets.length) {
                                        return data.labels.map(function(label, i) {
                                            const value = data.datasets[0].data[i];
                                            const percentage = ((value / totalReligion) * 100)
                                                .toFixed(1);
                                            return {
                                                text: `${label} (${percentage}%)`,
                                                fillStyle: data.datasets[0].backgroundColor[i],
                                                hidden: isNaN(value),
                                                index: i
                                            };
                                        });
                                    }
                                    return [];
                                }
                            }
                        }
                    }
                }
            });

            // CHART: Pekerjaan
            new Chart(document.getElementById('chartJob'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($pekerjaan->pluck('nama_pekerjaan')) !!},
                    datasets: [{
                        label: 'Jumlah Penduduk',
                        data: {!! json_encode($pekerjaan->pluck('jumlah')) !!},
                        backgroundColor: '#60A5FA'
                    }]
                },
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.parsed.y;
                                    const data = context.dataset.data;
                                    const total = data.reduce((a, b) => a + b, 0);
                                    const percent = ((value / total) * 100).toFixed(1);
                                    return `${value} orang (${percent}%)`;
                                }
                            }
                        },
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: '5 Pekerjaan Terbanyak Penduduk',
                            font: {
                                size: 14
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Penduduk'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Pekerjaan'
                            }
                        }
                    }
                }
            });


            // CHART: Golongan Darah
            new Chart(document.getElementById('chartBlood'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($golonganDarah->keys()) !!},
                    datasets: [{
                        label: 'Jumlah Penduduk',
                        data: {!! json_encode($golonganDarah->values()) !!},
                        backgroundColor: '#60A5FA' // biru muda
                    }]
                },
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.parsed.y;
                                    const data = context.dataset.data;
                                    const total = data.reduce((a, b) => a + b, 0);
                                    const percent = ((value / total) * 100).toFixed(1);
                                    return `${value} orang (${percent}%)`;
                                }
                            }
                        },
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Distribusi Golongan Darah Penduduk',
                            font: {
                                size: 14
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Penduduk'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Golongan Darah'
                            }
                        }
                    }
                }
            });

        });
    </script>

</x-layout>
