@extends('layouts.app')

@section('title', 'Visualisasi & AI - Tracer Study')

@section('content')
<div class="min-h-screen bg-[#0f1117]">

    {{-- NAVBAR --}}
    <nav class="bg-[#0a0a0f]/80 backdrop-blur-xl border-b border-white/5 px-8 py-4 flex items-center justify-between sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-500 text-sm hover:text-gray-300 transition">Dashboard</a>
            <span class="text-gray-700">/</span>
            <span class="text-gray-300 text-sm">Visualisasi & AI</span>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white/5 border border-white/10">
                <div class="w-6 h-6 rounded-full bg-emerald-500/30 flex items-center justify-center">
                    <span class="text-emerald-400 text-xs font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <span class="text-gray-300 text-sm">{{ Auth::user()->name }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5 border border-white/10 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="px-8 py-10 max-w-7xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-10">
            <p class="text-gray-600 text-xs uppercase tracking-widest mb-2">Analytics</p>
            <h1 class="text-3xl font-bold text-white">Visualisasi & AI Pola Karir</h1>
            <p class="text-gray-500 text-sm mt-1">Analisis data tracer study alumni berbasis kecerdasan buatan</p>
        </div>

        {{-- SUMMARY CARDS --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">
                <p class="text-gray-500 text-xs uppercase tracking-wide mb-3">Total Alumni</p>
                <p class="text-4xl font-bold text-white">{{ $total }}</p>
                <div class="mt-3 h-1 bg-white/5 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-500 rounded-full" style="width: 100%"></div>
                </div>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">
                <p class="text-gray-500 text-xs uppercase tracking-wide mb-3">Data Terkumpul</p>
                <p class="text-4xl font-bold text-white">{{ $totalIsi }}</p>
                <div class="mt-3 h-1 bg-white/5 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $total > 0 ? round(($totalIsi/$total)*100) : 0 }}%"></div>
                </div>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">
                <p class="text-gray-500 text-xs uppercase tracking-wide mb-3">Response Rate</p>
                <p class="text-4xl font-bold text-white">{{ $total > 0 ? round(($totalIsi/$total)*100) : 0 }}<span class="text-2xl text-gray-500">%</span></p>
                <div class="mt-3 h-1 bg-white/5 rounded-full overflow-hidden">
                    <div class="h-full bg-amber-500 rounded-full" style="width: {{ $total > 0 ? round(($totalIsi/$total)*100) : 0 }}%"></div>
                </div>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">
                <p class="text-gray-500 text-xs uppercase tracking-wide mb-3">Sudah Bekerja</p>
                <p class="text-4xl font-bold text-white">{{ $statusData['bekerja'] ?? 0 }}</p>
                <div class="mt-3 h-1 bg-white/5 rounded-full overflow-hidden">
                    <div class="h-full bg-purple-500 rounded-full" style="width: {{ $totalIsi > 0 ? round((($statusData['bekerja'] ?? 0)/$totalIsi)*100) : 0 }}%"></div>
                </div>
            </div>
        </div>

        {{-- ROW 1: Status + Relevansi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">
                <h3 class="font-semibold text-white mb-1">Distribusi Status Alumni</h3>
                <p class="text-xs text-gray-600 mb-5">Kondisi alumni saat ini berdasarkan data tracer study</p>
                <div class="relative h-64">
                    <canvas id="chartStatus"></canvas>
                </div>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">
                <h3 class="font-semibold text-white mb-1">Relevansi Bidang Studi</h3>
                <p class="text-xs text-gray-600 mb-5">Kesesuaian antara bidang studi dan pekerjaan alumni</p>
                <div class="relative h-64">
                    <canvas id="chartRelevansi"></canvas>
                </div>
            </div>
        </div>

        {{-- ROW 2: Bar Bidang --}}
        <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6 mb-4">
            <h3 class="font-semibold text-white mb-1">Distribusi Bidang Pekerjaan Alumni</h3>
            <p class="text-xs text-gray-600 mb-5">Sebaran alumni berdasarkan sektor/bidang perusahaan</p>
            <div class="relative h-72">
                <canvas id="chartBidang"></canvas>
            </div>
        </div>

        {{-- ROW 3: Tren + Provinsi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">
                <h3 class="font-semibold text-white mb-1">Tren Karir per Tahun Lulus</h3>
                <p class="text-xs text-gray-600 mb-5">Perbandingan status alumni berdasarkan tahun kelulusan</p>
                <div class="relative h-64">
                    <canvas id="chartTren"></canvas>
                </div>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">
                <h3 class="font-semibold text-white mb-1">Top Provinsi Tempat Bekerja</h3>
                <p class="text-xs text-gray-600 mb-5">Daerah dengan jumlah alumni bekerja terbanyak</p>
                <div class="relative h-64">
                    <canvas id="chartProvinsi"></canvas>
                </div>
            </div>
        </div>

        {{-- ROW 4: Pendapatan --}}
        <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6 mb-4">
            <h3 class="font-semibold text-white mb-1">Rata-rata Pendapatan per Program Studi</h3>
            <p class="text-xs text-gray-600 mb-5">Perbandingan rata-rata pendapatan alumni berdasarkan program studi</p>
            <div class="relative h-72">
                <canvas id="chartPendapatan"></canvas>
            </div>
        </div>

        {{-- ROW 5: AI Analysis --}}
        <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6 mb-4">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-5 h-5 rounded bg-purple-500/20 flex items-center justify-center">
                            <svg class="w-3 h-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-white">Analisis AI Pola Karir</h3>
                    </div>
                    <p class="text-xs text-gray-600">Analisis otomatis berbasis AI dari data tracer study</p>
                </div>
                <button onclick="generateAIAnalysis()" id="btnAnalisis"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium text-white transition-all duration-300 hover:scale-[1.02]"
                        style="background: linear-gradient(135deg, #7c3aed, #6d28d9);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Generate Analisis
                </button>
            </div>

            <div id="aiResult" class="hidden">
                <div class="bg-purple-500/5 border border-purple-500/20 rounded-xl p-5">
                    <div id="aiLoading" class="flex items-center gap-3 text-purple-400">
                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        <span class="text-sm">AI sedang menganalisis data...</span>
                    </div>
                    <div id="aiContent" class="hidden text-sm text-gray-300 leading-relaxed"></div>
                </div>
            </div>
        </div>

        {{-- ROW 6: Clustering & Prediksi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('admin.clustering.index') }}"
               class="group bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6
                      hover:bg-white/[0.05] hover:border-purple-500/30 transition-all duration-300 block">
                <div class="text-center py-8">
                    <div class="w-14 h-14 rounded-2xl bg-purple-500/20 border border-purple-500/20 flex items-center justify-center mx-auto mb-4
                                group-hover:bg-purple-500/30 transition">
                        <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-white mb-2">Clustering Pola Karir</h3>
                    <p class="text-xs text-gray-600 mb-4">Analisis pengelompokan alumni berdasarkan model ML</p>
                    <span class="inline-flex items-center gap-1.5 bg-purple-500/20 text-purple-400 text-xs px-3 py-1.5 rounded-full font-medium">
                        Lihat Hasil Clustering
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </div>
            </a>
            <div class="bg-white/[0.03] border border-dashed border-white/[0.08] rounded-2xl p-6">
                <div class="text-center py-8">
                    <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-500 mb-2">Prediksi Keberhasilan Alumni</h3>
                    <p class="text-xs text-gray-600 mb-4">Hasil prediksi XGBoost, Random Forest & Regresi Logistik</p>
                    <span class="inline-flex items-center gap-1.5 bg-amber-500/10 text-amber-600 text-xs px-3 py-1.5 rounded-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                        Menunggu integrasi model
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
Chart.defaults.color = '#6b7280';
Chart.defaults.borderColor = 'rgba(255,255,255,0.05)';

const statusData     = @json($statusData);
const bidangData     = @json($bidangData);
const relevansiData  = @json($relevansiData);
const trenData       = @json($trenData);
const provinsiData   = @json($provinsiData);
const pendapatanData = @json($pendapatanData);

const COLORS = ['#3B82F6','#10B981','#F59E0B','#EF4444','#8B5CF6','#06B6D4','#EC4899','#84CC16'];

const statusLabels = {
    bekerja: 'Bekerja', wirausaha: 'Wirausaha',
    studi_lanjut: 'Studi Lanjut', tidak_bekerja: 'Tidak Bekerja', belum_bekerja: 'Belum Bekerja'
};

// 1. DONUT STATUS
new Chart(document.getElementById('chartStatus'), {
    type: 'doughnut',
    data: {
        labels: Object.keys(statusData).map(k => statusLabels[k] || k),
        datasets: [{ data: Object.values(statusData), backgroundColor: COLORS, borderWidth: 0, hoverOffset: 8 }]
    },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'right', labels: { color: '#9ca3af', padding: 12, font: { size: 11 } } } } }
});

// 2. PIE RELEVANSI
const relevansiLabels = {
    'Sangat erat': 'Sangat Erat', 'Erat': 'Erat',
    'Cukup erat': 'Cukup Erat', 'Kurang erat': 'Kurang Erat', 'Tidak sama sekali': 'Tidak Relevan'
};
new Chart(document.getElementById('chartRelevansi'), {
    type: 'pie',
    data: {
        labels: Object.keys(relevansiData).map(k => relevansiLabels[k] || k),
        datasets: [{ data: Object.values(relevansiData), backgroundColor: COLORS, borderWidth: 0, hoverOffset: 8 }]
    },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'right', labels: { color: '#9ca3af', padding: 12, font: { size: 11 } } } } }
});

