@extends('layouts.app')

@section('title', 'Hasil Clustering')

@section('content')

<div class="min-h-screen bg-[#f5f7fb]">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-gray-200
                px-8 py-4 sticky top-0 z-50">

        <div class="max-w-7xl mx-auto
                    flex items-center justify-between">

            {{-- LEFT --}}
            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-2xl
                            bg-gradient-to-br
                            from-purple-500 to-indigo-600
                            flex items-center justify-center
                            shadow-lg shadow-purple-500/20">

                    <img src="{{ asset('images/logo-kampus.png') }}"
                         alt="Logo"
                         class="w-8 h-8 object-contain">
                </div>

                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Clustering AI
                    </h1>

                    <p class="text-sm text-gray-500">
                        Machine Learning Career Analysis
                    </p>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-4">

                {{-- USER --}}
                <div class="flex items-center gap-3
                            bg-white border border-gray-200
                            rounded-2xl px-4 py-2 shadow-sm">

                    <div class="w-11 h-11 rounded-xl
                                bg-gradient-to-br
                                from-purple-500 to-indigo-600
                                flex items-center justify-center
                                text-white font-bold">

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-800">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Administrator
                        </p>
                    </div>
                </div>

                {{-- LOGOUT --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="flex items-center gap-2
                                   px-5 py-3 rounded-2xl
                                   bg-white border border-gray-200
                                   text-gray-600 hover:text-red-500
                                   hover:border-red-200
                                   transition-all duration-300
                                   shadow-sm">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1
                                     a3 3 0 01-3 3H6a3 3 0 01-3-3V7
                                     a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>

                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-10">

        {{-- HERO --}}
        <div class="bg-gradient-to-r
                    from-purple-500
                    via-indigo-500
                    to-purple-600
                    rounded-[36px]
                    p-10 lg:p-12
                    shadow-xl shadow-purple-500/10
                    mb-8">

            <div class="flex flex-col lg:flex-row
                        lg:items-center
                        lg:justify-between gap-8">

                {{-- LEFT --}}
                <div>

                    <p class="text-purple-100
                              text-xs uppercase
                              tracking-[0.4em]
                              mb-4">

                        MACHINE LEARNING
                    </p>

                    <h1 class="text-5xl lg:text-6xl
                               font-bold text-white
                               leading-tight mb-4">

                        Career<br>
                        Clustering
                    </h1>

                    <p class="text-purple-100 text-lg">
                        Analisis pengelompokan pola karir alumni
                        menggunakan machine learning clustering.
                    </p>
                </div>

                {{-- RIGHT --}}
                <div class="grid grid-cols-2 gap-4">

                    <div class="bg-white/10 backdrop-blur-md
                                border border-white/10
                                rounded-[28px]
                                px-6 py-5 min-w-[170px]">

                        <p class="text-purple-100 text-sm mb-2">
                            Total Data
                        </p>

                        <h3 class="text-4xl font-bold text-white">
                            {{ $total }}
                        </h3>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md
                                border border-white/10
                                rounded-[28px]
                                px-6 py-5 min-w-[170px]">

                        <p class="text-purple-100 text-sm mb-2">
                            Cluster Aktif
                        </p>

                        <h3 class="text-4xl font-bold text-white">
                            2
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- TOP ACTION --}}
        <div class="flex flex-col lg:flex-row
                    lg:items-center
                    lg:justify-between gap-5 mb-6">

            <div>

                <p class="text-xs uppercase
                          tracking-[0.3em]
                          text-gray-500 mb-2">

                    CLUSTERING RESULT
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    Hasil Analisis Cluster
                </h2>
            </div>

            <a href="{{ route('admin.clustering.import') }}"
               class="inline-flex items-center justify-center gap-2
                      px-6 py-4 rounded-2xl
                      text-white font-semibold
                      shadow-lg shadow-purple-500/20
                      transition-all duration-300
                      hover:scale-[1.01]"
               style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M7 16a4 4 0 01-.88-7.903A5
                             5 0 1115.9 6L16 6a5 5 0
                             011 9.9M15 13l-3-3m0 0l-3
                             3m3-3v12"/>
                </svg>

                Import CSV
            </a>
        </div>

        {{-- ALERT --}}
        @if(session('success'))

        <div class="mb-6 bg-emerald-50
                    border border-emerald-200
                    text-emerald-700
                    rounded-[28px]
                    px-6 py-5">

            <div class="flex items-center gap-3">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7"/>
                </svg>

                <span class="font-medium">
                    {{ session('success') }}
                </span>
            </div>
        </div>

        @endif

        {{-- STATS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            {{-- CARD --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="flex items-center justify-between mb-5">

                    <div>

                        <p class="text-sm text-gray-500 mb-1">
                            Total Data
                        </p>

                        <h2 class="text-5xl font-bold text-gray-900">
                            {{ $total }}
                        </h2>
                    </div>

                    <div class="w-16 h-16 rounded-2xl
                                bg-blue-100
                                flex items-center justify-center">

                        <svg class="w-8 h-8 text-blue-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 17v-2m3 2v-4m3
                                     4V7m2 12H5a2 2 0
                                     01-2-2V5a2 2 0
                                     012-2h14a2 2 0
                                     012 2v12a2 2 0
                                     01-2 2z"/>
                        </svg>
                    </div>
                </div>

                <p class="text-gray-500 text-sm">
                    Total data hasil clustering
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="flex items-center justify-between mb-5">

                    <div>

                        <p class="text-sm text-gray-500 mb-1">
                            Cluster 0
                        </p>

                        <h2 class="text-5xl font-bold text-gray-900">
                            {{ $cluster0 }}
                        </h2>
                    </div>

                    <div class="w-16 h-16 rounded-2xl
                                bg-emerald-100
                                flex items-center justify-center">

                        <svg class="w-8 h-8 text-emerald-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>

                <p class="text-gray-500 text-sm">
                    High performer cluster
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="flex items-center justify-between mb-5">

                    <div>

                        <p class="text-sm text-gray-500 mb-1">
                            Cluster 1
                        </p>

                        <h2 class="text-5xl font-bold text-gray-900">
                            {{ $cluster1 }}
                        </h2>
                    </div>

                    <div class="w-16 h-16 rounded-2xl
                                bg-amber-100
                                flex items-center justify-center">

                        <svg class="w-8 h-8 text-amber-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 8v4l3 3"/>
                        </svg>
                    </div>
                </div>

                <p class="text-gray-500 text-sm">
                    Moderate performer cluster
                </p>
            </div>
        </div>

        @if($total > 0)

        {{-- CHARTS --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            {{-- DONUT --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="mb-5">

                    <p class="text-xs uppercase
                              tracking-[0.3em]
                              text-gray-500 mb-2">

                        DISTRIBUSI CLUSTER
                    </p>

                    <h3 class="text-2xl font-bold text-gray-900">
                        Proporsi Cluster
                    </h3>
                </div>

                <div class="relative h-80">
                    <canvas id="chartCluster"></canvas>
                </div>
            </div>

            {{-- RADAR --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="mb-5">

                    <p class="text-xs uppercase
                              tracking-[0.3em]
                              text-gray-500 mb-2">

                        KOMPETENSI
                    </p>

                    <h3 class="text-2xl font-bold text-gray-900">
                        Perbandingan Kompetensi
                    </h3>
                </div>

                <div class="relative h-80">
                    <canvas id="chartKompetensi"></canvas>
                </div>
            </div>
        </div>

        {{-- BAR --}}
        <div class="bg-white rounded-[32px]
                    border border-gray-200
                    shadow-sm p-7 mb-6">

            <div class="mb-5">

                <p class="text-xs uppercase
                          tracking-[0.3em]
                          text-gray-500 mb-2">

                    PROGRAM STUDI
                </p>

                <h3 class="text-2xl font-bold text-gray-900">
                    Distribusi per Program Studi
                </h3>
            </div>

            <div class="relative h-[450px]">
                <canvas id="chartProdi"></canvas>
            </div>
        </div>

        @else

        {{-- EMPTY --}}
        <div class="bg-white rounded-[36px]
                    border border-gray-200
                    shadow-sm p-16 text-center">

            <div class="w-24 h-24 rounded-[32px]
                        bg-gray-100
                        flex items-center justify-center
                        mx-auto mb-6">

                <svg class="w-12 h-12 text-gray-500"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 17v-2m3 2v-4m3
                             4V7m2 12H5a2 2 0
                             01-2-2V5a2 2 0
                             012-2h14a2 2 0
                             012 2v12a2 2 0
                             01-2 2z"/>
                </svg>
            </div>

            <h3 class="text-3xl font-bold
                       text-gray-800 mb-3">

                Belum Ada Data Clustering
            </h3>

            <p class="text-gray-500 mb-8 max-w-xl mx-auto">
                Import file CSV hasil clustering machine learning
                untuk mulai melihat hasil analisis AI alumni.
            </p>

            <a href="{{ route('admin.clustering.import') }}"
               class="inline-flex items-center gap-2
                      px-6 py-4 rounded-2xl
                      text-white font-semibold
                      shadow-lg shadow-purple-500/20"
               style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M7 16a4 4 0 01-.88-7.903A5
                             5 0 1115.9 6L16 6a5 5 0
                             011 9.9M15 13l-3-3m0 0l-3
                             3m3-3v12"/>
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
const perProdiData   = @json($perProdi);

Chart.defaults.color = '#6b7280';
Chart.defaults.borderColor = '#e5e7eb';

new Chart(document.getElementById('chartCluster'), {

    type: 'doughnut',

    data: {
        labels: [
            'Cluster 0 — High Performer',
            'Cluster 1 — Moderate Performer'
        ],

        datasets: [{
            data: [cluster0, cluster1],
            backgroundColor: ['#10B981', '#F59E0B'],
            borderWidth: 0
        }]
    },

    options: {
        responsive: true,
        maintainAspectRatio: false
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

    borderColor: d.label_cluster == 0
        ? '#10B981'
        : '#F59E0B',

    backgroundColor: d.label_cluster == 0
        ? '#10B98120'
        : '#F59E0B20',

    borderWidth: 2,
    pointRadius: 4
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
                max: 5
            }
        }
    }
});

const prodiList = [
    ...new Set(perProdiData.map(
        d => d.program_studi
    ))
];

const c0Data = prodiList.map(p => {

    const found = perProdiData.find(
        d => d.program_studi === p
        && d.label_cluster == 0
    );

    return found ? found.total : 0;
});

const c1Data = prodiList.map(p => {

    const found = perProdiData.find(
        d => d.program_studi === p
        && d.label_cluster == 1
    );

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
                borderRadius: 8
            },

            {
                label: 'Cluster 1',
                data: c1Data,
                backgroundColor: '#F59E0B',
                borderRadius: 8
            }
        ]
    },

    options: {

        responsive: true,
        maintainAspectRatio: false,

        scales: {

            x: {
                stacked: true,
                grid: {
                    display: false
                }
            },

            y: {
                stacked: true,
                beginAtZero: true
            }
        }
    }
});

</script>

@endif

@endsection