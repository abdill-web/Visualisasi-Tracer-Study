@extends('layouts.app')

@section('title', 'Clustering Pola Karir')

@section('content')
<div class="min-h-screen bg-gray-100">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between shadow-sm sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center p-2">
                <img src="{{ asset('images/logo-kampus.png') }}" class="w-full h-full object-contain">
            </div>
            <div>
                <h1 class="text-lg font-bold text-gray-800">Tracer Study</h1>
                <p class="text-xs text-gray-500">Universitas Mercu Buana</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-2xl px-4 py-2 shadow-sm">
                <div class="w-8 h-8 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 flex items-center justify-center">
                    <span class="text-white font-semibold text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="h-10 px-4 rounded-2xl border border-gray-200 bg-white hover:bg-red-50 hover:border-red-200 text-gray-600 hover:text-red-500 transition-all flex items-center gap-2 shadow-sm text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="px-6 lg:px-10 py-8 max-w-7xl mx-auto">

        {{-- HERO --}}
        <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 p-8 mb-8 text-white shadow-2xl">
            <div class="absolute top-[-80px] right-[-80px] w-[240px] h-[240px] rounded-full bg-white/10 blur-3xl"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-emerald-100 uppercase tracking-[4px] mb-3">MACHINE LEARNING</p>
                    <h1 class="text-3xl lg:text-4xl font-bold leading-tight mb-3">Clustering Pola Karir</h1>
                    <p class="text-emerald-100 leading-relaxed">Hasil analisis KMeans K=4 dari {{ number_format($flaskTotal) }} data alumni UMB</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2 px-4 py-2 rounded-2xl {{ $flaskOnline ? 'bg-white/20' : 'bg-red-500/30' }}">
                        <span class="w-2 h-2 rounded-full {{ $flaskOnline ? 'bg-green-300 animate-pulse' : 'bg-red-300' }}"></span>
                        <span class="text-sm text-white font-medium">Flask API {{ $flaskOnline ? 'Online' : 'Offline' }}</span>
                    </div>
                    <a href="{{ route('admin.clustering.predict') }}"
                       class="flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-white text-emerald-700 font-semibold text-sm shadow-lg hover:scale-[1.03] transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Prediksi Pola Karir
                    </a>
                </div>
            </div>
        </div>

        @if(!$flaskOnline)
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-2xl px-5 py-4 mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm">Flask API tidak dapat dijangkau. Pastikan Python API sudah dijalankan di <code class="bg-red-100 px-1 rounded">localhost:5000</code></p>
        </div>
        @endif

        {{-- KLASTER CARDS --}}
        @php
        $klasterInfo = [
            'Karir Linear'       => ['icon' => '📈', 'color' => 'emerald', 'desc' => 'Karir sesuai bidang studi, jalur karir stabil dan terarah'],
            'Karir Lintas Jalur' => ['icon' => '🔀', 'color' => 'blue',    'desc' => 'Karir di luar bidang studi, adaptif dan fleksibel'],
            'Karir Elit'         => ['icon' => '⭐', 'color' => 'purple',  'desc' => 'Posisi/pendapatan tinggi, sangat kompetitif'],
            'Karir Tertunda'     => ['icon' => '⏳', 'color' => 'amber',   'desc' => 'Masih dalam proses pencarian, butuh dukungan'],
        ];
        $colorMap = [
            'emerald' => ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-200', 'text' => 'text-emerald-600', 'bar' => 'bg-emerald-500', 'badge' => 'bg-emerald-100 text-emerald-700'],
            'blue'    => ['bg' => 'bg-blue-50',    'border' => 'border-blue-200',    'text' => 'text-blue-600',    'bar' => 'bg-blue-500',    'badge' => 'bg-blue-100 text-blue-700'],
            'purple'  => ['bg' => 'bg-purple-50',  'border' => 'border-purple-200',  'text' => 'text-purple-600',  'bar' => 'bg-purple-500',  'badge' => 'bg-purple-100 text-purple-700'],
            'amber'   => ['bg' => 'bg-amber-50',   'border' => 'border-amber-200',   'text' => 'text-amber-600',   'bar' => 'bg-amber-500',   'badge' => 'bg-amber-100 text-amber-700'],
        ];
        @endphp

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            @foreach($klasterInfo as $nama => $info)
            @php
                $count = $distribusi[$nama] ?? 0;
                $pct = $flaskTotal > 0 ? round(($count / $flaskTotal) * 100) : 0;
                $c = $colorMap[$info['color']];
            @endphp
            <div class="bg-white rounded-[28px] border border-gray-200 shadow-sm p-6 hover:shadow-md transition">
                <div class="text-2xl mb-3">{{ $info['icon'] }}</div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $c['badge'] }}">{{ $nama }}</span>
                <p class="text-4xl font-bold text-gray-800 mt-3 mb-1">{{ number_format($count) }}</p>
                <p class="text-gray-500 text-xs mb-3">{{ $pct }}% dari total alumni</p>
                <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="{{ $c['bar'] }} h-full rounded-full" style="width: {{ $pct }}%"></div>
                </div>
                <p class="text-gray-400 text-xs mt-3 leading-relaxed">{{ $info['desc'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- CHARTS ROW 1 --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
            <div class="bg-white rounded-[28px] border border-gray-200 shadow-sm p-6 hover:shadow-md transition">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Distribusi</p>
                <h3 class="font-bold text-gray-800 text-lg mb-1">Pola Karir Alumni</h3>
                <p class="text-xs text-gray-400 mb-5">Persentase setiap klaster dari total {{ number_format($flaskTotal) }} alumni</p>
                <div class="relative h-64">
                    <canvas id="chartDonut"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-[28px] border border-gray-200 shadow-sm p-6 hover:shadow-md transition">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Profil</p>
                <h3 class="font-bold text-gray-800 text-lg mb-1">Skor per Klaster</h3>
                <p class="text-xs text-gray-400 mb-5">Rata-rata skor inisiatif, metode belajar, dan kompetensi</p>
                <div class="relative h-64">
                    <canvas id="chartRadar"></canvas>
                </div>
            </div>
        </div>

        {{-- TOP PRODI --}}
        <div class="bg-white rounded-[28px] border border-gray-200 shadow-sm p-6 mb-4 hover:shadow-md transition">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Top 10</p>
            <h3 class="font-bold text-gray-800 text-lg mb-1">Program Studi — Distribusi Klaster</h3>
            <p class="text-xs text-gray-400 mb-5">Sebaran pola karir alumni berdasarkan program studi terbanyak</p>
            <div class="relative h-80">
                <canvas id="chartProdi"></canvas>
            </div>
        </div>

        {{-- TABEL PRODI --}}
        <div class="bg-white rounded-[28px] border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Detail</p>
                    <h2 class="font-bold text-gray-800">Per Program Studi</h2>
                </div>
                <input type="text" id="searchProdi" placeholder="Cari program studi..."
                       class="border border-gray-200 rounded-2xl px-4 py-2 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition w-64"/>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr class="border-b border-gray-100">
                        <th class="text-left px-6 py-3.5 text-gray-500 font-semibold text-xs uppercase tracking-wide">Program Studi</th>
                        <th class="text-center px-4 py-3.5 text-emerald-600 font-semibold text-xs">📈 Linear</th>
                        <th class="text-center px-4 py-3.5 text-blue-600 font-semibold text-xs">🔀 Lintas Jalur</th>
                        <th class="text-center px-4 py-3.5 text-purple-600 font-semibold text-xs">⭐ Elit</th>
                        <th class="text-center px-4 py-3.5 text-amber-600 font-semibold text-xs">⏳ Tertunda</th>
                        <th class="text-center px-4 py-3.5 text-gray-500 font-semibold text-xs">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($perProdiFlask as $prodi => $klasters)
                    @php
                        $linear = $klasters['Karir Linear'] ?? 0;
                        $lintas = $klasters['Karir Lintas Jalur'] ?? 0;
                        $elit   = $klasters['Karir Elit'] ?? 0;
                        $tunda  = $klasters['Karir Tertunda'] ?? 0;
                        $tot    = $linear + $lintas + $elit + $tunda;
                    @endphp
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition prodi-row">
                        <td class="px-6 py-3.5 font-medium text-gray-800">{{ $prodi }}</td>
                        <td class="px-4 py-3.5 text-center">
                            @if($linear > 0)
                            <span class="bg-emerald-100 text-emerald-700 text-xs px-2.5 py-1 rounded-full font-medium">{{ $linear }}</span>
                            @else <span class="text-gray-300">-</span> @endif
                        </td>
                        <td class="px-4 py-3.5 text-center">
                            @if($lintas > 0)
                            <span class="bg-blue-100 text-blue-700 text-xs px-2.5 py-1 rounded-full font-medium">{{ $lintas }}</span>
                            @else <span class="text-gray-300">-</span> @endif
                        </td>
                        <td class="px-4 py-3.5 text-center">
                            @if($elit > 0)
                            <span class="bg-purple-100 text-purple-700 text-xs px-2.5 py-1 rounded-full font-medium">{{ $elit }}</span>
                            @else <span class="text-gray-300">-</span> @endif
                        </td>
                        <td class="px-4 py-3.5 text-center">
                            @if($tunda > 0)
                            <span class="bg-amber-100 text-amber-700 text-xs px-2.5 py-1 rounded-full font-medium">{{ $tunda }}</span>
                            @else <span class="text-gray-300">-</span> @endif
                        </td>
                        <td class="px-4 py-3.5 text-center text-gray-500 text-xs font-semibold">{{ $tot }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const distribusi = @json($distribusi);
const skorPerKlaster = @json($skorPerKlaster);
const perProdi = @json($perProdiFlask);

const COLORS = {
    'Karir Linear':       '#10b981',
    'Karir Lintas Jalur': '#3b82f6',
    'Karir Elit':         '#8b5cf6',
    'Karir Tertunda':     '#f59e0b',
};

// 1. DONUT
new Chart(document.getElementById('chartDonut'), {
    type: 'doughnut',
    data: {
        labels: Object.keys(distribusi),
        datasets: [{
            data: Object.values(distribusi),
            backgroundColor: Object.keys(distribusi).map(k => COLORS[k] ?? '#6b7280'),
            borderWidth: 2,
            borderColor: '#ffffff',
            hoverOffset: 8,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { position: 'right', labels: { color: '#374151', padding: 16, font: { size: 11 } } } }
    }
});

// 2. RADAR
const klasters = Object.keys(skorPerKlaster['Skor_Inisiatif_Mencari_Kerja'] ?? {});
new Chart(document.getElementById('chartRadar'), {
    type: 'radar',
    data: {
        labels: ['Inisiatif Mencari Kerja', 'Metode Belajar', 'Kompetensi'],
        datasets: klasters.map(k => ({
            label: k,
            data: [
                skorPerKlaster['Skor_Inisiatif_Mencari_Kerja']?.[k] ?? 0,
                skorPerKlaster['Skor_Rata2_MetodeBelajar']?.[k] ?? 0,
                skorPerKlaster['Skor_Rata2_Kompetensi']?.[k] ?? 0,
            ],
            borderColor: COLORS[k] ?? '#6b7280',
            backgroundColor: (COLORS[k] ?? '#6b7280') + '20',
            pointBackgroundColor: COLORS[k] ?? '#6b7280',
            borderWidth: 2,
        }))
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { color: '#374151', padding: 12, font: { size: 11 } } } },
        scales: { r: { grid: { color: '#e5e7eb' }, ticks: { color: '#6b7280', backdropColor: 'transparent' }, pointLabels: { color: '#374151', font: { size: 11 } } } }
    }
});

// 3. STACKED BAR TOP 10
const prodiEntries = Object.entries(perProdi)
    .map(([prodi, data]) => ({ prodi, total: Object.values(data).reduce((a,b) => a+b, 0), data }))
    .sort((a,b) => b.total - a.total)
    .slice(0, 10);

new Chart(document.getElementById('chartProdi'), {
    type: 'bar',
    data: {
        labels: prodiEntries.map(e => e.prodi),
        datasets: ['Karir Linear', 'Karir Lintas Jalur', 'Karir Elit', 'Karir Tertunda'].map(k => ({
            label: k,
            data: prodiEntries.map(e => e.data[k] ?? 0),
            backgroundColor: COLORS[k] ?? '#6b7280',
            borderRadius: 4,
        }))
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { color: '#374151', padding: 16, font: { size: 11 } } } },
        scales: {
            x: { stacked: true, ticks: { color: '#6b7280', maxRotation: 30 }, grid: { display: false } },
            y: { stacked: true, ticks: { color: '#6b7280' }, grid: { color: '#f3f4f6' } }
        }
    }
});

// Search
document.getElementById('searchProdi').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('.prodi-row').forEach(row => {
        row.style.display = row.querySelector('td').textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
@endsection