// 3. BAR BIDANG
new Chart(document.getElementById('chartBidang'), {
    type: 'bar',
    data: {
        labels: Object.keys(bidangData),
        datasets: [{ label: 'Jumlah Alumni', data: Object.values(bidangData), backgroundColor: '#3B82F6', borderRadius: 6 }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1, color: '#6b7280' }, grid: { color: 'rgba(255,255,255,0.05)' } },
            x: { ticks: { color: '#6b7280' }, grid: { display: false } }
        }
    }
});

// 4. LINE TREN
const tahunSet = [...new Set(trenData.map(d => d.tahun_lulus))].sort();
const statusSet = ['bekerja', 'wirausaha', 'studi_lanjut', 'tidak_bekerja'];
const statusColors = { bekerja: '#10B981', wirausaha: '#F59E0B', studi_lanjut: '#8B5CF6', tidak_bekerja: '#EF4444' };

const trenDatasets = statusSet.map(status => ({
    label: statusLabels[status] || status,
    data: tahunSet.map(tahun => {
        const found = trenData.find(d => d.tahun_lulus == tahun && d.status_saat_ini === status);
        return found ? found.total : 0;
    }),
    borderColor: statusColors[status],
    backgroundColor: statusColors[status] + '15',
    tension: 0.4, fill: false, pointRadius: 5, pointHoverRadius: 7,
}));

