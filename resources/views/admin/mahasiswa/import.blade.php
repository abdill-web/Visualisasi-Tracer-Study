@extends('layouts.app')

@section('title', 'Import Mahasiswa')

@section('content')
<div class="min-h-screen bg-[#0f1117]">

    {{-- NAVBAR --}}
    <nav class="bg-[#0a0a0f]/80 backdrop-blur-xl border-b border-white/5 px-8 py-4 flex items-center justify-between sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="text-gray-500 text-sm hover:text-gray-300 transition">
                Dashboard
            </a>

            <span class="text-gray-700">/</span>

            <a href="{{ route('admin.mahasiswa.index') }}"
               class="text-gray-500 text-sm hover:text-gray-300 transition">
                Data Mahasiswa
            </a>

            <span class="text-gray-700">/</span>

            <span class="text-gray-300 text-sm">Import Mahasiswa</span>
        </div>

        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white/5 border border-white/10">
                <div class="w-6 h-6 rounded-full bg-emerald-500/30 flex items-center justify-center">
                    <span class="text-emerald-400 text-xs font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                </div>

                <span class="text-gray-300 text-sm">{{ Auth::user()->name }}</span>
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

    <div class="px-8 py-10 max-w-5xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-10">
            <p class="text-gray-600 text-xs uppercase tracking-widest mb-2">
                Mahasiswa
            </p>

            <h1 class="text-3xl font-bold text-white">
                Import Data Mahasiswa
            </h1>

            <p class="text-gray-500 text-sm mt-1">
                Upload file CSV untuk menambahkan data mahasiswa secara massal
            </p>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl px-5 py-4 text-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                    </svg>

                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl px-5 py-4 text-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M4.93 19h14.14c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.2 16c-.77 1.33.19 3 1.73 3z"/>
                    </svg>

                    {{ $errors->first() }}
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT SIDE --}}
            <div class="lg:col-span-2">

                {{-- FORM --}}
                <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl overflow-hidden">

                    <div class="px-6 py-4 border-b border-white/[0.06]">
                        <h2 class="text-white font-semibold text-sm">
                            Upload File CSV
                        </h2>
                    </div>

                    <div class="p-6">

                        <form method="POST"
                              action="{{ route('admin.mahasiswa.import.post') }}"
                              enctype="multipart/form-data">

                            @csrf

                            <div class="mb-6">

                                <label class="block text-sm font-medium text-gray-300 mb-3">
                                    Pilih File CSV
                                </label>

                                <label
                                    class="flex flex-col items-center justify-center w-full min-h-[220px]
                                           border-2 border-dashed border-white/10 rounded-2xl
                                           hover:border-emerald-500/30 hover:bg-white/[0.02]
                                           transition cursor-pointer">

                                    <div class="flex flex-col items-center justify-center px-6 py-10 text-center">

                                        <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center mb-4">
                                            <svg class="w-7 h-7 text-emerald-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                        </div>

                                        <p class="text-white font-medium mb-1">
                                            Klik untuk upload file CSV
                                        </p>

                                        <p class="text-gray-500 text-sm">
                                            Format file yang didukung: .csv
                                        </p>
                                    </div>

                                    <input
                                        type="file"
                                        id="csv_file"
                                        name="csv_file"
                                        accept=".csv"
                                        class="hidden"
                                        required>
                                </label>

                                {{-- FILE PREVIEW --}}
                                <div id="file-preview" class="hidden mt-4">
                                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20">

                                        <div class="w-10 h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-emerald-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M7 7V3a1 1 0 011-1h8l5 5v13a2 2 0 01-2 2H8a2 2 0 01-2-2V7z"/>
                                            </svg>
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-400 mb-1">
                                                File dipilih
                                            </p>

                                            <p id="file-name"
                                               class="text-sm text-white font-medium truncate">
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <button type="submit"
                                class="relative z-10 w-full inline-flex items-center justify-center gap-2
                                       px-5 py-3 rounded-xl
                                       bg-emerald-500 hover:bg-emerald-600
                                       text-white font-semibold transition">

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>

                                Import Data
                            </button>
                        </form>

                    </div>
                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="space-y-6">

                {{-- FORMAT --}}
                <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl overflow-hidden">

                    <div class="px-6 py-4 border-b border-white/[0.06]">
                        <h2 class="text-white font-semibold text-sm">
                            Format CSV
                        </h2>
                    </div>

                    <div class="p-6">

                        <p class="text-gray-400 text-sm mb-4">
                            Pastikan file CSV memiliki urutan kolom berikut:
                        </p>

                        <div class="bg-black/20 border border-white/5 rounded-xl p-4 overflow-x-auto">
                            <code class="text-emerald-400 text-xs font-mono">
                                nim, nama, tanggal_lahir, program_studi, fakultas, tahun_masuk, tahun_lulus
                            </code>
                        </div>

                        <div class="mt-4 space-y-2 text-xs text-gray-500">
                            <p>• Kolom fakultas, tahun_masuk, tahun_lulus bersifat opsional</p>
                            <p>• Format tanggal_lahir: YYYY-MM-DD</p>
                        </div>

                    </div>
                </div>

                {{-- CONTOH --}}
                <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl overflow-hidden">

                    <div class="px-6 py-4 border-b border-white/[0.06]">
                        <h2 class="text-white font-semibold text-sm">
                            Contoh Isi CSV
                        </h2>
                    </div>

                    <div class="p-6">

                        <div class="bg-black/20 border border-white/5 rounded-xl p-4 overflow-x-auto">
<pre class="text-xs text-gray-400 font-mono leading-6">nim,nama,tanggal_lahir,program_studi,fakultas,tahun_masuk,tahun_lulus
2021001,Budi Santoso,2000-05-14,Teknik Informatika,Fakultas Teknik,2021,2025
2021002,Siti Rahayu,1999-12-01,Sistem Informasi,Fakultas Teknik,2021,2025</pre>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    const fileInput = document.getElementById('csv_file');
    const filePreview = document.getElementById('file-preview');
    const fileName = document.getElementById('file-name');

    fileInput.addEventListener('change', function () {
        if (this.files.length > 0) {
            filePreview.classList.remove('hidden');
            fileName.textContent = this.files[0].name;
        } else {
            filePreview.classList.add('hidden');
            fileName.textContent = '';
        }
    });
</script>
@endsection