@extends('layouts.app')

@section('title', 'Hasil Clustering')

@section('content')
<div class="min-h-screen bg-[#0f1117]">

    {{-- NAVBAR --}}
    <nav class="bg-[#0a0a0f]/80 backdrop-blur-xl border-b border-white/5 px-8 py-4 flex items-center justify-between sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-purple-500/20 border border-purple-500/30 flex items-center justify-center">
                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4V7m2 12H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z"/>
                </svg>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="text-gray-500 text-sm hover:text-gray-300 transition">
                Dashboard
            </a>

            <span class="text-gray-700">/</span>

            <span class="text-gray-300 text-sm">
                Hasil Clustering
            </span>
        </div>

        <div class="flex items-center gap-4">

            <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white/5 border border-white/10">
                <div class="w-6 h-6 rounded-full bg-purple-500/30 flex items-center justify-center">
                    <span class="text-purple-400 text-xs font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                </div>

                <span class="text-gray-300 text-sm">
                    {{ Auth::user()->name }}
                </span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5 border border-white/10 transition">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>

                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="px-8 py-10 max-w-7xl mx-auto">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-10">

            <div>
                <p class="text-gray-600 text-xs uppercase tracking-widest mb-2">
                    Machine Learning
                </p>

                <h1 class="text-3xl font-bold text-white">
                    Hasil Clustering Pola Karir
                </h1>

                <p class="text-gray-500 text-sm mt-1">
                    Analisis pengelompokan alumni berdasarkan model ML
                </p>
            </div>

            <a href="{{ route('admin.clustering.import') }}"
               class="inline-flex items-center gap-2 px-5 py-3 rounded-xl
                      bg-purple-500 hover:bg-purple-600
                      text-white text-sm font-semibold transition">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>

                Import CSV
            </a>

        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl px-5 py-4 text-sm">
                <div class="flex items-center gap-2">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                    </svg>

                    {{ session('success') }}
                </div>
            </div>
        @endif

        {{-- STATS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">

                <div class="flex items-center justify-between mb-3">

                    <p class="text-gray-500 text-xs uppercase tracking-wide">
                        Total Data
                    </p>

                    <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4V7"/>
                        </svg>
                    </div>
                </div>

                <p class="text-3xl font-bold text-white">
                    {{ $total }}
                </p>
            </div>

            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">

                <div class="flex items-center justify-between mb-3">

                    <p class="text-gray-500 text-xs uppercase tracking-wide">
                        Cluster 0
                    </p>

                    <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>

                <p class="text-3xl font-bold text-white">
                    {{ $cluster0 }}
                </p>

                <p class="text-xs text-gray-500 mt-2">
                    High Performer
                </p>
            </div>

            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">

                <div class="flex items-center justify-between mb-3">

                    <p class="text-gray-500 text-xs uppercase tracking-wide">
                        Cluster 1
                    </p>

                    <div class="w-8 h-8 rounded-lg bg-amber-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4l3 3"/>
                        </svg>
                    </div>
                </div>

                <p class="text-3xl font-bold text-white">
                    {{ $cluster1 }}
                </p>

                <p class="text-xs text-gray-500 mt-2">
                    Moderate Performer
                </p>
            </div>

        </div>

        @if($total > 0)

        {{-- CHARTS --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            {{-- DONUT --}}
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl overflow-hidden">

                <div class="px-6 py-4 border-b border-white/[0.06]">
                    <h2 class="text-white font-semibold text-sm">
                        Distribusi Cluster
                    </h2>

                    <p class="text-gray-500 text-xs mt-1">
                        Proporsi alumni per cluster
                    </p>
                </div>

                <div class="p-6">
                    <div class="relative h-72">
                        <canvas id="chartCluster"></canvas>
                    </div>
                </div>

            </div>

            {{-- RADAR --}}
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl overflow-hidden">

                <div class="px-6 py-4 border-b border-white/[0.06]">
                    <h2 class="text-white font-semibold text-sm">
                        Rata-rata Kompetensi
                    </h2>

                    <p class="text-gray-500 text-xs mt-1">
                        Perbandingan kompetensi antar cluster
                    </p>
                </div>

                <div class="p-6">
                    <div class="relative h-72">
                        <canvas id="chartKompetensi"></canvas>
                    </div>
                </div>

            </div>

        </div>

        {{-- BAR CHART --}}
        <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl overflow-hidden mb-6">

            <div class="px-6 py-4 border-b border-white/[0.06]">
                <h2 class="text-white font-semibold text-sm">
                    Distribusi per Program Studi
                </h2>

                <p class="text-gray-500 text-xs mt-1">
                    Sebaran cluster berdasarkan program studi
                </p>
            </div>

            <div class="p-6">
                <div class="relative h-96">
                    <canvas id="chartProdi"></canvas>
                </div>
            </div>

        </div>

        @else

        {{-- EMPTY --}}
        <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-16 text-center">

            <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4V7"/>
                </svg>
            </div>

            <h3 class="text-lg font-semibold text-gray-400 mb-2">
                Belum ada data clustering
            </h3>

            <p class="text-gray-500 text-sm mb-6">
                Import file CSV hasil clustering dari model machine learning
            </p>

            <a href="{{ route('admin.clustering.import') }}"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl
                       bg-purple-500 hover:bg-purple-600
                       text-white text-sm font-semibold transition">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>

                Import CSV Sekarang
            </a>

        </div>

        @endif

    </div>
</div>

@if($total > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const cluster0 = {{ $cluster0 }};
const cluster1 = {{ $cluster1 }};
const kompetensiData = @json($kompetensiCluster);
const perProdiData = @json($perProdi);

Chart.defaults.color = '#9CA3AF';
Chart.defaults.borderColor = 'rgba(255,255,255,0.08)';

new Chart(document.getElementById('chartCluster'), {
    type: 'doughnut',
    data: {
        labels: ['Cluster 0 — High Performer', 'Cluster 1 — Moderate Performer'],
        datasets: [{
            data: [cluster0, cluster1],
            backgroundColor: ['#10B981', '#F59E0B'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: '#9CA3AF'
                }
            }
        }
    }
});

const kompetensiLabels = [
    'Etika',
    'Keahlian',
    'Bhs Inggris',
    'Teknologi',
    'Komunikasi',
    'Kerjasama',
    'Pengembangan Diri',
    'Kepemimpinan'
];

const radarDatasets = kompetensiData.map(d => ({
    label: `Cluster ${d.label_cluster}`,
    data: [
        d.etika,
        d.keahlian,
        d.bahasa_inggris,
        d.teknologi,
        d.komunikasi,
        d.kerjasama,
        d.pengembangan_diri,
        d.kepemimpinan
    ].map(v => parseFloat(v) || 0),

    borderColor: d.label_cluster == 0 ? '#10B981' : '#F59E0B',
    backgroundColor: d.label_cluster == 0 ? '#10B98120' : '#F59E0B20',
    borderWidth: 2,
    pointRadius: 4,
}));

new Chart(document.getElementById('chartKompetensi'), {
    type: 'radar',
    data: {
        labels: kompetensiLabels,
        datasets: radarDatasets
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            r: {
                beginAtZero: true,
                max: 5,
                ticks: {
                    stepSize: 1,
                    color: '#9CA3AF',
                    backdropColor: 'transparent'
                },
                grid: {
                    color: 'rgba(255,255,255,0.08)'
                },
                pointLabels: {
                    color: '#D1D5DB'
                }
            }
        },
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: '#9CA3AF'
                }
            }
        }
    }
});

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
            {
                label: 'Cluster 0',
                data: c0Data,
                backgroundColor: '#10B981',
                borderRadius: 6
            },
            {
                label: 'Cluster 1',
                data: c1Data,
                backgroundColor: '#F59E0B',
                borderRadius: 6
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,

        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: '#9CA3AF'
                }
            }
        },

        scales: {
            x: {
                stacked: true,
                ticks: {
                    color: '#9CA3AF'
                },
                grid: {
                    display: false
                }
            },

            y: {
                stacked: true,
                beginAtZero: true,
                ticks: {
                    color: '#9CA3AF'
                },
                grid: {
                    color: 'rgba(255,255,255,0.08)'
                }
            }
        }
    }
});
</script>
@endif
@endsection