new Chart(document.getElementById('chartTren'), {
    type: 'line',
    data: { labels: tahunSet, datasets: trenDatasets },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { color: '#9ca3af', padding: 16, font: { size: 11 } } } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1, color: '#6b7280' }, grid: { color: 'rgba(255,255,255,0.05)' } },
            x: { ticks: { color: '#6b7280' }, grid: { display: false } }
        }
    }
});

// 5. BAR HORIZONTAL PROVINSI
new Chart(document.getElementById('chartProvinsi'), {
    type: 'bar',
    data: {
        labels: Object.keys(provinsiData),
        datasets: [{ label: 'Jumlah Alumni', data: Object.values(provinsiData), backgroundColor: '#8B5CF6', borderRadius: 4 }]
    },
    options: {
        indexAxis: 'y', responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { beginAtZero: true, ticks: { stepSize: 1, color: '#6b7280' }, grid: { color: 'rgba(255,255,255,0.05)' } },
            y: { ticks: { color: '#6b7280' }, grid: { display: false } }
        }
    }
});

// 6. BAR PENDAPATAN
new Chart(document.getElementById('chartPendapatan'), {
    type: 'bar',
    data: {
        labels: Object.keys(pendapatanData),
        datasets: [{ label: 'Rata-rata Pendapatan (Rp)', data: Object.values(pendapatanData), backgroundColor: '#10B981', borderRadius: 6 }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: 'rgba(255,255,255,0.05)' },
                ticks: { color: '#6b7280', callback: v => 'Rp ' + (v/1000000).toFixed(1) + 'jt' }
            },
            x: { ticks: { color: '#6b7280' }, grid: { display: false } }
        }
    }
});

// 7. AI ANALYSIS
async function generateAIAnalysis() {
    const btn = document.getElementById('btnAnalisis');
    const result = document.getElementById('aiResult');
    const loading = document.getElementById('aiLoading');
    const content = document.getElementById('aiContent');

    btn.disabled = true;
    btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
    </svg> Menganalisis...`;

    result.classList.remove('hidden');
    loading.classList.remove('hidden');
    content.classList.add('hidden');

    try {
        const response = await fetch("{{ route('admin.ai.analysis') }}", {
            method: "POST",
            headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" }
        });
        const data = await response.json();
        loading.classList.add('hidden');
        content.classList.remove('hidden');
        const formatted = data.result
            .replace(/\*\*(.*?)\*\*/g, '<strong class="text-white">$1</strong>')
            .replace(/\n/g, '<br>');
        content.innerHTML = formatted;
    } catch (err) {
        loading.classList.add('hidden');
        content.classList.remove('hidden');
        content.textContent = 'Gagal mengambil analisis AI. Silakan coba lagi.';
    }

    btn.disabled = false;
    btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
    </svg> Generate Ulang`;
}
</script>
@endsection