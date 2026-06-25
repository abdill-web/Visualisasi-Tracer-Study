@extends('layouts.app')

@section('title', 'Prediksi Keberhasilan Alumni')

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
                <div class="w-8 h-8 rounded-xl bg-gradient-to-r from-violet-500 to-purple-500 flex items-center justify-center">
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
        <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-violet-600 via-purple-600 to-violet-700 p-8 mb-8 text-white shadow-2xl">
            <div class="absolute top-[-80px] right-[-80px] w-[240px] h-[240px] rounded-full bg-white/10 blur-3xl"></div>
            <div class="relative z-10 flex items-center justify-between flex-wrap gap-4">
                <div>
                    <p class="text-xs font-semibold text-violet-100 uppercase tracking-[4px] mb-3">MACHINE LEARNING</p>
                    <h1 class="text-3xl lg:text-4xl font-bold leading-tight mb-3">Prediksi Keberhasilan Alumni</h1>
                    <p class="text-violet-100 leading-relaxed">Klasifikasi tingkat keberhasilan alumni menggunakan Random Forest & XGBoost</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2 px-4 py-2 rounded-2xl {{ $flaskOnline ? 'bg-white/20' : 'bg-red-500/30' }}">
                        <span class="w-2 h-2 rounded-full {{ $flaskOnline ? 'bg-green-300 animate-pulse' : 'bg-red-300' }}"></span>
                        <span class="text-sm text-white font-medium">Flask API {{ $flaskOnline ? 'Online' : 'Offline' }}</span>
                    </div>
                    <a href="{{ route('admin.clustering.index') }}"
                       class="flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-white/20 hover:bg-white/30 text-white font-semibold text-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Clustering
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

        {{-- INFO LABEL --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            @php
            $labelInfo = [
                ['label' => 'Kurang Berhasil', 'icon' => '📉', 'color' => 'red',    'desc' => 'Perlu peningkatan kompetensi dan strategi karir'],
                ['label' => 'Cukup Berhasil',  'icon' => '📊', 'color' => 'amber',  'desc' => 'Perkembangan cukup baik, masih ada ruang berkembang'],
                ['label' => 'Berhasil',         'icon' => '📈', 'color' => 'blue',   'desc' => 'Karir baik dengan kompetensi solid'],
                ['label' => 'Sangat Berhasil',  'icon' => '🏆', 'color' => 'emerald','desc' => 'Pencapaian karir sangat tinggi'],
            ];
            $colorMap = [
                'red'     => ['badge' => 'bg-red-100 text-red-700',       'bar' => 'bg-red-400'],
                'amber'   => ['badge' => 'bg-amber-100 text-amber-700',   'bar' => 'bg-amber-400'],
                'blue'    => ['badge' => 'bg-blue-100 text-blue-700',     'bar' => 'bg-blue-500'],
                'emerald' => ['badge' => 'bg-emerald-100 text-emerald-700','bar' => 'bg-emerald-500'],
            ];
            @endphp
            @foreach($labelInfo as $idx => $info)
            @php $c = $colorMap[$info['color']]; @endphp
            <div class="bg-white rounded-[28px] border border-gray-200 shadow-sm p-6 hover:shadow-md transition">
                <div class="text-2xl mb-3">{{ $info['icon'] }}</div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $c['badge'] }}">Kelas {{ $idx }}</span>
                <p class="text-base font-bold text-gray-800 mt-3 mb-1">{{ $info['label'] }}</p>
                <p class="text-gray-400 text-xs leading-relaxed">{{ $info['desc'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- FORM PREDIKSI --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- FORM (kiri) --}}
            <div class="lg:col-span-3 space-y-4">

                {{-- Pilih Model --}}
                <div class="bg-white rounded-[28px] border border-gray-200 shadow-sm p-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Konfigurasi</p>
                    <h3 class="font-bold text-gray-800 text-lg mb-4">Pilih Model & Program Studi</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Model Prediksi</label>
                            <select id="modelSelect" class="w-full border border-gray-200 rounded-2xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-400 transition">
                                <option value="rf">Random Forest</option>
                                <option value="xgboost">XGBoost</option>
                                <option value="ensemble">Ensemble (RF + XGBoost)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Program Studi</label>
                            <select id="prodiSelect" class="w-full border border-gray-200 rounded-2xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-400 transition">
                                <option value="">-- Pilih Program Studi --</option>
                                @foreach($prodiList as $prodi)
                                <option value="{{ $prodi }}">{{ $prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Lamaran & Wawancara --}}
                <div class="bg-white rounded-[28px] border border-gray-200 shadow-sm p-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Data Lamaran</p>
                    <h3 class="font-bold text-gray-800 text-lg mb-4">Aktivitas Pencarian Kerja</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Jumlah Lamaran <span class="text-violet-500">(C03)</span></label>
                            <input type="number" id="C03" min="0" max="50" value="0"
                                   class="w-full border border-gray-200 rounded-2xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-400 transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Yang Merespon <span class="text-violet-500">(C04)</span></label>
                            <input type="number" id="C04" min="0" max="50" value="0"
                                   class="w-full border border-gray-200 rounded-2xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-400 transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Undangan Wawancara <span class="text-violet-500">(C05)</span></label>
                            <input type="number" id="C05" min="0" max="50" value="0"
                                   class="w-full border border-gray-200 rounded-2xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-400 transition">
                        </div>
                    </div>
                </div>

                {{-- Cara Mencari Kerja C02 --}}
                <div class="bg-white rounded-[28px] border border-gray-200 shadow-sm p-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">C02</p>
                    <h3 class="font-bold text-gray-800 text-lg mb-4">Cara Mencari Pekerjaan</h3>
                    <p class="text-xs text-gray-400 mb-4">Centang semua cara yang pernah digunakan alumni</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @php
                        $c02Items = [
                            'C02_1'  => 'Iklan koran/majalah/brosur',
                            'C02_2'  => 'Melamar tanpa tahu lowongan',
                            'C02_3'  => 'Bursa/pameran kerja',
                            'C02_4'  => 'Internet/iklan online/milis',
                            'C02_5'  => 'Dihubungi perusahaan',
                            'C02_6'  => 'Menghubungi Kemenakertrans',
                            'C02_7'  => 'Agen tenaga kerja swasta',
                            'C02_8'  => 'Pusat pengembangan karir kampus',
                            'C02_9'  => 'Kantor kemahasiswaan/alumni',
                            'C02_10' => 'Membangun jejaring sejak kuliah',
                            'C02_11' => 'Relasi (dosen, keluarga, teman)',
                            'C02_12' => 'Membangun bisnis sendiri',
                            'C02_13' => 'Penempatan kerja/magang',
                            'C02_14' => 'Bekerja di tempat magang kuliah',
                        ];
                        @endphp
                        @foreach($c02Items as $id => $label)
                        <label class="flex items-center gap-2.5 cursor-pointer group">
                            <input type="checkbox" id="{{ $id }}" value="1"
                                   class="w-4 h-4 rounded text-violet-600 border-gray-300 focus:ring-violet-500">
                            <span class="text-sm text-gray-600 group-hover:text-gray-800 transition">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Metode Belajar B01 --}}
                <div class="bg-white rounded-[28px] border border-gray-200 shadow-sm p-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">B01</p>
                    <h3 class="font-bold text-gray-800 text-lg mb-4">Metode Pembelajaran</h3>
                    <p class="text-xs text-gray-400 mb-4">Skala 1 (Sangat Kecil) — 4 (Sangat Besar)</p>
                    <div class="space-y-3">
                        @php
                        $b01Items = [
                            'B01_1' => 'Perkuliahan',
                            'B01_2' => 'Demonstrasi (Peragaan)',
                            'B01_3' => 'Partisipasi proyek riset',
                            'B01_4' => 'Magang',
                            'B01_5' => 'Praktikum',
                            'B01_6' => 'Kerja Lapangan',
                            'B01_7' => 'Diskusi',
                        ];
                        @endphp
                        @foreach($b01Items as $id => $label)
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm text-gray-600 w-48 flex-shrink-0">{{ $label }}</span>
                            <div class="flex gap-2 flex-1 justify-end">
                                @for($i = 1; $i <= 4; $i++)
                                <label class="flex flex-col items-center gap-1 cursor-pointer">
                                    <input type="radio" name="{{ $id }}" value="{{ $i }}"
                                           {{ $i == 1 ? 'checked' : '' }}
                                           class="text-violet-600 focus:ring-violet-500">
                                    <span class="text-xs text-gray-400">{{ $i }}</span>
                                </label>
                                @endfor
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Kompetensi G01 --}}
                <div class="bg-white rounded-[28px] border border-gray-200 shadow-sm p-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">G01</p>
                    <h3 class="font-bold text-gray-800 text-lg mb-4">Kompetensi Saat Lulus</h3>
                    <p class="text-xs text-gray-400 mb-4">Skala 1 (Sangat Rendah) — 4 (Sangat Tinggi)</p>
                    <div class="space-y-3">
                        @php
                        $g01Items = [
                            'G01_1' => 'Etika',
                            'G01_2' => 'Keahlian bidang ilmu',
                            'G01_3' => 'Bahasa Inggris',
                            'G01_4' => 'Penggunaan Teknologi Informasi',
                            'G01_5' => 'Komunikasi',
                            'G01_6' => 'Kerja sama tim',
                            'G01_7' => 'Pengembangan Diri',
                        ];
                        @endphp
                        @foreach($g01Items as $id => $label)
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm text-gray-600 w-48 flex-shrink-0">{{ $label }}</span>
                            <div class="flex gap-2 flex-1 justify-end">
                                @for($i = 1; $i <= 4; $i++)
                                <label class="flex flex-col items-center gap-1 cursor-pointer">
                                    <input type="radio" name="{{ $id }}" value="{{ $i }}"
                                           {{ $i == 1 ? 'checked' : '' }}
                                           class="text-violet-600 focus:ring-violet-500">
                                    <span class="text-xs text-gray-400">{{ $i }}</span>
                                </label>
                                @endfor
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Tombol Prediksi --}}
                <button id="btnPredict"
                        class="w-full py-4 rounded-[28px] bg-gradient-to-r from-violet-600 to-purple-600 hover:from-violet-700 hover:to-purple-700 text-white font-bold text-base shadow-lg hover:shadow-xl hover:scale-[1.01] transition-all flex items-center justify-center gap-3 disabled:opacity-50 disabled:cursor-not-allowed"
                        {{ !$flaskOnline ? 'disabled' : '' }}>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span id="btnText">Prediksi Sekarang</span>
                </button>
            </div>

            {{-- HASIL (kanan) --}}
            <div class="lg:col-span-2 space-y-4">

                {{-- Placeholder --}}
                <div id="resultPlaceholder" class="bg-white rounded-[28px] border-2 border-dashed border-gray-200 p-10 flex flex-col items-center justify-center text-center min-h-[300px]">
                    <div class="w-16 h-16 rounded-[20px] bg-violet-50 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-violet-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-400">Hasil prediksi akan muncul di sini</p>
                    <p class="text-xs text-gray-300 mt-1">Isi form dan klik Prediksi Sekarang</p>
                </div>

                {{-- Hasil Prediksi (hidden awal) --}}
                <div id="resultCard" class="hidden">
                    <div class="bg-white rounded-[28px] border border-gray-200 shadow-sm p-6">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Hasil Prediksi</p>
                        <h3 class="font-bold text-gray-800 text-lg mb-4">Tingkat Keberhasilan</h3>

                        {{-- Badge hasil --}}
                        <div id="resultBadgeWrap" class="rounded-2xl p-5 mb-4 flex items-center gap-4">
                            <div id="resultIcon" class="text-4xl"></div>
                            <div>
                                <p id="resultLabel" class="text-xl font-bold text-gray-800"></p>
                                <p id="resultModel" class="text-xs text-gray-400 mt-0.5"></p>
                            </div>
                        </div>

                        <p id="resultDesc" class="text-sm text-gray-600 leading-relaxed mb-4"></p>

                        {{-- Probabilitas --}}
                        <div class="mb-4">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Probabilitas per Kelas</p>
                            <div id="probaContainer" class="space-y-2"></div>
                        </div>

                        {{-- Rekomendasi --}}
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Rekomendasi</p>
                            <ul id="rekomendasiList" class="space-y-2"></ul>
                        </div>
                    </div>

                    {{-- Ensemble detail --}}
                    <div id="ensembleCard" class="hidden bg-white rounded-[28px] border border-gray-200 shadow-sm p-6">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Detail Ensemble</p>
                        <div id="ensembleDetail" class="grid grid-cols-2 gap-3"></div>
                    </div>

                    {{-- Chart probabilitas --}}
                    <div class="bg-white rounded-[28px] border border-gray-200 shadow-sm p-6">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Distribusi Probabilitas</p>
                        <div class="relative h-48">
                            <canvas id="chartProba"></canvas>
                        </div>
                    </div>
                </div>

                {{-- Error --}}
                <div id="resultError" class="hidden bg-red-50 border border-red-200 rounded-[28px] p-6">
                    <p class="font-semibold text-red-600 mb-1">Prediksi Gagal</p>
                    <p id="errorMsg" class="text-sm text-red-500"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const PREDICT_URL = '{{ route("admin.prediksi.predict") }}';
