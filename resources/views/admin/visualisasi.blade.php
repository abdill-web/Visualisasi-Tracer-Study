@extends('layouts.app')

@section('title', 'Visualisasi & AI - Tracer Study')

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
                            from-emerald-500 to-teal-600
                            flex items-center justify-center
                            shadow-lg shadow-emerald-500/20">

                    <img src="{{ asset('images/logo-kampus.png') }}"
                         alt="Logo"
                         class="w-8 h-8 object-contain">
                </div>

                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Tracer Study
                    </h1>

                    <p class="text-sm text-gray-500">
                        Universitas Mercu Buana
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
                                from-emerald-500 to-teal-600
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
                    from-emerald-500
                    via-teal-500
                    to-emerald-600
                    rounded-[36px]
                    p-10 lg:p-12
                    shadow-xl shadow-emerald-500/10
                    mb-8">

            <div class="flex flex-col lg:flex-row
                        lg:items-center
                        lg:justify-between gap-8">

                {{-- LEFT --}}
                <div>

                    <p class="text-emerald-100
                              text-xs uppercase
                              tracking-[0.4em]
                              mb-4">

                        VISUALISASI & AI
                    </p>

                    <h1 class="text-5xl lg:text-6xl
                               font-bold text-white
                               leading-tight mb-4">

                        Analytics<br>
                        Dashboard
                    </h1>

                    <p class="text-emerald-100 text-lg">
                        Analisis visual dan AI terhadap pola karir
                        alumni tracer study Universitas Mercu Buana.
                    </p>
                </div>

                {{-- RIGHT --}}
                <div class="grid grid-cols-2 gap-4">

                    <div class="bg-white/10 backdrop-blur-md
                                border border-white/10
                                rounded-[28px]
                                px-6 py-5 min-w-[170px]">

                        <p class="text-emerald-100 text-sm mb-2">
                            Total Alumni
                        </p>

                        <h3 class="text-4xl font-bold text-white">
                            {{ $total }}
                        </h3>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md
                                border border-white/10
                                rounded-[28px]
                                px-6 py-5 min-w-[170px]">

                        <p class="text-emerald-100 text-sm mb-2">
                            Data Terkumpul
                        </p>

                        <h3 class="text-4xl font-bold text-white">
                            {{ $totalIsi }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-1 md:grid-cols-2
                    lg:grid-cols-4 gap-6 mb-8">

            {{-- CARD --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="flex items-center justify-between mb-5">

                    <div>

                        <p class="text-sm text-gray-500 mb-1">
                            Total Alumni
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
                                  d="M17 20h5v-2a3 3 0
                                     00-5.356-1.857M17
                                     20H7m10 0v-2c0-.656
                                     -.126-1.283-.356
                                     -1.857M7 20H2v-2a3
                                     3 0 015.356-1.857"/>
                        </svg>
                    </div>
                </div>

                <p class="text-gray-500 text-sm">
                    Total alumni pada sistem tracer study
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="flex items-center justify-between mb-5">

                    <div>

                        <p class="text-sm text-gray-500 mb-1">
                            Data Terkumpul
                        </p>

                        <h2 class="text-5xl font-bold text-gray-900">
                            {{ $totalIsi }}
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
                                  d="M9 12l2 2 4-4m6 2a9
                                     9 0 11-18 0 9 9 0
                                     0118 0z"/>
                        </svg>
                    </div>
                </div>

                <p class="text-gray-500 text-sm">
                    Total responden yang telah mengisi
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="flex items-center justify-between mb-5">

                    <div>

                        <p class="text-sm text-gray-500 mb-1">
                            Response Rate
                        </p>

                        <h2 class="text-5xl font-bold text-gray-900">
                            {{ $total > 0 ? round(($totalIsi/$total)*100) : 0 }}%
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
                                  d="M11 3.055A9.001 9.001
                                     0 1020.945 13H11V3.055z"/>
                        </svg>
                    </div>
                </div>

                <p class="text-gray-500 text-sm">
                    Tingkat partisipasi alumni
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="flex items-center justify-between mb-5">

                    <div>

                        <p class="text-sm text-gray-500 mb-1">
                            Sudah Bekerja
                        </p>

                        <h2 class="text-5xl font-bold text-gray-900">
                            {{ $statusData['bekerja'] ?? 0 }}
                        </h2>
                    </div>

                    <div class="w-16 h-16 rounded-2xl
                                bg-purple-100
                                flex items-center justify-center">

                        <svg class="w-8 h-8 text-purple-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 17v-2m3 2v-4m3
                                     4v-6m2 10H7a2 2 0
                                     01-2-2V5a2 2 0
                                     012-2h10a2 2 0
                                     012 2v14a2 2 0
                                     01-2 2z"/>
                        </svg>
                    </div>
                </div>

                <p class="text-gray-500 text-sm">
                    Alumni dengan status bekerja
                </p>
            </div>
        </div>

        {{-- CHARTS --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            {{-- STATUS --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="mb-5">

                    <p class="text-xs uppercase
                              tracking-[0.3em]
                              text-gray-500 mb-2">

                        STATUS ALUMNI
                    </p>

                    <h3 class="text-2xl font-bold text-gray-900">
                        Distribusi Status
                    </h3>
                </div>

                <div class="relative h-80">
                    <canvas id="chartStatus"></canvas>
                </div>
            </div>

            {{-- RELEVANSI --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="mb-5">

                    <p class="text-xs uppercase
                              tracking-[0.3em]
                              text-gray-500 mb-2">

                        RELEVANSI
                    </p>

                    <h3 class="text-2xl font-bold text-gray-900">
                        Bidang Studi
                    </h3>
                </div>

                <div class="relative h-80">
                    <canvas id="chartRelevansi"></canvas>
                </div>
            </div>
        </div>

        {{-- BIDANG --}}
        <div class="bg-white rounded-[32px]
                    border border-gray-200
                    shadow-sm p-7 mb-6">

            <div class="mb-5">

                <p class="text-xs uppercase
                          tracking-[0.3em]
                          text-gray-500 mb-2">

                    BIDANG PEKERJAAN
                </p>

                <h3 class="text-2xl font-bold text-gray-900">
                    Distribusi Bidang Karir
                </h3>
            </div>

            <div class="relative h-[420px]">
                <canvas id="chartBidang"></canvas>
            </div>
        </div>

        {{-- ROW --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            {{-- TREN --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="mb-5">

                    <p class="text-xs uppercase
                              tracking-[0.3em]
                              text-gray-500 mb-2">

                        TREN KARIR
                    </p>

                    <h3 class="text-2xl font-bold text-gray-900">
                        Per Tahun Lulus
                    </h3>
                </div>

                <div class="relative h-80">
                    <canvas id="chartTren"></canvas>
                </div>
            </div>

            {{-- PROVINSI --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="mb-5">

                    <p class="text-xs uppercase
                              tracking-[0.3em]
                              text-gray-500 mb-2">

                        LOKASI KERJA
                    </p>

                    <h3 class="text-2xl font-bold text-gray-900">
                        Top Provinsi
                    </h3>
                </div>

                <div class="relative h-80">
                    <canvas id="chartProvinsi"></canvas>
                </div>
            </div>
        </div>

        {{-- PENDAPATAN --}}
        <div class="bg-white rounded-[32px]
                    border border-gray-200
                    shadow-sm p-7 mb-6">

            <div class="mb-5">

                <p class="text-xs uppercase
                          tracking-[0.3em]
                          text-gray-500 mb-2">

                    PENDAPATAN
                </p>

                <h3 class="text-2xl font-bold text-gray-900">
                    Rata-rata Pendapatan
                </h3>
            </div>

            <div class="relative h-[420px]">
                <canvas id="chartPendapatan"></canvas>
            </div>
        </div>

        {{-- AI --}}
        <div class="bg-white rounded-[32px]
                    border border-gray-200
                    shadow-sm p-7 mb-6">

            <div class="flex flex-col lg:flex-row
                        lg:items-center
                        lg:justify-between gap-5 mb-6">

                <div>

                    <p class="text-xs uppercase
                              tracking-[0.3em]
                              text-gray-500 mb-2">

                        AI ANALYSIS
                    </p>

                    <h3 class="text-2xl font-bold text-gray-900">
                        Analisis Pola Karir AI
                    </h3>
                </div>

                <button onclick="generateAIAnalysis()"
                        id="btnAnalisis"
                        class="flex items-center justify-center gap-2
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
                              d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>

                    Generate Analisis
                </button>
            </div>

            <div id="aiResult" class="hidden">

                <div class="bg-purple-50
                            border border-purple-200
                            rounded-[28px]
                            p-6">

                    <div id="aiLoading"
                         class="flex items-center gap-3
                                text-purple-600">

                        <svg class="w-5 h-5 animate-spin"
                             fill="none"
                             viewBox="0 0 24 24">

                            <circle class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4">
                            </circle>

                            <path class="opacity-75"
                                  fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0
                                     C5.373 0 0 5.373 0 12h4z">
                            </path>
                        </svg>

                        <span class="font-medium">
                            AI sedang menganalisis data...
                        </span>
                    </div>

                    <div id="aiContent"
                         class="hidden text-gray-700
                                leading-relaxed">
                    </div>
                </div>
            </div>
        </div>

        {{-- BOTTOM --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- CLUSTERING --}}
            <a href="{{ route('admin.clustering.index') }}"
               class="group bg-white rounded-[32px]
                      border border-gray-200
                      shadow-sm p-8
                      hover:shadow-xl
                      hover:-translate-y-1
                      transition-all duration-300">

                <div class="text-center py-8">

                    <div class="w-20 h-20 rounded-[28px]
                                bg-purple-100
                                flex items-center justify-center
                                mx-auto mb-6
                                group-hover:scale-105
                                transition">

                        <svg class="w-10 h-10 text-purple-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M4 6a2 2 0 012-2h2
                                     a2 2 0 012 2v2a2 2
                                     0 01-2 2H6a2 2 0
                                     01-2-2V6z"/>
                        </svg>
                    </div>

                    <h3 class="text-2xl font-bold
                               text-gray-900 mb-3">

                        Clustering Pola Karir
                    </h3>

                    <p class="text-gray-500 mb-6">
                        Analisis pengelompokan alumni
                        berbasis machine learning.
                    </p>

                    <span class="inline-flex items-center gap-2
                                 px-4 py-2 rounded-full
                                 bg-purple-100
                                 text-purple-700
                                 font-medium">

                        Lihat Clustering

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </div>
            </a>

            {{-- PREDIKSI --}}
            <div class="bg-white rounded-[32px]
                        border border-dashed border-gray-300
                        shadow-sm p-8">

                <div class="text-center py-8">

                    <div class="w-20 h-20 rounded-[28px]
                                bg-gray-100
                                flex items-center justify-center
                                mx-auto mb-6">

                        <svg class="w-10 h-10 text-gray-500"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9.663 17h4.673M12
                                     3v1m6.364 1.636
                                     l-.707.707"/>
                        </svg>
                    </div>

                    <h3 class="text-2xl font-bold
                               text-gray-700 mb-3">

                        Prediksi Alumni
                    </h3>

                    <p class="text-gray-500 mb-6">
                        Model prediksi keberhasilan alumni
                        akan segera tersedia.
                    </p>

                    <span class="inline-flex items-center gap-2
                                 px-4 py-2 rounded-full
                                 bg-amber-100
                                 text-amber-700
                                 font-medium">

                        <div class="w-2 h-2 rounded-full
                                    bg-amber-500 animate-pulse">
                        </div>

                        Coming Soon
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- CHART JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
Chart.defaults.color = '#6b7280';
Chart.defaults.borderColor = '#e5e7eb';

const statusData     = @json($statusData);
const bidangData     = @json($bidangData);
const relevansiData  = @json($relevansiData);
const trenData       = @json($trenData);
const provinsiData   = @json($provinsiData);
const pendapatanData = @json($pendapatanData);

const COLORS = [
    '#3B82F6',
    '#10B981',
    '#F59E0B',
    '#EF4444',
    '#8B5CF6',
    '#06B6D4'
];

const statusLabels = {
    bekerja: 'Bekerja',
    wirausaha: 'Wirausaha',
    studi_lanjut: 'Studi Lanjut',
    tidak_bekerja: 'Tidak Bekerja',
    belum_bekerja: 'Belum Bekerja'
};

new Chart(document.getElementById('chartStatus'), {
    type: 'doughnut',
    data: {
        labels: Object.keys(statusData).map(k => statusLabels[k] || k),
        datasets: [{
            data: Object.values(statusData),
            backgroundColor: COLORS,
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

new Chart(document.getElementById('chartRelevansi'), {
    type: 'pie',
    data: {
        labels: Object.keys(relevansiData),
        datasets: [{
            data: Object.values(relevansiData),
            backgroundColor: COLORS,
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

new Chart(document.getElementById('chartBidang'), {
    type: 'bar',
    data: {
        labels: Object.keys(bidangData),
        datasets: [{
            data: Object.values(bidangData),
            backgroundColor: '#3B82F6',
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

new Chart(document.getElementById('chartProvinsi'), {
    type: 'bar',
    data: {
        labels: Object.keys(provinsiData),
        datasets: [{
            data: Object.values(provinsiData),
            backgroundColor: '#8B5CF6',
            borderRadius: 8
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false
    }
});

new Chart(document.getElementById('chartPendapatan'), {
    type: 'bar',
    data: {
        labels: Object.keys(pendapatanData),
        datasets: [{
            data: Object.values(pendapatanData),
            backgroundColor: '#10B981',
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

async function generateAIAnalysis() {

    const btn = document.getElementById('btnAnalisis');
    const result = document.getElementById('aiResult');
    const loading = document.getElementById('aiLoading');
    const content = document.getElementById('aiContent');

    btn.disabled = true;

    result.classList.remove('hidden');
    loading.classList.remove('hidden');
    content.classList.add('hidden');

    try {

        const response = await fetch(
            "{{ route('admin.ai.analysis') }}",
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            }
        );

        const data = await response.json();

        loading.classList.add('hidden');
        content.classList.remove('hidden');

        content.innerHTML = data.result
            .replace(/\*\*(.*?)\*\*/g,
                '<strong class="text-gray-900">$1</strong>')
            .replace(/\n/g, '<br>');

    } catch (err) {

        loading.classList.add('hidden');
        content.classList.remove('hidden');

        content.innerHTML = `
            <div class="text-red-600">
                Gagal mengambil analisis AI.
            </div>
        `;
    }

    btn.disabled = false;
}
</script>

@endsection