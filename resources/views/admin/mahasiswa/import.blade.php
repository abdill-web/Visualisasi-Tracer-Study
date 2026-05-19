@extends('layouts.app')

@section('title', 'Import Mahasiswa')

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

                        IMPORT MAHASISWA
                    </p>

                    <h1 class="text-5xl lg:text-6xl
                               font-bold text-white
                               leading-tight mb-4">

                        Upload<br>
                        Data CSV
                    </h1>

                    <p class="text-emerald-100 text-lg">
                        Tambahkan data mahasiswa secara massal
                        menggunakan file CSV.
                    </p>
                </div>

                {{-- RIGHT --}}
                <div class="grid grid-cols-2 gap-4">

                    <div class="bg-white/10 backdrop-blur-md
                                border border-white/10
                                rounded-[28px]
                                px-6 py-5 min-w-[170px]">

                        <p class="text-emerald-100 text-sm mb-2">
                            Format File
                        </p>

                        <h3 class="text-4xl font-bold text-white">
                            CSV
                        </h3>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md
                                border border-white/10
                                rounded-[28px]
                                px-6 py-5 min-w-[170px]">

                        <p class="text-emerald-100 text-sm mb-2">
                            Status
                        </p>

                        <h3 class="text-4xl font-bold text-white">
                            Ready
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- ALERT --}}
        @if(session('success'))

            <div class="mb-6 bg-emerald-50
                        border border-emerald-200
                        text-emerald-700
                        rounded-[28px]
                        px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-2xl
                                bg-emerald-100
                                flex items-center justify-center">

                        <svg class="w-5 h-5 text-emerald-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>

                    <span class="font-medium">
                        {{ session('success') }}
                    </span>
                </div>
            </div>
        @endif

        @if($errors->any())

            <div class="mb-6 bg-red-50
                        border border-red-200
                        text-red-700
                        rounded-[28px]
                        px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-2xl
                                bg-red-100
                                flex items-center justify-center">

                        <svg class="w-5 h-5 text-red-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 8v4m0 4h.01M4.93 19h14.14
                                     c1.54 0 2.5-1.67 1.73-3L13.73 4
                                     c-.77-1.33-2.69-1.33-3.46 0L3.2
                                     16c-.77 1.33.19 3 1.73 3z"/>
                        </svg>
                    </div>

                    <span class="font-medium">
                        {{ $errors->first() }}
                    </span>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT --}}
            <div class="lg:col-span-2">

                <div class="bg-white rounded-[36px]
                            border border-gray-200
                            shadow-sm overflow-hidden">

                    {{-- HEADER --}}
                    <div class="px-8 py-6 border-b border-gray-100">

                        <p class="text-xs uppercase
                                  tracking-[0.3em]
                                  text-gray-500 mb-2">

                            FILE UPLOAD
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900">
                            Upload File CSV
                        </h2>
                    </div>

                    {{-- BODY --}}
                    <div class="p-8">

                        <form method="POST"
                              action="{{ route('admin.mahasiswa.import.post') }}"
                              enctype="multipart/form-data">

                            @csrf

                            {{-- DROPZONE --}}
                            <div class="mb-8">

                                <label class="block text-sm font-semibold
                                             text-gray-700 mb-4">

                                    Pilih File CSV
                                </label>

                                <label
                                    class="group flex flex-col items-center justify-center
                                           w-full min-h-[300px]
                                           border-2 border-dashed border-gray-300
                                           rounded-[32px]
                                           hover:border-emerald-400
                                           hover:bg-emerald-50/40
                                           transition-all duration-300
                                           cursor-pointer">

                                    <div class="flex flex-col items-center text-center px-6">

                                        <div class="w-24 h-24 rounded-[30px]
                                                    bg-emerald-100
                                                    flex items-center justify-center
                                                    mb-6
                                                    group-hover:scale-105
                                                    transition">

                                            <svg class="w-12 h-12 text-emerald-600"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0
                                                         1115.9 6L16 6a5 5 0 011 9.9M15
                                                         13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                        </div>

                                        <h3 class="text-2xl font-bold
                                                   text-gray-900 mb-3">

                                            Klik untuk Upload CSV
                                        </h3>

                                        <p class="text-gray-500 leading-relaxed max-w-md">
                                            Upload file CSV mahasiswa untuk menambahkan
                                            data alumni secara massal ke sistem tracer study.
                                        </p>

                                        <div class="mt-6 px-5 py-3 rounded-2xl
                                                    bg-gray-100 text-gray-600
                                                    text-sm font-medium">

                                            Format yang didukung: .csv
                                        </div>
                                    </div>

                                    <input type="file"
                                           id="csv_file"
                                           name="csv_file"
                                           accept=".csv"
                                           class="hidden"
                                           required>
                                </label>

                                {{-- FILE PREVIEW --}}
                                <div id="file-preview"
                                     class="hidden mt-6">

                                    <div class="flex items-center gap-4
                                                bg-emerald-50
                                                border border-emerald-200
                                                rounded-[28px]
                                                p-5">

                                        <div class="w-14 h-14 rounded-2xl
                                                    bg-emerald-100
                                                    flex items-center justify-center">

                                            <svg class="w-7 h-7 text-emerald-600"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M7 7V3a1 1 0 011-1h8l5 5v13
                                                         a2 2 0 01-2 2H8a2 2 0
                                                         01-2-2V7z"/>
                                            </svg>
                                        </div>

                                        <div class="flex-1">

                                            <p class="text-sm text-gray-500 mb-1">
                                                File dipilih
                                            </p>

                                            <p id="file-name"
                                               class="font-semibold text-gray-900">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- BUTTON --}}
                            <button type="submit"
                                    class="w-full py-5 rounded-[24px]
                                           text-white font-semibold text-lg
                                           shadow-lg shadow-emerald-500/20
                                           transition-all duration-300
                                           hover:scale-[1.01]
                                           active:scale-[0.99]"
                                    style="background: linear-gradient(135deg, #10b981, #14b8a6);">

                                Import Data Mahasiswa
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="space-y-6">

                {{-- FORMAT --}}
                <div class="bg-white rounded-[36px]
                            border border-gray-200
                            shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-100">

                        <h2 class="text-xl font-bold text-gray-900">
                            Format CSV
                        </h2>
                    </div>

                    <div class="p-6">

                        <p class="text-gray-500 text-sm leading-relaxed mb-5">
                            Pastikan file CSV memiliki urutan kolom berikut:
                        </p>

                        <div class="bg-gray-100
                                    rounded-[24px]
                                    p-5 overflow-x-auto">

                            <code class="text-emerald-700
                                         text-xs font-mono">

                                nim, nama, tanggal_lahir,
                                program_studi, fakultas,
                                tahun_masuk, tahun_lulus
                            </code>
                        </div>

                        <div class="mt-5 space-y-3">

                            <div class="flex items-start gap-3">

                                <div class="w-2 h-2 rounded-full
                                            bg-emerald-500 mt-2">
                                </div>

                                <p class="text-sm text-gray-600">
                                    Kolom fakultas, tahun_masuk,
                                    dan tahun_lulus bersifat opsional
                                </p>
                            </div>

                            <div class="flex items-start gap-3">

                                <div class="w-2 h-2 rounded-full
                                            bg-emerald-500 mt-2">
                                </div>

                                <p class="text-sm text-gray-600">
                                    Format tanggal_lahir:
                                    YYYY-MM-DD
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- EXAMPLE --}}
                <div class="bg-white rounded-[36px]
                            border border-gray-200
                            shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-100">

                        <h2 class="text-xl font-bold text-gray-900">
                            Contoh CSV
                        </h2>
                    </div>

                    <div class="p-6">

                        <div class="bg-gray-100
                                    rounded-[24px]
                                    p-5 overflow-x-auto">

<pre class="text-xs text-gray-700 font-mono leading-7">nim,nama,tanggal_lahir,program_studi,fakultas,tahun_masuk,tahun_lulus
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