const CSRF        = '{{ csrf_token() }}';

const LABEL_ICONS   = { 0: '📉', 1: '📊', 2: '📈', 3: '🏆' };
const LABEL_NAMES   = { 0: 'Kurang Berhasil', 1: 'Cukup Berhasil', 2: 'Berhasil', 3: 'Sangat Berhasil' };
const PROBA_COLORS  = ['#ef4444', '#f59e0b', '#3b82f6', '#10b981'];

let chartProba = null;

function getRadioVal(name) {
    const el = document.querySelector(`input[name="${name}"]:checked`);
    return el ? parseFloat(el.value) : 1;
}

function getCheckVal(id) {
    return document.getElementById(id)?.checked ? 1 : 0;
}

document.getElementById('btnPredict').addEventListener('click', async () => {
    const prodi = document.getElementById('prodiSelect').value;
    if (!prodi) { alert('Pilih Program Studi terlebih dahulu.'); return; }

    const payload = {
        model:          document.getElementById('modelSelect').value,
        program_studi:  prodi,
        C03: parseFloat(document.getElementById('C03').value) || 0,
        C04: parseFloat(document.getElementById('C04').value) || 0,
        C05: parseFloat(document.getElementById('C05').value) || 0,
        // B01
        B01_1: getRadioVal('B01_1'), B01_2: getRadioVal('B01_2'), B01_3: getRadioVal('B01_3'),
        B01_4: getRadioVal('B01_4'), B01_5: getRadioVal('B01_5'), B01_6: getRadioVal('B01_6'),
        B01_7: getRadioVal('B01_7'),
        // G01
        G01_1: getRadioVal('G01_1'), G01_2: getRadioVal('G01_2'), G01_3: getRadioVal('G01_3'),
        G01_4: getRadioVal('G01_4'), G01_5: getRadioVal('G01_5'), G01_6: getRadioVal('G01_6'),
        G01_7: getRadioVal('G01_7'),
        // C02
        C02_1:  getCheckVal('C02_1'),  C02_2:  getCheckVal('C02_2'),  C02_3:  getCheckVal('C02_3'),
        C02_4:  getCheckVal('C02_4'),  C02_5:  getCheckVal('C02_5'),  C02_6:  getCheckVal('C02_6'),
        C02_7:  getCheckVal('C02_7'),  C02_8:  getCheckVal('C02_8'),  C02_9:  getCheckVal('C02_9'),
        C02_10: getCheckVal('C02_10'), C02_11: getCheckVal('C02_11'), C02_12: getCheckVal('C02_12'),
        C02_13: getCheckVal('C02_13'), C02_14: getCheckVal('C02_14'),
    };

    // Loading state
    const btn     = document.getElementById('btnPredict');
    const btnText = document.getElementById('btnText');
    btn.disabled  = true;
    btnText.textContent = 'Memproses...';
    document.getElementById('resultPlaceholder').classList.add('hidden');
    document.getElementById('resultCard').classList.add('hidden');
    document.getElementById('resultError').classList.add('hidden');

    try {
        const res  = await fetch(PREDICT_URL, {
            method:  'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body:    JSON.stringify(payload),
        });
        const json = await res.json();

        if (!json.success) throw new Error(json.error || 'Terjadi kesalahan');

        renderResult(json.data);

    } catch (err) {
        document.getElementById('resultError').classList.remove('hidden');
        document.getElementById('errorMsg').textContent = err.message;
    } finally {
        btn.disabled         = false;
        btnText.textContent  = 'Prediksi Sekarang';
    }
});

