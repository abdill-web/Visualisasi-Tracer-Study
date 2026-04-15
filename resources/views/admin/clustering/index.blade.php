@extends('layouts.app')

@section('title', 'Hasil Clustering')

@section('content')
<div class="min-h-screen bg-gray-100">
    <nav class="bg-gray-900 text-white px-6 py-4 flex items-center justify-between shadow-lg">
        <div class="flex items-center gap-3">
            <i class="fas fa-shield-halved text-xl"></i>
            <span class="font-bold text-lg">Tracer Study — Admin Panel</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-white text-sm">
                <i class="fas fa-house mr-1"></i> Dashboard
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    <i class="fas fa-right-from-bracket mr-1"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="p-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Hasil Clustering Pola Karir</h1>
                <p class="text-gray-500 text-sm">Analisis pengelompokan alumni berdasarkan model ML</p>
            </div>
            <a href="{{ route('admin.clustering.import') }}"
               class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium flex items-center gap-2 transition">
                <i class="fas fa-upload"></i> Import CSV
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 mb-6 text-sm">
                <i class="fas fa-circle-check mr-1"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Stats --}}
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-500">
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Total Data</p>
                <p class="text-3xl font-bold text-gray-800">{{ $total }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-500">
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Cluster 0 — High Performer</p>
                <p class="text-3xl font-bold text-gray-800">{{ $cluster0 }}</p>
                <p class="text-xs text-gray-400 mt-1">Kompetensi & adaptasi tinggi</p>
            </div>
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-orange-500">
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Cluster 1 — Moderate Performer</p>
                <p class="text-3xl font-bold text-gray-800">{{ $cluster1 }}</p>
                <p class="text-xs text-gray-400 mt-1">Kompetensi & adaptasi sedang</p>
            </div>
        </div>

        @if($total > 0)
        {{-- Charts --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-bold text-gray-800 mb-1">Distribusi Cluster</h3>
                <p class="text-xs text-gray-400 mb-4">Proporsi alumni per cluster</p>
                <div class="relative h-64">
                    <canvas id="chartCluster"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-bold text-gray-800 mb-1">Rata-rata Kompetensi per Cluster</h3>
                <p class="text-xs text-gray-400 mb-4">Perbandingan profil kompetensi antar cluster</p>
                <div class="relative h-64">
                    <canvas id="chartKompetensi"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h3 class="font-bold text-gray-800 mb-1">Distribusi Cluster per Program Studi</h3>
            <p class="text-xs text-gray-400 mb-4">Sebaran cluster berdasarkan program studi</p>
            <div class="relative h-80">
                <canvas id="chartProdi"></canvas>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        const cluster0 = {{ $cluster0 }};
        const cluster1 = {{ $cluster1 }};
        const kompetensiData = @json($kompetensiCluster);
        const perProdiData = @json($perProdi);

        // 1. Donut Cluster
        new Chart(document.getElementById('chartCluster'), {
            type: 'doughnut',
            data: {
                labels: ['Cluster 0 — High Performer', 'Cluster 1 — Moderate Performer'],
                datasets: [{
                    data: [cluster0, cluster1],
                    backgroundColor: ['#10B981', '#F59E0B'],
                    borderWidth: 2
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
        });

        // 2. Radar Kompetensi
        const kompetensiLabels = ['Etika','Keahlian','Bhs Inggris','Teknologi','Komunikasi','Kerjasama','Pengembangan Diri','Kepemimpinan'];
        const radarDatasets = kompetensiData.map(d => ({
            label: `Cluster ${d.label_cluster}`,
            data: [d.etika, d.keahlian, d.bahasa_inggris, d.teknologi, d.komunikasi, d.kerjasama, d.pengembangan_diri, d.kepemimpinan].map(v => parseFloat(v) || 0),
            borderColor: d.label_cluster == 0 ? '#10B981' : '#F59E0B',
            backgroundColor: d.label_cluster == 0 ? '#10B98120' : '#F59E0B20',
            borderWidth: 2,
            pointRadius: 4,
        }));

        new Chart(document.getElementById('chartKompetensi'), {
            type: 'radar',
            data: { labels: kompetensiLabels, datasets: radarDatasets },
            options: {
                responsive: true, maintainAspectRatio: false,
                scales: { r: { beginAtZero: true, max: 5, ticks: { stepSize: 1 } } },
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // 3. Bar Stacked per Prodi
        const prodiList = [...new Set(perProdiData.map(d => d.program_studi))];
        const c0Data = prodiList.map(p => {
            const found = perProdiData.find(d => d.program_studi === p && d.label_cluster == 0);
            return found ? found.total : 0;
        });
        const c1Data = prodiList.map(p => {
            const found = perProdiData.find(d => d.program_studi === p && d.label_cluster == 1);
            return found ? found.total : 0;
        });

        new Chart(document.getElementById('chartProdi'), {
            type: 'bar',
            data: {
                labels: prodiList,
                datasets: [
                    { label: 'Cluster 0 — High Performer', data: c0Data, backgroundColor: '#10B981', borderRadius: 4 },
                    { label: 'Cluster 1 — Moderate Performer', data: c1Data, backgroundColor: '#F59E0B', borderRadius: 4 }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } },
                scales: {
                    x: { stacked: true, grid: { display: false } },
                    y: { stacked: true, beginAtZero: true, grid: { color: '#f0f0f0' } }
                }
            }
        });
        </script>
        @else
        <div class="bg-white rounded-xl shadow p-12 text-center">
            <i class="fas fa-diagram-project text-5xl text-gray-300 mb-4 block"></i>
            <h3 class="font-semibold text-gray-500 mb-2">Belum ada data clustering</h3>
            <p class="text-gray-400 text-sm mb-4">Import file CSV hasil clustering dari model ML</p>
            <a href="{{ route('admin.clustering.import') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium inline-flex items-center gap-2 transition">
                <i class="fas fa-upload"></i> Import CSV Sekarang
            </a>
        </div>
        @endif
    </div>
</div>
@endsection