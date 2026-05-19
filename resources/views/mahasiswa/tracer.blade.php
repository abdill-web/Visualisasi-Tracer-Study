@extends('layouts.app')

@section('title', 'Form Tracer Study')

@section('content')
<div class="min-h-screen bg-[#f5f7fb]">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 backdrop-blur-xl bg-white/80 border-b border-gray-200">

        <div class="px-6 lg:px-10 h-20 flex items-center justify-between">

            {{-- LEFT --}}
            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-2xl
                            bg-blue-50 border border-blue-100
                            flex items-center justify-center p-2">

                    <img src="{{ asset('images/logo-kampus.png') }}"
                         class="w-full h-full object-contain">
                </div>

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
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
                <div class="hidden md:flex items-center gap-3
                            bg-white border border-gray-200
                            rounded-2xl px-4 py-2 shadow-sm">

                    <div class="w-10 h-10 rounded-xl
                                bg-gradient-to-r from-blue-500 to-indigo-500
                                flex items-center justify-center">

                        <span class="text-white font-semibold">
                            {{ strtoupper(substr(Auth::guard('mahasiswa')->user()->nama, 0, 1)) }}
                        </span>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-800">
                            {{ Auth::guard('mahasiswa')->user()->nama }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Mahasiswa
                        </p>
                    </div>
                </div>

                {{-- BACK --}}
                <a href="{{ route('mahasiswa.dashboard') }}"
                   class="h-12 px-5 rounded-2xl
                          border border-gray-200
                          bg-white hover:bg-blue-50
                          hover:border-blue-200
                          text-gray-600 hover:text-blue-600
                          transition-all duration-300
                          flex items-center gap-2 shadow-sm text-sm font-medium">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>

                    Dashboard
                </a>
            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    <div class="px-6 lg:px-10 py-8 max-w-4xl mx-auto">

        {{-- HERO --}}
        <div class="relative overflow-hidden rounded-[32px]
                    bg-gradient-to-r
                    from-blue-600
                    via-indigo-600
                    to-blue-700
                    p-8 lg:p-10
                    mb-8 text-white shadow-2xl">

            {{-- GLOW --}}
            <div class="absolute top-[-80px] right-[-80px]
                        w-[240px] h-[240px]
                        rounded-full bg-white/10 blur-3xl">
            </div>

            <div class="relative z-10">

                <p class="text-xs font-semibold
                          text-blue-100 uppercase
                          tracking-[4px] mb-3">

                    FORM TRACER STUDY
                </p>

                <h1 class="text-3xl lg:text-[42px]
                           font-bold leading-tight mb-3">

                    Kuesioner Alumni
                </h1>

                <p class="text-blue-100 max-w-2xl leading-relaxed">
                    Mohon isi seluruh data dengan jujur dan lengkap
                    untuk mendukung evaluasi lulusan Universitas Mercu Buana.
                </p>
            </div>
        </div>

        {{-- SUCCESS --}}
        @if(session('success'))

        <div class="bg-emerald-50 border border-emerald-200
                    text-emerald-700 rounded-[28px]
                    px-6 py-5 mb-8 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-2xl
                            bg-emerald-100
                            flex items-center justify-center
                            flex-shrink-0">

                    <svg class="w-6 h-6 text-emerald-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 12l2 2 4-4"/>
                    </svg>
                </div>

                <div>
                    <h3 class="font-semibold text-lg">
                        Berhasil
                    </h3>

                    <p class="text-sm">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>

        @endif

        <form method="POST"
              action="{{ $tracer ? route('mahasiswa.tracer.update') : route('mahasiswa.tracer.store') }}"
              class="space-y-6">

            @csrf
            @if($tracer)
                @method('PUT')
            @endif

            {{-- IDENTITAS --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7
                        hover:shadow-md
                        transition-all duration-300">

                {{-- HEADER --}}
                <div class="flex items-center gap-4
                            mb-7 pb-5
                            border-b border-gray-100">

                    <div class="w-12 h-12 rounded-2xl
                                bg-blue-100
                                flex items-center justify-center
                                flex-shrink-0">

                        <svg class="w-6 h-6 text-blue-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0
                                     4 4 0 018 0zM12 14
                                     a7 7 0 00-7 7h14
                                     a7 7 0 00-7-7z"/>
                        </svg>
                    </div>

                    <div>
                        <h2 class="font-bold text-gray-800 text-xl">
                            Identitas Data Pribadi
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Informasi dasar alumni
                        </p>
                    </div>
                </div>

                @php
                    $inputClass = "w-full border border-gray-200 rounded-2xl px-4 py-3.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-400 transition-all duration-300 bg-white";
                @endphp

                <div class="space-y-5">

                    {{-- ROW --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        {{-- NAMA --}}
                        <div>

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-2">

                                Nama
                            </label>

                            <input type="text"
                                   value="{{ $mahasiswa->nama }}"
                                   disabled
                                   class="w-full border border-gray-100
                                          rounded-2xl px-4 py-3.5
                                          text-sm bg-gray-50
                                          text-gray-500 cursor-not-allowed">
                        </div>

                        {{-- NIM --}}
                        <div>

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-2">

                                NIM
                            </label>

                            <input type="text"
                                   value="{{ $mahasiswa->nim }}"
                                   disabled
                                   class="w-full border border-gray-100
                                          rounded-2xl px-4 py-3.5
                                          text-sm bg-gray-50
                                          text-gray-500 cursor-not-allowed">
                        </div>
                    </div>

                    {{-- ROW --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        {{-- PRODI --}}
                        <div>

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-2">

                                Program Studi
                            </label>

                            <input type="text"
                                   value="{{ $mahasiswa->program_studi }}"
                                   disabled
                                   class="w-full border border-gray-100
                                          rounded-2xl px-4 py-3.5
                                          text-sm bg-gray-50
                                          text-gray-500 cursor-not-allowed">
                        </div>

                        {{-- TAHUN --}}
                        <div>

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-2">

                                Tahun Lulus
                                <span class="text-red-500 normal-case">*</span>
                            </label>

                            <input type="text"
                                   name="tahun_lulus"
                                   placeholder="Contoh: 2024"
                                   class="{{ $inputClass }}"
                                   value="{{ old('tahun_lulus', $tracer->tahun_lulus ?? '') }}">
                        </div>
                    </div>

                    {{-- ROW --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        {{-- PHONE --}}
                        <div>

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-2">

                                No. Telepon / WhatsApp
                                <span class="text-red-500 normal-case">*</span>
                            </label>

                            <input type="text"
                                   name="no_telepon"
                                   placeholder="08123456789"
                                   class="{{ $inputClass }}"
                                   value="{{ old('no_telepon', $tracer->no_telepon ?? '') }}">
                        </div>

                        {{-- EMAIL --}}
                        <div>

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-2">

                                Email Aktif
                                <span class="text-red-500 normal-case">*</span>
                            </label>

                            <input type="email"
                                   name="email"
                                   placeholder="email@gmail.com"
                                   class="{{ $inputClass }}"
                                   value="{{ old('email', $tracer->email ?? '') }}">
                        </div>
                    </div>

                    {{-- NPWP --}}
                    <div>

                        <label class="block text-xs font-semibold
                                     text-gray-500 uppercase
                                     tracking-wide mb-2">

                            NPWP
                        </label>

                        <input type="text"
                               name="npwp"
                               placeholder="Isi angka saja. Jika tidak punya isi 0"
                               class="{{ $inputClass }}"
                               value="{{ old('npwp', $tracer->npwp ?? '') }}">
                    </div>

                    {{-- ROW --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        {{-- IG --}}
                        <div>

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-2">

                                Instagram
                            </label>

                            <input type="text"
                                   name="instagram"
                                   placeholder="@username"
                                   class="{{ $inputClass }}"
                                   value="{{ old('instagram', $tracer->instagram ?? '') }}">
                        </div>

                        {{-- LINKEDIN --}}
                        <div>

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-2">

                                LinkedIn
                            </label>

                            <input type="text"
                                   name="linkedin"
                                   placeholder="linkedin.com/in/username"
                                   class="{{ $inputClass }}"
                                   value="{{ old('linkedin', $tracer->linkedin ?? '') }}">
                        </div>
                    </div>

                    {{-- SERTIFIKASI --}}
                    <div>

                        <label class="block text-xs font-semibold
                                     text-gray-500 uppercase
                                     tracking-wide mb-2">

                            Sertifikasi Profesi
                        </label>

                        <input type="text"
                               name="sertifikasi"
                               placeholder="Contoh: AWS, Google Analytics"
                               class="{{ $inputClass }}"
                               value="{{ old('sertifikasi', $tracer->sertifikasi ?? '') }}">
                    </div>
                </div>
            </div>

            {{-- SUMBER DANA --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7
                        hover:shadow-md
                        transition-all duration-300">

                {{-- HEADER --}}
                <div class="flex items-center gap-4
                            mb-7 pb-5
                            border-b border-gray-100">

                    <div class="w-12 h-12 rounded-2xl
                                bg-indigo-100
                                flex items-center justify-center
                                flex-shrink-0">

                        <svg class="w-6 h-6 text-indigo-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 10h18M7 15h1m4 0h1m-7 4h12
                                     a3 3 0 003-3V8a3 3 0 00-3-3H6
                                     a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>

                    <div>
                        <h2 class="font-bold text-gray-800 text-xl">
                            Sumber Dana Kuliah
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Informasi pembiayaan selama masa perkuliahan
                        </p>
                    </div>
                </div>

                {{-- CONTENT --}}
                <div>

                    <label class="block text-xs font-semibold
                                 text-gray-500 uppercase
                                 tracking-wide mb-2">

                        Sumber Dana Pembiayaan Kuliah
                        <span class="text-red-500 normal-case">*</span>
                    </label>

                    <select name="sumber_dana"
                            class="{{ $inputClass }}">

                        <option value="">
                            -- Pilih salah satu --
                        </option>

                        @foreach([
                            'Biaya sendiri / keluarga',
                            'Beasiswa pemerintah (Bidikmisi/KIP)',
                            'Beasiswa swasta',
                            'Beasiswa UMB',
                            'Pinjaman / kredit pendidikan',
                            'Lainnya'
                        ] as $opt)

                            <option value="{{ $opt }}"
                                {{ old('sumber_dana', $tracer->sumber_dana ?? '') == $opt ? 'selected' : '' }}>

                                {{ $opt }}
                            </option>

                        @endforeach
                    </select>
                </div>
            </div>

            {{-- ═════════════════════════════════════ --}}
            {{-- 3. TRANSISI KERJA --}}
            {{-- ═════════════════════════════════════ --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7
                        hover:shadow-md
                        transition-all duration-300">

                {{-- HEADER --}}
                <div class="flex items-center gap-4
                            mb-7 pb-5
                            border-b border-gray-100">

                    <div class="w-12 h-12 rounded-2xl
                                bg-indigo-100
                                flex items-center justify-center
                                flex-shrink-0">

                        <svg class="w-6 h-6 text-indigo-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M21 13.255A23.931 23.931 0 0112 15
                                     c-3.183 0-6.22-.62-9-1.745M16 6V4
                                     a2 2 0 00-2-2h-4a2 2 0 00-2 2v2
                                     m4 6h.01M5 20h14a2 2 0 002-2V8
                                     a2 2 0 00-2-2H5a2 2 0 00-2 2v10
                                     a2 2 0 002 2z"/>
                        </svg>
                    </div>

                    <div>
                        <h2 class="font-bold text-gray-800 text-xl">
                            Masa Transisi ke Dunia Kerja
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Informasi proses pencarian pekerjaan alumni
                        </p>
                    </div>
                </div>

                <div class="space-y-5">

                    {{-- MULAI CARI --}}
                    <div>

                        <label class="block text-xs font-semibold
                                     text-gray-500 uppercase
                                     tracking-wide mb-2">

                            Kapan Mulai Mencari Pekerjaan?
                            <span class="text-red-500 normal-case">*</span>
                        </label>

                        <p class="text-xs text-gray-400 mb-3">
                            Mohon pekerjaan freelance tidak dimasukkan
                        </p>

                        <select name="mulai_cari_kerja"
                                class="{{ $inputClass }}">

                            <option value="">
                                -- Pilih salah satu --
                            </option>

                            @foreach([
                                'Sebelum lulus',
                                'Setelah lulus',
                                'Saya tidak mencari kerja'
                            ] as $opt)

                                <option value="{{ $opt }}"
                                    {{ old('mulai_cari_kerja', $tracer->mulai_cari_kerja ?? '') == $opt ? 'selected' : '' }}>

                                    {{ $opt }}
                                </option>

                            @endforeach
                        </select>
                    </div>

                    {{-- STATISTIK --}}
                    <div class="grid md:grid-cols-3 gap-5">

                        {{-- DILAMAR --}}
                        <div class="bg-gray-50 rounded-[24px]
                                    border border-gray-100
                                    p-5">

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-2">

                                Jumlah Dilamar
                            </label>

                            <p class="text-xs text-gray-400 mb-3">
                                Isi 0 jika wirausaha
                            </p>

                            <input type="number"
                                   name="jml_lamar"
                                   min="0"
                                   placeholder="0"
                                   class="{{ $inputClass }}"
                                   value="{{ old('jml_lamar', $tracer->jml_lamar ?? '') }}">
                        </div>

                        {{-- RESPON --}}
                        <div class="bg-gray-50 rounded-[24px]
                                    border border-gray-100
                                    p-5">

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-2">

                                Jumlah Respon
                            </label>

                            <p class="text-xs text-gray-400 mb-3">
                                Perusahaan yang merespon
                            </p>

                            <input type="number"
                                   name="jml_respon"
                                   min="0"
                                   placeholder="0"
                                   class="{{ $inputClass }}"
                                   value="{{ old('jml_respon', $tracer->jml_respon ?? '') }}">
                        </div>

                        {{-- WAWANCARA --}}
                        <div class="bg-gray-50 rounded-[24px]
                                    border border-gray-100
                                    p-5">

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-2">

                                Jumlah Wawancara
                            </label>

                            <p class="text-xs text-gray-400 mb-3">
                                Total interview
                            </p>

                            <input type="number"
                                   name="jml_wawancara"
                                   min="0"
                                   placeholder="0"
                                   class="{{ $inputClass }}"
                                   value="{{ old('jml_wawancara', $tracer->jml_wawancara ?? '') }}">
                        </div>
                    </div>

                    {{-- STATUS --}}
                    <div>

                        <label class="block text-xs font-semibold
                                     text-gray-500 uppercase
                                     tracking-wide mb-2">

                            Aktif Mencari Kerja dalam 4 Minggu Terakhir?
                        </label>

                        <select name="aktif_cari_kerja"
                                id="aktif_cari_kerja"
                                onchange="toggleAktifLainnya()"
                                class="{{ $inputClass }}">

                            <option value="">
                                -- Pilih salah satu --
                            </option>

                            @foreach([
                                'Tidak',
                                'Tidak, tapi sedang menunggu hasil lamaran',
                                'Ya, akan mulai bekerja dalam 2 minggu ke depan',
                                'Ya, tapi belum pasti dalam 2 minggu ke depan',
                                'Lainnya'
                            ] as $opt)

                                <option value="{{ $opt }}"
                                    {{ old('aktif_cari_kerja', $tracer->aktif_cari_kerja ?? '') == $opt ? 'selected' : '' }}>

                                    {{ $opt }}
                                </option>

                            @endforeach
                        </select>
                    </div>

                    {{-- LAINNYA --}}
                    <div id="aktif_lainnya_div"
                         class="{{ old('aktif_cari_kerja', $tracer->aktif_cari_kerja ?? '') == 'Lainnya' ? '' : 'hidden' }}">

                        <label class="block text-xs font-semibold
                                     text-gray-500 uppercase
                                     tracking-wide mb-2">

                            Jelaskan Jika Memilih Lainnya
                        </label>

                        <input type="text"
                               name="aktif_cari_kerja_lainnya"
                               placeholder="Tuliskan jawaban..."
                               class="{{ $inputClass }}"
                               value="{{ old('aktif_cari_kerja_lainnya', $tracer->aktif_cari_kerja_lainnya ?? '') }}">
                    </div>
                </div>
            </div>

            {{-- ═════════════════════════════════════ --}}
            {{-- 4. STATUS SAAT INI --}}
            {{-- ═════════════════════════════════════ --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7
                        hover:shadow-md
                        transition-all duration-300">

                {{-- HEADER --}}
                <div class="flex items-center gap-4
                            mb-7 pb-5
                            border-b border-gray-100">

                    <div class="w-12 h-12 rounded-2xl
                                bg-emerald-100
                                flex items-center justify-center
                                flex-shrink-0">

                        <svg class="w-6 h-6 text-emerald-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 12l2 2 4-4m6 2
                                     a9 9 0 11-18 0
                                     9 9 0 0118 0z"/>
                        </svg>
                    </div>

                    <div>
                        <h2 class="font-bold text-gray-800 text-xl">
                            Status Saat Ini
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Kondisi aktivitas alumni saat ini
                        </p>
                    </div>
                </div>

                <div>

                    <label class="block text-xs font-semibold
                                 text-gray-500 uppercase
                                 tracking-wide mb-2">

                        Jelaskan Status Anda Saat Ini
                        <span class="text-red-500 normal-case">*</span>
                    </label>

                    <select name="status_saat_ini"
        id="status_saat_ini"
        onchange="toggleStatusSection()"
        class="{{ $inputClass }}">

    <option value="">
        -- Pilih salah satu --
    </option>

    <option value="bekerja"
        {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'bekerja' ? 'selected' : '' }}>

        Bekerja (Full Time)
    </option>

    <option value="wirausaha"
        {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'wirausaha' ? 'selected' : '' }}>

        Wiraswasta / Wirausaha
    </option>

    <option value="studi_lanjut"
        {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'studi_lanjut' ? 'selected' : '' }}>

        Melanjutkan Pendidikan
    </option>

    <option value="tidak_bekerja"
        {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'tidak_bekerja' ? 'selected' : '' }}>

        Tidak Kerja (sedang mencari kerja)
    </option>

    <option value="belum_bekerja"
        {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'belum_bekerja' ? 'selected' : '' }}>

        Belum memungkinkan untuk bekerja
    </option>
</select>
                </div>
            </div>

             {{-- ═════════════════════════════════════ --}}
            {{-- 5A. BEKERJA --}}
            {{-- ═════════════════════════════════════ --}}
            <div id="section_bekerja" class="hidden">

                <div class="bg-white rounded-[32px]
                            border border-emerald-200
                            shadow-sm p-7 mb-6
                            hover:shadow-md
                            transition-all duration-300">

                    {{-- HEADER --}}
                    <div class="flex items-center gap-4
                                mb-7 pb-5
                                border-b border-emerald-100">

                        <div class="w-12 h-12 rounded-2xl
                                    bg-emerald-100
                                    flex items-center justify-center
                                    flex-shrink-0">

                            <svg class="w-6 h-6 text-emerald-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 21V5a2 2 0 00-2-2H7
                                         a2 2 0 00-2 2v16m14 0h2
                                         m-2 0h-5m-9 0H3m2 0h5
                                         M9 7h1m-1 4h1m4-4h1m-1 4h1
                                         m-5 10v-5a1 1 0 011-1h2
                                         a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>

                        <div>
                            <h2 class="font-bold text-emerald-700 text-xl">
                                Informasi Pekerjaan
                            </h2>

                            <p class="text-sm text-emerald-600 mt-1">
                                Data pekerjaan alumni saat ini
                            </p>
                        </div>
                    </div>

                    @php
                        $inputE = "w-full border border-gray-200 rounded-2xl px-4 py-3.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-400 transition-all duration-300 bg-white";
                    @endphp

                    <div class="space-y-5">

                        {{-- STATUS KERJA --}}
                        <div class="grid md:grid-cols-2 gap-5">

                            {{-- DAPAT KERJA --}}
                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Mendapat Kerja ≤ 6 Bulan?
                                </label>

                                <select name="dapat_kerja_6bulan"
                                        class="{{ $inputE }}">

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    <option value="Ya"
                                        {{ old('dapat_kerja_6bulan', $tracer->dapat_kerja_6bulan ?? '') == 'Ya' ? 'selected' : '' }}>

                                        Ya
                                    </option>

                                    <option value="Tidak"
                                        {{ old('dapat_kerja_6bulan', $tracer->dapat_kerja_6bulan ?? '') == 'Tidak' ? 'selected' : '' }}>

                                        Tidak
                                    </option>
                                </select>
                            </div>

                            {{-- BULAN --}}
                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Berapa Bulan Mendapat Kerja?
                                </label>

                                <input type="number"
                                       name="bulan_dapat_kerja"
                                       min="0"
                                       placeholder="Contoh: 3"
                                       class="{{ $inputE }}"
                                       value="{{ old('bulan_dapat_kerja', $tracer->bulan_dapat_kerja ?? '') }}">
                            </div>
                        </div>

                        {{-- POSISI --}}
                        <div class="grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Posisi / Jabatan
                                </label>

                                <input type="text"
                                       name="posisi_jabatan"
                                       placeholder="Contoh: Staff Marketing"
                                       class="{{ $inputE }}"
                                       value="{{ old('posisi_jabatan', $tracer->posisi_jabatan ?? '') }}">
                            </div>

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Job Title Detail
                                </label>

                                <input type="text"
                                       name="job_title"
                                       placeholder="Digital Marketing Specialist"
                                       class="{{ $inputE }}"
                                       value="{{ old('job_title', $tracer->job_title ?? '') }}">
                            </div>
                        </div>

                        {{-- PERUSAHAAN --}}
                        <div class="grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Nama Perusahaan
                                </label>

                                <input type="text"
                                       name="nama_perusahaan"
                                       placeholder="PT Jaya Jaya"
                                       class="{{ $inputE }}"
                                       value="{{ old('nama_perusahaan', $tracer->nama_perusahaan ?? '') }}">
                            </div>

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Jenis Perusahaan
                                </label>

                                <select name="jenis_perusahaan"
                                        class="{{ $inputE }}">

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    @foreach([
                                        'BUMN',
                                        'Swasta Nasional',
                                        'Swasta Asing/Multinasional',
                                        'Instansi Pemerintah',
                                        'TNI/Polri',
                                        'Organisasi Non-profit',
                                        'Lainnya'
                                    ] as $opt)

                                        <option value="{{ $opt }}"
                                            {{ old('jenis_perusahaan', $tracer->jenis_perusahaan ?? '') == $opt ? 'selected' : '' }}>

                                            {{ $opt }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- BIDANG --}}
                        <div class="grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Bidang / Sektor
                                </label>

                                <select name="bidang_perusahaan"
                                        class="{{ $inputE }}">

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    @foreach([
                                        'Teknologi Informasi',
                                        'Perbankan & Keuangan',
                                        'Pendidikan',
                                        'Kesehatan',
                                        'Manufaktur',
                                        'Perdagangan & Retail',
                                        'Media & Komunikasi',
                                        'Konsultan',
                                        'Pemerintahan',
                                        'Transportasi & Logistik',
                                        'Properti',
                                        'Lainnya'
                                    ] as $opt)

                                        <option value="{{ $opt }}"
                                            {{ old('bidang_perusahaan', $tracer->bidang_perusahaan ?? '') == $opt ? 'selected' : '' }}>

                                            {{ $opt }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Tingkat Perusahaan
                                </label>

                                <select name="tingkat_perusahaan"
                                        class="{{ $inputE }}">

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    @foreach([
                                        'Lokal / Wiraswasta tidak berbadan hukum',
                                        'Nasional / Wiraswasta berbadan hukum',
                                        'Multinasional / Internasional'
                                    ] as $opt)

                                        <option value="{{ $opt }}"
                                            {{ old('tingkat_perusahaan', $tracer->tingkat_perusahaan ?? '') == $opt ? 'selected' : '' }}>

                                            {{ $opt }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- LOKASI --}}
                        <div class="grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Provinsi Tempat Kerja
                                </label>

                                <select name="provinsi_kerja"
                                        class="{{ $inputE }}">

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    @foreach([
                                        'DKI Jakarta',
                                        'Jawa Barat',
                                        'Jawa Tengah',
                                        'Jawa Timur',
                                        'Banten',
                                        'DI Yogyakarta',
                                        'Bali',
                                        'Sumatera Utara',
                                        'Sumatera Selatan',
                                        'Kalimantan Timur',
                                        'Sulawesi Selatan',
                                        'Lainnya'
                                    ] as $prov)

                                        <option value="{{ $prov }}"
                                            {{ old('provinsi_kerja', $tracer->provinsi_kerja ?? '') == $prov ? 'selected' : '' }}>

                                            {{ $prov }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Kota Tempat Kerja
                                </label>

                                <input type="text"
                                       name="kota_kerja"
                                       placeholder="Jakarta Selatan"
                                       class="{{ $inputE }}"
                                       value="{{ old('kota_kerja', $tracer->kota_kerja ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ═════════════════════════════════════ --}}
            {{-- 5B. WIRAUSAHA --}}
            {{-- ═════════════════════════════════════ --}}
            <div id="section_wirausaha" class="hidden">

                <div class="bg-white rounded-[32px]
                            border border-amber-200
                            shadow-sm p-7 mb-6
                            hover:shadow-md
                            transition-all duration-300">

                    {{-- HEADER --}}
                    <div class="flex items-center gap-4
                                mb-7 pb-5
                                border-b border-amber-100">

                        <div class="w-12 h-12 rounded-2xl
                                    bg-amber-100
                                    flex items-center justify-center
                                    flex-shrink-0">

                            <svg class="w-6 h-6 text-amber-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>

                        <div>
                            <h2 class="font-bold text-amber-700 text-xl">
                                Informasi Wirausaha
                            </h2>

                            <p class="text-sm text-amber-600 mt-1">
                                Data usaha dan bisnis alumni
                            </p>
                        </div>
                    </div>

                    @php
                        $inputW = "w-full border border-gray-200 rounded-2xl px-4 py-3.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-amber-400 transition-all duration-300 bg-white";
                    @endphp

                    <div class="space-y-5">

                        {{-- ROW --}}
                        <div class="grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Posisi di Usaha
                                </label>

                                <select name="posisi_wirausaha"
                                        class="{{ $inputW }}">

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    @foreach([
                                        'Founder',
                                        'Co-Founder',
                                        'Staff',
                                        'Freelance / Kerja Lepas (termasuk konten creator, influencer)'
                                    ] as $opt)

                                        <option value="{{ $opt }}"
                                            {{ old('posisi_wirausaha', $tracer->posisi_wirausaha ?? '') == $opt ? 'selected' : '' }}>

                                            {{ $opt }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Jenis Usaha
                                </label>

                                <select name="jenis_usaha"
                                        class="{{ $inputW }}">

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    @foreach([
                                        'Kuliner / F&B',
                                        'Fashion & Kecantikan',
                                        'Teknologi / Startup',
                                        'Jasa Konsultan',
                                        'Pendidikan',
                                        'Perdagangan',
                                        'Konten Digital',
                                        'Lainnya'
                                    ] as $opt)

                                        <option value="{{ $opt }}"
                                            {{ old('jenis_usaha', $tracer->jenis_usaha ?? '') == $opt ? 'selected' : '' }}>

                                            {{ $opt }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- ROW --}}
                        <div class="grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Bulan Setelah Lulus Mulai Wirausaha
                                </label>

                                <input type="number"
                                       name="bulan_mulai_wirausaha"
                                       min="0"
                                       placeholder="Contoh: 3"
                                       class="{{ $inputW }}"
                                       value="{{ old('bulan_mulai_wirausaha', $tracer->bulan_mulai_wirausaha ?? '') }}">
                            </div>

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Tingkat Usaha
                                </label>

                                <select name="tingkat_usaha"
                                        class="{{ $inputW }}">

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    @foreach([
                                        'Lokal / Wiraswasta tidak berbadan hukum',
                                        'Nasional / Wiraswasta berbadan hukum',
                                        'Multinasional / Internasional'
                                    ] as $opt)

                                        <option value="{{ $opt }}"
                                            {{ old('tingkat_usaha', $tracer->tingkat_usaha ?? '') == $opt ? 'selected' : '' }}>

                                            {{ $opt }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- ROW --}}
                        <div class="grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Sosial Media Usaha
                                </label>

                                <input type="text"
                                       name="sosmed_usaha"
                                       placeholder="@namaakun"
                                       class="{{ $inputW }}"
                                       value="{{ old('sosmed_usaha', $tracer->sosmed_usaha ?? '') }}">
                            </div>

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Jumlah Rekan Kerja
                                </label>

                                <select name="jumlah_rekan_kerja"
                                        class="{{ $inputW }}">

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    @foreach([
                                        '< 5',
                                        '≥ 5 s.d. < 10',
                                        '≥ 10 s.d. < 25',
                                        '≥ 25 s.d. < 50',
                                        '≥ 50'
                                    ] as $opt)

                                        <option value="{{ $opt }}"
                                            {{ old('jumlah_rekan_kerja', $tracer->jumlah_rekan_kerja ?? '') == $opt ? 'selected' : '' }}>

                                            {{ $opt }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- PENDAPATAN --}}
                        <div class="grid md:grid-cols-2 gap-5">

                            <div class="bg-amber-50 rounded-[24px]
                                        border border-amber-100
                                        p-5">

                                <label class="block text-xs font-semibold
                                             text-amber-700 uppercase
                                             tracking-wide mb-2">

                                    Omzet per Bulan (Rp)
                                </label>

                                <p class="text-xs text-amber-600 mb-3">
                                    Pendapatan kotor usaha
                                </p>

                                <input type="number"
                                       name="omzet"
                                       min="0"
                                       placeholder="10000000"
                                       class="{{ $inputW }}"
                                       value="{{ old('omzet', $tracer->omzet ?? '') }}">
                            </div>

                            <div class="bg-amber-50 rounded-[24px]
                                        border border-amber-100
                                        p-5">

                                <label class="block text-xs font-semibold
                                             text-amber-700 uppercase
                                             tracking-wide mb-2">

                                    Pendapatan Pribadi (Rp)
                                </label>

                                <p class="text-xs text-amber-600 mb-3">
                                    Take home pay
                                </p>

                                <input type="number"
                                       name="pendapatan_wirausaha"
                                       min="0"
                                       placeholder="5000000"
                                       class="{{ $inputW }}"
                                       value="{{ old('pendapatan_wirausaha', $tracer->pendapatan_wirausaha ?? '') }}">
                            </div>
                        </div>

                        {{-- MOTIVASI --}}
                        <div>

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-3">

                                Motivasi Berwirausaha
                            </label>

                            <div class="grid md:grid-cols-2 gap-3">

                                @foreach([
                                    'Ingin mandiri secara finansial',
                                    'Tidak ingin terikat jam kerja',
                                    'Meneruskan usaha keluarga',
                                    'Sulit mendapat pekerjaan',
                                    'Passion / hobi',
                                    'Ingin menciptakan lapangan kerja',
                                    'Lainnya'
                                ] as $mot)

                                    @php
                                        $checked = in_array(
                                            $mot,
                                            json_decode($tracer->motivasi_wirausaha ?? '[]', true) ?? []
                                        );
                                    @endphp

                                    <label class="flex items-center gap-3
                                                 text-sm text-gray-700
                                                 bg-gray-50 border border-gray-200
                                                 rounded-2xl px-4 py-3
                                                 cursor-pointer
                                                 hover:bg-amber-50
                                                 hover:border-amber-200
                                                 transition-all duration-300">

                                        <input type="checkbox"
                                               name="motivasi_wirausaha[]"
                                               value="{{ $mot }}"
                                               {{ $checked ? 'checked' : '' }}
                                               class="accent-amber-500 w-4 h-4">

                                        {{ $mot }}
                                    </label>

                                @endforeach
                            </div>
                        </div>

                        {{-- LAINNYA --}}
                        <div>

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-2">

                                Motivasi Lainnya
                            </label>

                            <input type="text"
                                   name="motivasi_wirausaha_lainnya"
                                   placeholder="Isi jika memilih 'Lainnya'"
                                   class="{{ $inputW }}"
                                   value="{{ old('motivasi_wirausaha_lainnya', $tracer->motivasi_wirausaha_lainnya ?? '') }}">
                        </div>

                        {{-- PARTNER --}}
                        <div class="bg-gray-50 rounded-[28px]
                                    border border-gray-100
                                    p-6">

                            <div class="flex items-center gap-3 mb-5">

                                <div class="w-10 h-10 rounded-2xl
                                            bg-white border border-gray-200
                                            flex items-center justify-center">

                                    <svg class="w-5 h-5 text-gray-600"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M17 20h5V4H2v16h5"/>
                                    </svg>
                                </div>

                                <div>
                                    <h3 class="font-semibold text-gray-800">
                                        Data Partner Kerja
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        Untuk survey pengguna alumni
                                    </p>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-5 mb-5">

                                <div>

                                    <label class="block text-xs font-semibold
                                                 text-gray-500 uppercase
                                                 tracking-wide mb-2">

                                        Nama Partner
                                    </label>

                                    <input type="text"
                                           name="nama_partner"
                                           class="{{ $inputW }}"
                                           value="{{ old('nama_partner', $tracer->nama_partner ?? '') }}">
                                </div>

                                <div>

                                    <label class="block text-xs font-semibold
                                                 text-gray-500 uppercase
                                                 tracking-wide mb-2">

                                        Jabatan Partner
                                    </label>

                                    <input type="text"
                                           name="jabatan_partner"
                                           class="{{ $inputW }}"
                                           value="{{ old('jabatan_partner', $tracer->jabatan_partner ?? '') }}">
                                </div>
                            </div>

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Email Partner
                                </label>

                                <input type="email"
                                       name="email_partner"
                                       placeholder="partner@email.com"
                                       class="{{ $inputW }}"
                                       value="{{ old('email_partner', $tracer->email_partner ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             {{-- ═════════════════════════════════════ --}}
            {{-- 5C. STUDI LANJUT --}}
            {{-- ═════════════════════════════════════ --}}
            <div id="section_studi_lanjut" class="hidden">

                <div class="bg-white rounded-[32px]
                            border border-purple-200
                            shadow-sm p-7 mb-6
                            hover:shadow-md
                            transition-all duration-300">

                    {{-- HEADER --}}
                    <div class="flex items-center gap-4
                                mb-7 pb-5
                                border-b border-purple-100">

                        <div class="w-12 h-12 rounded-2xl
                                    bg-purple-100
                                    flex items-center justify-center
                                    flex-shrink-0">

                            <svg class="w-6 h-6 text-purple-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 6.253v13m0-13C10.832 5.477
                                         9.246 5 7.5 5S4.168 5.477
                                         3 6.253v13C4.168 18.477 5.754 18
                                         7.5 18s3.332.477 4.5 1.253m0-13
                                         C13.168 5.477 14.754 5 16.5 5
                                         c1.747 0 3.332.477 4.5 1.253v13
                                         C19.832 18.477 18.247 18 16.5 18
                                         c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>

                        <div>
                            <h2 class="font-bold text-purple-700 text-xl">
                                Informasi Studi Lanjut
                            </h2>

                            <p class="text-sm text-purple-600 mt-1">
                                Data pendidikan lanjutan alumni
                            </p>
                        </div>
                    </div>

                    @php
                        $inputS = "w-full border border-gray-200 rounded-2xl px-4 py-3.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-purple-500/10 focus:border-purple-400 transition-all duration-300 bg-white";
                    @endphp

                    <div class="space-y-5">

                        {{-- ROW --}}
                        <div class="grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Lokasi Studi Lanjut
                                </label>

                                <select name="lokasi_studi_lanjut"
                                        class="{{ $inputS }}">

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    <option value="Dalam Negeri"
                                        {{ old('lokasi_studi_lanjut', $tracer->lokasi_studi_lanjut ?? '') == 'Dalam Negeri' ? 'selected' : '' }}>

                                        Dalam Negeri
                                    </option>

                                    <option value="Luar Negeri"
                                        {{ old('lokasi_studi_lanjut', $tracer->lokasi_studi_lanjut ?? '') == 'Luar Negeri' ? 'selected' : '' }}>

                                        Luar Negeri
                                    </option>
                                </select>
                            </div>

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Alasan Melanjutkan Studi
                                </label>

                                <select name="alasan_studi_lanjut"
                                        class="{{ $inputS }}">

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    @foreach([
                                        'Ingin meningkatkan kompetensi',
                                        'Syarat karir / pekerjaan',
                                        'Beasiswa',
                                        'Keinginan sendiri',
                                        'Dorongan keluarga',
                                        'Lainnya'
                                    ] as $opt)

                                        <option value="{{ $opt }}"
                                            {{ old('alasan_studi_lanjut', $tracer->alasan_studi_lanjut ?? '') == $opt ? 'selected' : '' }}>

                                            {{ $opt }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- ROW --}}
                        <div class="grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Sumber Biaya Kuliah S2
                                </label>

                                <select name="biaya_studi_lanjut"
                                        class="{{ $inputS }}">

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    <option value="Biaya sendiri"
                                        {{ old('biaya_studi_lanjut', $tracer->biaya_studi_lanjut ?? '') == 'Biaya sendiri' ? 'selected' : '' }}>

                                        Biaya sendiri
                                    </option>

                                    <option value="Beasiswa"
                                        {{ old('biaya_studi_lanjut', $tracer->biaya_studi_lanjut ?? '') == 'Beasiswa' ? 'selected' : '' }}>

                                        Beasiswa
                                    </option>
                                </select>
                            </div>

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Nama Perguruan Tinggi
                                </label>

                                <input type="text"
                                       name="nama_kampus_lanjut"
                                       placeholder="Nama universitas"
                                       class="{{ $inputS }}"
                                       value="{{ old('nama_kampus_lanjut', $tracer->nama_kampus_lanjut ?? '') }}">
                            </div>
                        </div>

                        {{-- ROW --}}
                        <div class="grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Program Studi
                                </label>

                                <input type="text"
                                       name="prodi_lanjut"
                                       placeholder="Contoh: Magister Informatika"
                                       class="{{ $inputS }}"
                                       value="{{ old('prodi_lanjut', $tracer->prodi_lanjut ?? '') }}">
                            </div>

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Kota Kampus
                                </label>

                                <input type="text"
                                       name="kota_kampus_lanjut"
                                       placeholder="Jakarta"
                                       class="{{ $inputS }}"
                                       value="{{ old('kota_kampus_lanjut', $tracer->kota_kampus_lanjut ?? '') }}">
                            </div>
                        </div>

                        {{-- ROW --}}
                        <div class="grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Negara
                                </label>

                                <input type="text"
                                       name="negara_kampus_lanjut"
                                       placeholder="Indonesia"
                                       class="{{ $inputS }}"
                                       value="{{ old('negara_kampus_lanjut', $tracer->negara_kampus_lanjut ?? '') }}">
                            </div>

                            <div>

                                <label class="block text-xs font-semibold
                                             text-gray-500 uppercase
                                             tracking-wide mb-2">

                                    Tanggal Masuk
                                </label>

                                <input type="date"
                                       name="tanggal_masuk_lanjut"
                                       class="{{ $inputS }}"
                                       value="{{ old('tanggal_masuk_lanjut', $tracer->tanggal_masuk_lanjut ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ═════════════════════════════════════ --}}
            {{-- 5D. TIDAK BEKERJA --}}
            {{-- ═════════════════════════════════════ --}}
            <div id="section_tidak_bekerja" class="hidden">

                <div class="bg-white rounded-[32px]
                            border border-red-200
                            shadow-sm p-7 mb-6
                            hover:shadow-md
                            transition-all duration-300">

                    {{-- HEADER --}}
                    <div class="flex items-center gap-4
                                mb-7 pb-5
                                border-b border-red-100">

                        <div class="w-12 h-12 rounded-2xl
                                    bg-red-100
                                    flex items-center justify-center
                                    flex-shrink-0">

                            <svg class="w-6 h-6 text-red-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M10 14l2-2m0 0l2-2m-2 2
                                         l-2-2m2 2l2 2m7-2
                                         a9 9 0 11-18 0
                                         9 9 0 0118 0z"/>
                            </svg>
                        </div>

                        <div>
                            <h2 class="font-bold text-red-700 text-xl">
                                Alasan Tidak Bekerja
                            </h2>

                            <p class="text-sm text-red-600 mt-1">
                                Informasi kondisi alumni saat ini
                            </p>
                        </div>
                    </div>

                    @php
                        $inputT = "w-full border border-gray-200 rounded-2xl px-4 py-3.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-red-500/10 focus:border-red-400 transition-all duration-300 bg-white";
                    @endphp

                    <div class="space-y-5">

                        {{-- ALASAN --}}
                        <div>

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-2">

                                Alasan Tidak Bekerja
                            </label>

                            <select name="alasan_tidak_bekerja"
                                    id="alasan_tidak_bekerja"
                                    onchange="toggleAlasanLainnya()"
                                    class="{{ $inputT }}">

                                <option value="">
                                    -- Pilih salah satu --
                                </option>

                                @foreach([
                                    'Mengundurkan diri dari pekerjaan sebelumnya',
                                    'Habis masa kontrak',
                                    'Belum mendapat panggilan kerja',
                                    'Berencana melanjutkan studi',
                                    'Alasan keluarga',
                                    'Menikah',
                                    'Lainnya'
                                ] as $opt)

                                    <option value="{{ $opt }}"
                                        {{ old('alasan_tidak_bekerja', $tracer->alasan_tidak_bekerja ?? '') == $opt ? 'selected' : '' }}>

                                        {{ $opt }}
                                    </option>

                                @endforeach
                            </select>
                        </div>

                        {{-- LAINNYA --}}
                        <div id="alasan_lainnya_div"
                             class="{{ old('alasan_tidak_bekerja', $tracer->alasan_tidak_bekerja ?? '') == 'Lainnya' ? '' : 'hidden' }}">

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide mb-2">

                                Jelaskan Alasan Lainnya
                            </label>

                            <input type="text"
                                   name="alasan_tidak_bekerja_lainnya"
                                   placeholder="Tuliskan alasan..."
                                   class="{{ $inputT }}"
                                   value="{{ old('alasan_tidak_bekerja_lainnya', $tracer->alasan_tidak_bekerja_lainnya ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- ═════════════════════════════════════ --}}
            {{-- 6. KRITIK & SARAN --}}
            {{-- ═════════════════════════════════════ --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7
                        hover:shadow-md
                        transition-all duration-300">

                {{-- HEADER --}}
                <div class="flex items-center gap-4
                            mb-7 pb-5
                            border-b border-gray-100">

                    <div class="w-12 h-12 rounded-2xl
                                bg-blue-100
                                flex items-center justify-center
                                flex-shrink-0">

                        <svg class="w-6 h-6 text-blue-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M8 10h.01M12 10h.01M16 10h.01
                                     M9 16H5a2 2 0 01-2-2V6
                                     a2 2 0 012-2h14a2 2 0 012 2v8
                                     a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>

                    <div>
                        <h2 class="font-bold text-gray-800 text-xl">
                            Kritik & Saran
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Masukan untuk pengembangan tracer study dan kampus
                        </p>
                    </div>
                </div>

                @php
                    $textareaClass = "w-full border border-gray-200 rounded-[24px] px-5 py-4 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-400 transition-all duration-300 resize-none bg-white";
                @endphp

                <div class="space-y-5">

                    {{-- SARAN KUESIONER --}}
                    <div>

                        <label class="block text-xs font-semibold
                                     text-gray-500 uppercase
                                     tracking-wide mb-2">

                            Kritik dan Saran untuk Kuesioner Tracer Study UMB
                        </label>

                        <textarea name="saran_kuesioner"
                                  rows="4"
                                  placeholder="Tuliskan kritik dan saran Anda..."
                                  class="{{ $textareaClass }}">{{ old('saran_kuesioner', $tracer->saran_kuesioner ?? '') }}</textarea>
                    </div>

                    {{-- SARAN UMB --}}
                    <div>

                        <label class="block text-xs font-semibold
                                     text-gray-500 uppercase
                                     tracking-wide mb-2">

                            Kritik dan Saran untuk UMB
                        </label>

                        <textarea name="saran_umb"
                                  rows="4"
                                  placeholder="Tuliskan kritik dan saran Anda..."
                                  class="{{ $textareaClass }}">{{ old('saran_umb', $tracer->saran_umb ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- ═════════════════════════════════════ --}}
            {{-- 7. PERSETUJUAN --}}
            {{-- ═════════════════════════════════════ --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7 mb-6
                        hover:shadow-md
                        transition-all duration-300">

                {{-- HEADER --}}
                <div class="flex items-center gap-4
                            mb-7 pb-5
                            border-b border-gray-100">

                    <div class="w-12 h-12 rounded-2xl
                                bg-blue-100
                                flex items-center justify-center
                                flex-shrink-0">

                        <svg class="w-6 h-6 text-blue-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 12l2 2 4-4m5.618-4.016
                                     A11.955 11.955 0 0112 2.944
                                     a11.955 11.955 0 01-8.618 3.04
                                     A12.02 12.02 0 003 9
                                     c0 5.591 3.824 10.29 9 11.622
                                     5.176-1.332 9-6.03 9-11.622
                                     0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>

                    <div>
                        <h2 class="font-bold text-gray-800 text-xl">
                            Persetujuan
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Konfirmasi kebenaran data yang diisi
                        </p>
                    </div>
                </div>

                <label class="flex items-start gap-4
                             cursor-pointer
                             bg-blue-50 border border-blue-200
                             rounded-[28px] p-6
                             hover:bg-blue-100/40
                             transition-all duration-300">

                    <input type="checkbox"
                           name="persetujuan"
                           value="1"
                           class="mt-1 accent-blue-600 w-5 h-5 flex-shrink-0"
                           {{ old('persetujuan', $tracer->persetujuan ?? false) ? 'checked' : '' }}
                           required>

                    <div class="text-sm text-gray-600 leading-relaxed">

                        Saya telah mengisi jawaban kuesioner ini dengan
                        <span class="font-semibold text-gray-800">
                            benar dan sesuai
                        </span>.

                        Data yang diberikan akan digunakan untuk keperluan
                        Tracer Study UMB dan dijaga kerahasiaannya.
                    </div>
                </label>
            </div>

            {{-- SUBMIT --}}
            <button type="submit"
                    class="w-full py-5 rounded-[30px]
                           font-semibold text-white text-base
                           shadow-xl shadow-blue-500/25
                           transition-all duration-300
                           hover:scale-[1.01]
                           active:scale-[0.99]"
                    style="background: linear-gradient(135deg, #3b82f6, #6366f1);">

                <span class="flex items-center justify-center gap-3">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>

                    {{ $tracer ? 'Simpan Perubahan' : 'Kirim Form Tracer Study' }}
                </span>
            </button>
        </form>
    </div>
</div>

<script>
function toggleStatusSection() {

    const status = document.getElementById('status_saat_ini').value;

    // SEMBUNYIKAN SEMUA
    document.getElementById('section_bekerja')?.classList.add('hidden');
    document.getElementById('section_wirausaha')?.classList.add('hidden');
    document.getElementById('section_studi_lanjut')?.classList.add('hidden');
    document.getElementById('section_tidak_bekerja')?.classList.add('hidden');

    // TAMPILKAN SESUAI VALUE
    if (status === 'bekerja') {

        document.getElementById('section_bekerja')
            ?.classList.remove('hidden');

    } else if (status === 'wirausaha') {

        document.getElementById('section_wirausaha')
            ?.classList.remove('hidden');

    } else if (status === 'studi_lanjut') {

        document.getElementById('section_studi_lanjut')
            ?.classList.remove('hidden');

    } else if (
        status === 'tidak_bekerja' ||
        status === 'belum_bekerja'
    ) {

        document.getElementById('section_tidak_bekerja')
            ?.classList.remove('hidden');
    }
}

function toggleAktifLainnya() {

    const val = document.getElementById('aktif_cari_kerja').value;

    if (val === 'Lainnya') {
        document.getElementById('aktif_lainnya_div')
            ?.classList.remove('hidden');
    } else {
        document.getElementById('aktif_lainnya_div')
            ?.classList.add('hidden');
    }
}

function toggleAlasanLainnya() {

    const val = document.getElementById('alasan_tidak_bekerja').value;

    if (val === 'Lainnya') {
        document.getElementById('alasan_lainnya_div')
            ?.classList.remove('hidden');
    } else {
        document.getElementById('alasan_lainnya_div')
            ?.classList.add('hidden');
    }
}

// AUTO RUN SAAT PAGE LOAD
document.addEventListener('DOMContentLoaded', function () {

    toggleStatusSection();
    toggleAktifLainnya();
    toggleAlasanLainnya();

});
</script>
@endsection