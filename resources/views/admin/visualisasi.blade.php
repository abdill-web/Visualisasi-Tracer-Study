@extends('layouts.app')

@section('title', 'Visualisasi & AI - Tracer Study')

@section('content')
<div class="min-h-screen bg-gray-100">

    {{-- Navbar --}}
    <nav class="bg-gray-900 text-white px-6 py-4 flex items-center justify-between shadow-lg">
        <div class="flex items-center gap-3">
            <i class="fas fa-shield-halved text-xl"></i>
            <span class="font-bold text-lg">Tracer Study — Admin Panel</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-white text-sm">
                <i class="fas fa-house mr-1"></i> Dashboard
            </a>
            <span class="text-gray-300 text-sm">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    <i class="fas fa-right-from-bracket mr-1"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="p-8">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Visualisasi & AI Pola Karir</h1>
            <p class="text-gray-500 text-sm mt-1">Analisis data tracer study alumni berbasis AI</p>
        </div>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-500">
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Total Alumni</p>
                <p class="text-3xl font-bold text-gray-800">{{ $total }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-500">
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Data Terkumpul</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalIsi }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-yellow-500">
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Response Rate</p>
                <p class="text-3xl font-bold text-gray-800">{{ $total > 0 ? round(($totalIsi/$total)*100) : 0 }}%</p>
            </div>
            <div class="bg-white rounded-xl shadow p-5 border-l-4 border-purple-500">
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Sudah Bekerja</p>
                <p class="text-3xl font-bold text-gray-800">{{ $statusData['bekerja'] ?? 0 }}</p>
            </div>
        </div>

        {{-- Row 1: Status + Relevansi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-bold text-gray-800 mb-1">Distribusi Status Alumni</h3>
                <p class="text-xs text-gray-400 mb-4">Kondisi alumni saat ini berdasarkan data tracer study</p>
                <div class="relative h-64">
                    <canvas id="chartStatus"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-bold text-gray-800 mb-1">Relevansi Bidang Studi dengan Pekerjaan</h3>
                <p class="text-xs text-gray-400 mb-4">Persentase kesesuaian antara bidang studi dan pekerjaan alumni</p>
                <div class="relative h-64">
                    <canvas id="chartRelevansi"></canvas>
                </div>
            </div>
        </div>

        {{-- Row 2: Bar Bidang --}}
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h3 class="font-bold text-gray-800 mb-1">Distribusi Bidang Pekerjaan Alumni</h3>
            <p class="text-xs text-gray-400 mb-4">Sebaran alumni berdasarkan sektor/bidang perusahaan tempat bekerja</p>
            <div class="relative h-72">
                <canvas id="chartBidang"></canvas>
            </div>
        </div>

        {{-- Row 3: Tren + Provinsi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-bold text-gray-800 mb-1">Tren Karir Alumni per Tahun Lulus</h3>
                <p class="text-xs text-gray-400 mb-4">Perbandingan status alumni berdasarkan tahun kelulusan</p>
                <div class="relative h-64">
                    <canvas id="chartTren"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-bold text-gray-800 mb-1">Top Provinsi Tempat Bekerja</h3>
                <p class="text-xs text-gray-400 mb-4">Daerah dengan jumlah alumni bekerja terbanyak</p>
                <div class="relative h-64">
                    <canvas id="chartProvinsi"></canvas>
                </div>
            </div>
        </div>

        {{-- Row 4: Pendapatan --}}
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h3 class="font-bold text-gray-800 mb-1">Rata-rata Pendapatan per Program Studi</h3>
            <p class="text-xs text-gray-400 mb-4">Perbandingan rata-rata pendapatan alumni berdasarkan program studi</p>
            <div class="relative h-72">
                <canvas id="chartPendapatan"></canvas>
            </div>
        </div>

        {{-- Row 5: AI Analysis --}}
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-robot text-purple-600"></i>
                        Analisis AI Pola Karir
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">Analisis otomatis berbasis AI dari data tracer study</p>
                </div>
                <button onclick="generateAIAnalysis()"
                        id="btnAnalisis"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium flex items-center gap-2 transition">
                    <i class="fas fa-wand-magic-sparkles"></i> Generate Analisis
                </button>
            </div>

            <div id="aiResult" class="hidden">
                <div class="bg-purple-50 border border-purple-200 rounded-xl p-5">
                    <div id="aiLoading" class="flex items-center gap-3 text-purple-600">
                        <i class="fas fa-spinner fa-spin"></i>
                        <span class="text-sm">AI sedang menganalisis data...</span>
                    </div>
                    <div id="aiContent" class="hidden text-sm text-gray-700 leading-relaxed"></div>
                </div>
            </div>
        </div>

        {{-- Row 6: Clustering & Prediksi --}}
{{-- Row 6: Clustering & Prediksi --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <a href="{{ route('admin.clustering.index') }}"
       class="bg-white rounded-xl shadow p-6 border-2 border-dashed border-purple-200 hover:border-purple-400 hover:shadow-md transition block">
        <div class="text-center py-8">
            <i class="fas fa-diagram-project text-4xl text-purple-400 mb-3 block"></i>
            <h3 class="font-semibold text-gray-700 mb-1">Clustering Pola Karir</h3>
            <p class="text-xs text-gray-400 mb-3">Analisis pengelompokan alumni berdasarkan model ML</p>
            <span class="inline-block bg-purple-100 text-purple-700 text-xs px-3 py-1 rounded-full font-medium">
                <i class="fas fa-arrow-right mr-1"></i> Lihat Hasil Clustering
            </span>
        </div>
    </a>
    <div class="bg-white rounded-xl shadow p-6 border-2 border-dashed border-gray-200">
        <div class="text-center py-8">
            <i class="fas fa-brain text-4xl text-gray-300 mb-3 block"></i>
            <h3 class="font-semibold text-gray-500 mb-1">Prediksi Keberhasilan Alumni</h3>
            <p class="text-xs text-gray-400">Hasil prediksi XGBoost, Random Forest & Regresi Logistik akan ditampilkan di sini</p>
            <span class="inline-block mt-3 bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full">Menunggu integrasi model</span>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
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
        datasets: [{ data: Object.values(statusData), backgroundColor: COLORS, borderWidth: 2 }]
    },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'right' } } }
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
        datasets: [{ data: Object.values(relevansiData), backgroundColor: COLORS, borderWidth: 2 }]
    },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'right' } } }
});

