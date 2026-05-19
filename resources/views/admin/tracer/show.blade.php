@extends('layouts.app')

@section('title', 'Detail Tracer Study')

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

                {{-- BACK --}}
                <a href="{{ route('admin.tracer.index') }}"
                   class="flex items-center gap-2
                          px-5 py-3 rounded-2xl
                          bg-white border border-gray-200
                          text-gray-600 hover:text-emerald-600
                          hover:border-emerald-200
                          transition-all duration-300
                          shadow-sm">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 19l-7-7 7-7"/>
                    </svg>

                    Kembali
                </a>

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

                        DETAIL RESPONDEN
                    </p>

                    <h1 class="text-5xl lg:text-6xl
                               font-bold text-white
                               leading-tight mb-4">

                        {{ $tracer->mahasiswa->nama }}
                    </h1>

                    <p class="text-emerald-100 text-lg">
                        Detail lengkap pengisian tracer study alumni.
                    </p>
                </div>

                {{-- RIGHT --}}
                <div class="grid grid-cols-2 gap-4">

                    <div class="bg-white/10 backdrop-blur-md
                                border border-white/10
                                rounded-[28px]
                                px-6 py-5 min-w-[170px]">

                        <p class="text-emerald-100 text-sm mb-2">
                            NIM
                        </p>

                        <h3 class="text-2xl font-bold text-white">
                            {{ $tracer->mahasiswa->nim }}
                        </h3>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md
                                border border-white/10
                                rounded-[28px]
                                px-6 py-5 min-w-[170px]">

                        <p class="text-emerald-100 text-sm mb-2">
                            Status
                        </p>

                        <h3 class="text-2xl font-bold text-white capitalize">
                            {{ str_replace('_', ' ', $tracer->status_saat_ini) }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- IDENTITAS --}}
        <div class="bg-white rounded-[36px]
                    border border-gray-200
                    shadow-sm p-8 mb-6">

            <div class="flex items-center gap-4 mb-8">

                <div class="w-14 h-14 rounded-2xl
                            bg-blue-100
                            flex items-center justify-center">

                    <svg class="w-7 h-7 text-blue-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5.121 17.804A13.937 13.937 0
                                 0112 16c2.5 0 4.847.655
                                 6.879 1.804M15 10a3 3 0
                                 11-6 0 3 3 0 016 0zm6 2a9
                                 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <div>

                    <p class="text-xs uppercase
                              tracking-[0.3em]
                              text-gray-500 mb-2">

                        IDENTITAS
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        Data Mahasiswa
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Nama
                    </p>
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->mahasiswa->nama }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        NIM
                    </p>
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->mahasiswa->nim }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Program Studi
                    </p>
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->mahasiswa->program_studi }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Tahun Lulus
                    </p>
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->tahun_lulus ?? '-' }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        No. Telepon
                    </p>
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->no_telepon ?? '-' }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Email
                    </p>
                    <h3 class="text-lg font-semibold text-gray-900 break-all">
                        {{ $tracer->email ?? '-' }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Instagram
                    </p>
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->instagram ?? '-' }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        LinkedIn
                    </p>
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->linkedin ?? '-' }}
                    </h3>
                </div>
            </div>
        </div>

        {{-- STATUS --}}
        <div class="bg-white rounded-[36px]
                    border border-gray-200
                    shadow-sm p-8 mb-6">

            <div class="flex items-center gap-4 mb-8">

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
                              d="M9 12l2 2 4-4m6 2a9
                                 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <div>

                    <p class="text-xs uppercase
                              tracking-[0.3em]
                              text-gray-500 mb-2">

                        STATUS
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        Status & Pekerjaan
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Status Saat Ini
                    </p>

                    <h3 class="text-lg font-semibold text-gray-900 capitalize">
                        {{ str_replace('_', ' ', $tracer->status_saat_ini) ?? '-' }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Sumber Dana Kuliah
                    </p>

                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->sumber_dana ?? '-' }}
                    </h3>
                </div>

                {{-- BEKERJA --}}
                @if($tracer->status_saat_ini == 'bekerja')

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Nama Perusahaan
                    </p>

                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->nama_perusahaan ?? '-' }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Posisi / Jabatan
                    </p>

                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->posisi_jabatan ?? '-' }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Bidang Perusahaan
                    </p>

                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->bidang_perusahaan ?? '-' }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Pendapatan / Bulan
                    </p>

                    <h3 class="text-lg font-semibold text-gray-900">
                        Rp {{ number_format($tracer->pendapatan ?? 0, 0, ',', '.') }}
                    </h3>
                </div>

                @endif

                {{-- WIRAUSAHA --}}
                @if($tracer->status_saat_ini == 'wirausaha')

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Jenis Usaha
                    </p>

                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->jenis_usaha ?? '-' }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Posisi Usaha
                    </p>

                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->posisi_wirausaha ?? '-' }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Omzet / Bulan
                    </p>

                    <h3 class="text-lg font-semibold text-gray-900">
                        Rp {{ number_format($tracer->omzet ?? 0, 0, ',', '.') }}
                    </h3>
                </div>

                @endif

                {{-- STUDI LANJUT --}}
                @if($tracer->status_saat_ini == 'studi_lanjut')

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Nama Kampus
                    </p>

                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->nama_kampus_lanjut ?? '-' }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-[28px] p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-2">
                        Program Studi Lanjut
                    </p>

                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $tracer->prodi_lanjut ?? '-' }}
                    </h3>
                </div>

                @endif
            </div>
        </div>

        {{-- SARAN --}}
        @if($tracer->saran_kuesioner || $tracer->saran_umb)

        <div class="bg-white rounded-[36px]
                    border border-gray-200
                    shadow-sm p-8">

            <div class="flex items-center gap-4 mb-8">

                <div class="w-14 h-14 rounded-2xl
                            bg-purple-100
                            flex items-center justify-center">

                    <svg class="w-7 h-7 text-purple-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M8 10h.01M12 10h.01M16 10h.01
                                 M9 16H5a2 2 0 01-2-2V6a2 2 0
                                 012-2h14a2 2 0 012 2v8a2 2 0
                                 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>

                <div>

                    <p class="text-xs uppercase
                              tracking-[0.3em]
                              text-gray-500 mb-2">

                        FEEDBACK
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        Kritik & Saran
                    </h2>
                </div>
            </div>

            <div class="space-y-5">

                @if($tracer->saran_kuesioner)

                <div class="bg-gray-50 rounded-[28px] p-6">

                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-3">
                        Saran untuk Kuesioner
                    </p>

                    <p class="text-gray-700 leading-relaxed">
                        {{ $tracer->saran_kuesioner }}
                    </p>
                </div>

                @endif

                @if($tracer->saran_umb)

                <div class="bg-gray-50 rounded-[28px] p-6">

                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-3">
                        Saran untuk Universitas Mercu Buana
                    </p>

                    <p class="text-gray-700 leading-relaxed">
                        {{ $tracer->saran_umb }}
                    </p>
                </div>

                @endif
            </div>
        </div>

        @endif
    </div>
</div>

@endsection