function renderResult(data) {
    const kelas     = data.kelas;
    const warna     = data.warna;
    const probaMap  = data.probabilitas;

    // Badge
    const badgeWrap = document.getElementById('resultBadgeWrap');
    badgeWrap.style.backgroundColor = warna + '15';
    badgeWrap.style.borderLeft      = `4px solid ${warna}`;
    document.getElementById('resultIcon').textContent  = LABEL_ICONS[kelas] ?? '❓';
    document.getElementById('resultLabel').textContent = data.label;
    document.getElementById('resultModel').textContent = `Model: ${data.model_used.toUpperCase()}`;

    document.getElementById('resultDesc').textContent = data.deskripsi;

    // Probabilitas bar
    const probaContainer = document.getElementById('probaContainer');
    probaContainer.innerHTML = '';
    for (let i = 0; i <= 3; i++) {
        const pct = ((probaMap[i] ?? 0) * 100).toFixed(1);
        probaContainer.innerHTML += `
            <div>
                <div class="flex justify-between text-xs text-gray-500 mb-1">
                    <span>${LABEL_NAMES[i]}</span>
                    <span class="font-semibold">${pct}%</span>
                </div>
                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-700"
                         style="width:${pct}%; background-color:${PROBA_COLORS[i]}"></div>
                </div>
            </div>`;
    }

    // Rekomendasi
    const rekList = document.getElementById('rekomendasiList');
    rekList.innerHTML = '';
    (data.rekomendasi || []).forEach(r => {
        rekList.innerHTML += `
            <li class="flex items-start gap-2.5">
                <span class="w-5 h-5 rounded-full bg-violet-100 text-violet-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </span>
                <span class="text-sm text-gray-600">${r}</span>
            </li>`;
    });

    // Ensemble detail
    if (data.detail_ensemble) {
        const ensCard = document.getElementById('ensembleCard');
        ensCard.classList.remove('hidden');
        const detail = document.getElementById('ensembleDetail');
        detail.innerHTML = '';
        Object.entries(data.detail_ensemble).forEach(([model, info]) => {
            detail.innerHTML += `
                <div class="bg-gray-50 rounded-2xl p-4 text-center">
                    <p class="text-xs text-gray-400 uppercase font-semibold mb-1">${model.toUpperCase()}</p>
                    <p class="text-lg font-bold text-gray-800">${LABEL_ICONS[info.kelas]}</p>
                    <p class="text-sm font-semibold text-gray-700 mt-1">${info.label}</p>
                </div>`;
        });
    } else {
        document.getElementById('ensembleCard').classList.add('hidden');
    }

    // Chart
    if (chartProba) chartProba.destroy();
    chartProba = new Chart(document.getElementById('chartProba'), {
        type: 'bar',
        data: {
            labels: Object.keys(probaMap).map(k => LABEL_NAMES[k] ?? `Kelas ${k}`),
            datasets: [{
                data:            Object.values(probaMap).map(v => parseFloat((v * 100).toFixed(2))),
                backgroundColor: PROBA_COLORS,
                borderRadius:    8,
                borderSkipped:   false,
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { color: '#6b7280', font: { size: 10 } } },
                y: { grid: { color: '#f3f4f6' }, ticks: { color: '#6b7280', callback: v => v + '%' }, max: 100 }
            }
        }
    });

    document.getElementById('resultCard').classList.remove('hidden');
}
</script>
@endsection