// 3. BAR BIDANG
new Chart(document.getElementById('chartBidang'), {
    type: 'bar',
    data: {
        labels: Object.keys(bidangData),
        datasets: [{
            label: 'Jumlah Alumni',
            data: Object.values(bidangData),
            backgroundColor: '#3B82F6',
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f0f0f0' } },
            x: { grid: { display: false } }
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
    backgroundColor: statusColors[status] + '20',
    tension: 0.4,
    fill: false,
    pointRadius: 5,
}));

new Chart(document.getElementById('chartTren'), {
    type: 'line',
    data: { labels: tahunSet, datasets: trenDatasets },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom' } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f0f0f0' } },
            x: { grid: { display: false } }
        }
    }
});

// 5. BAR HORIZONTAL PROVINSI
new Chart(document.getElementById('chartProvinsi'), {
    type: 'bar',
    data: {
        labels: Object.keys(provinsiData),
        datasets: [{
            label: 'Jumlah Alumni',
            data: Object.values(provinsiData),
            backgroundColor: '#8B5CF6',
            borderRadius: 4,
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f0f0f0' } },
            y: { grid: { display: false } }
        }
    }
});

// 6. BAR PENDAPATAN
new Chart(document.getElementById('chartPendapatan'), {
    type: 'bar',
    data: {
        labels: Object.keys(pendapatanData),
        datasets: [{
            label: 'Rata-rata Pendapatan (Rp)',
            data: Object.values(pendapatanData),
            backgroundColor: '#10B981',
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: '#f0f0f0' },
                ticks: { callback: v => 'Rp ' + (v/1000000).toFixed(1) + 'jt' }
            },
            x: { grid: { display: false } }
        }
    }
});

// 7. AI ANALYSIS
async function generateAIAnalysis() {
    const btn     = document.getElementById('btnAnalisis');
    const result  = document.getElementById('aiResult');
    const loading = document.getElementById('aiLoading');
    const content = document.getElementById('aiContent');

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menganalisis...';
    result.classList.remove('hidden');
    loading.classList.remove('hidden');
    content.classList.add('hidden');

    try {
        const response = await fetch("{{ route('admin.ai.analysis') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        });

        const data = await response.json();

        loading.classList.add('hidden');
        content.classList.remove('hidden');

        // Format markdown bold dan newline
        const formatted = data.result
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\n/g, '<br>');
        content.innerHTML = formatted;

    } catch (err) {
        loading.classList.add('hidden');
        content.classList.remove('hidden');
        content.textContent = 'Gagal mengambil analisis AI. Silakan coba lagi.';
    }

    btn.disabled = false;
    btn.innerHTML = '<i class="fas fa-wand-magic-sparkles"></i> Generate Ulang';
}
</script>
@endsection