@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="min-h-screen bg-[#f5f7fb]">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 backdrop-blur-xl bg-white/80 border-b border-gray-200">

        <div class="px-6 lg:px-10 h-20 flex items-center justify-between">

            {{-- LEFT --}}
            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100
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

                {{-- LOGOUT --}}
                <form method="POST" action="{{ route('mahasiswa.logout') }}">
                    @csrf

                    <button type="submit"
                            class="h-12 px-5 rounded-2xl
                                   border border-gray-200
                                   bg-white hover:bg-red-50
                                   hover:border-red-200
                                   text-gray-600 hover:text-red-500
                                   transition-all duration-300
                                   flex items-center gap-2 shadow-sm">

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

    {{-- CONTENT --}}
    <div class="px-6 lg:px-10 py-6 max-w-7xl mx-auto">

        {{-- HERO --}}
        <div class="relative overflow-hidden rounded-[32px]
                    bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700
                    p-7 lg:p-6 mb-6 text-white shadow-2xl">

            {{-- GLOW --}}
            <div class="absolute top-[-80px] right-[-80px]
                        w-[250px] h-[250px]
                        bg-white/10 rounded-full blur-3xl">
            </div>

            <div class="relative z-10">

                <div class="grid lg:grid-cols-3 gap-5 items-center">

                    {{-- LEFT --}}
                    <div class="lg:col-span-2">

                        <p class="uppercase tracking-[4px]
                                  text-blue-100 text-xs mb-3">

                            Dashboard Mahasiswa
                        </p>

                        <h1 class="text-3xl lg:text-[42px]
                                   font-bold leading-tight mb-4">

                            Selamat Datang,
                            <br>
                            {{ Auth::guard('mahasiswa')->user()->nama }}
                        </h1>

                        <p class="text-blue-100 max-w-2xl">
                            Kelola data tracer study alumni, isi form,
                            dan dapatkan rekomendasi karier berbasis AI.
                        </p>
                    </div>

                    {{-- RIGHT --}}
                    <div class="grid grid-cols-2 gap-4">

                        {{-- PRODI --}}
                        <div class="bg-white/10 backdrop-blur-xl
                                    border border-white/10
                                    rounded-2xl p-4 h-full">

                            <p class="text-sm text-blue-100 mb-2">
                                Program Studi
                            </p>

                            <h3 class="text-xl font-semibold leading-snug">
                                {{ Auth::guard('mahasiswa')->user()->program_studi }}
                            </h3>
                        </div>

                        {{-- NIM --}}
                        <div class="bg-white/10 backdrop-blur-xl
                                    border border-white/10
                                    rounded-2xl p-4 h-full">

                            <p class="text-sm text-blue-100 mb-2">
                                NIM
                            </p>

                            <h3 class="text-xl font-semibold break-words">
                                {{ Auth::guard('mahasiswa')->user()->nim }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STATUS --}}
        @php
            $tracer = Auth::guard('mahasiswa')->user()->tracerStudy;
        @endphp

        {{-- GRID --}}
        <div class="grid lg:grid-cols-3 gap-6 items-stretch">

            {{-- LEFT CONTENT --}}
            <div class="lg:col-span-2 flex flex-col gap-6">

                {{-- PROFILE CARD --}}
                <div class="bg-white rounded-[28px]
                            border border-gray-200
                            shadow-sm p-6 flex-1">

                    <div class="flex flex-col md:flex-row
                                md:items-center gap-6 h-full">

                        {{-- AVATAR --}}
                        <div class="w-24 h-24 rounded-[28px]
                                    bg-gradient-to-r from-blue-500 to-indigo-500
                                    flex items-center justify-center
                                    shadow-lg shadow-blue-500/20 flex-shrink-0">

                            <span class="text-white text-4xl font-bold">
                                {{ strtoupper(substr(Auth::guard('mahasiswa')->user()->nama, 0, 1)) }}
                            </span>
                        </div>

                        {{-- INFO --}}
                        <div class="flex-1">

                            <h2 class="text-3xl font-bold text-gray-800 mb-5">
                                {{ Auth::guard('mahasiswa')->user()->nama }}
                            </h2>

                            <div class="grid md:grid-cols-2 gap-4">

                                {{-- NIM --}}
                                <div class="bg-gray-50 rounded-2xl p-5">

                                    <p class="text-sm text-gray-500 mb-1">
                                        NIM
                                    </p>

                                    <h3 class="font-semibold text-gray-800 text-lg">
                                        {{ Auth::guard('mahasiswa')->user()->nim }}
                                    </h3>
                                </div>

                                {{-- PRODI --}}
                                <div class="bg-gray-50 rounded-2xl p-5">

                                    <p class="text-sm text-gray-500 mb-1">
                                        Program Studi
                                    </p>

                                    <h3 class="font-semibold text-gray-800 text-lg">
                                        {{ Auth::guard('mahasiswa')->user()->program_studi }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STATUS CARD --}}
                @if($tracer)

                    <div class="relative overflow-hidden
                                rounded-[28px]
                                bg-gradient-to-r
                                from-[#059669]
                                via-[#10b981]
                                to-[#34d399]
                                p-6 shadow-xl min-h-[210px]">

                        {{-- GLOW --}}
                        <div class="absolute right-[-80px] top-[-80px]
                                    w-[220px] h-[220px]
                                    rounded-full bg-white/10 blur-3xl">
                        </div>

                        <div class="relative z-10 h-full flex flex-col justify-between">

                            <div class="flex items-start gap-5">

                                {{-- ICON --}}
                                <div class="w-16 h-16 rounded-2xl
                                            bg-white/20
                                            backdrop-blur-xl
                                            flex items-center justify-center
                                            flex-shrink-0">

                                    <svg class="w-8 h-8 text-white"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>

                                {{-- TEXT --}}
                                <div>

                                    <h2 class="text-4xl font-bold text-white mb-3 leading-tight">
                                        Tracer Study Sudah Diisi
                                    </h2>

                                    <p class="text-white/95 text-lg leading-relaxed max-w-2xl">
                                        Terima kasih telah berpartisipasi dalam pengisian
                                        tracer study alumni.
                                    </p>
                                </div>
                            </div>

                            {{-- BUTTONS --}}
                            <div class="flex flex-wrap gap-4 mt-8">

                                {{-- EDIT --}}
                                <a href="{{ route('mahasiswa.tracer.edit') }}"
                                   class="px-7 py-3.5 rounded-2xl
                                          bg-white text-emerald-600
                                          font-semibold text-base
                                          shadow-lg
                                          hover:scale-[1.03]
                                          transition-all duration-300">

                                    Edit Jawaban
                                </a>

                                {{-- CHATBOT --}}
                                <a href="{{ route('mahasiswa.chatbot') }}"
                                   class="px-7 py-3.5 rounded-2xl
                                          border border-white/20
                                          bg-white/10 backdrop-blur-xl
                                          text-white font-semibold text-base
                                          hover:bg-white/20
                                          transition-all duration-300">

                                    Tanya AI Career Assistant
                                </a>
                            </div>
                        </div>
                    </div>

                @else

                    <div class="relative overflow-hidden
                                rounded-[28px]
                                bg-gradient-to-r
                                from-[#f59e0b]
                                via-[#f97316]
                                to-[#ea580c]
                                p-6 shadow-xl min-h-[210px]">

                        <div class="absolute right-[-80px] top-[-80px]
                                    w-[220px] h-[220px]
                                    rounded-full bg-white/10 blur-3xl">
                        </div>

                        <div class="relative z-10 h-full flex flex-col justify-between">

                            <div class="flex items-start gap-5">

                                <div class="w-16 h-16 rounded-2xl
                                            bg-white/20
                                            flex items-center justify-center
                                            flex-shrink-0">

                                    <svg class="w-8 h-8 text-white"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M12 8v4m0 4h.01"/>
                                    </svg>
                                </div>

                                <div>

                                    <h2 class="text-4xl font-bold text-white mb-3">
                                        Kamu Belum Mengisi Tracer Study
                                    </h2>

                                    <p class="text-white/95 text-lg leading-relaxed">
                                        Mohon luangkan waktu untuk mengisi
                                        form tracer study alumni.
                                    </p>
                                </div>
                            </div>

                            <div class="mt-8">

                                <a href="{{ route('mahasiswa.tracer.form') }}"
                                   class="inline-flex items-center justify-center
                                          px-7 py-3.5 rounded-2xl
                                          bg-white text-orange-500
                                          font-semibold text-base
                                          shadow-lg
                                          hover:scale-[1.03]
                                          transition-all duration-300">

                                    Isi Form Tracer Study
                                </a>
                            </div>
                        </div>
                    </div>

                @endif
            </div>

            {{-- RIGHT SIDEBAR --}}
            <div class="flex flex-col gap-6 h-full">

                {{-- INFO CARD --}}
                <div class="bg-white rounded-[28px]
                            border border-gray-200
                            shadow-sm p-6 flex-1">

                    <h3 class="text-2xl font-bold text-gray-800 mb-6">
                        Informasi
                    </h3>

                    <div class="space-y-5">

                        {{-- ITEM --}}
                        <div class="flex items-start gap-4">

                            <div class="w-14 h-14 rounded-2xl
                                        bg-blue-100
                                        flex items-center justify-center
                                        flex-shrink-0">

                                <svg class="w-6 h-6 text-blue-500"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M13 16h-1v-4h-1m1-4h.01"/>
                                </svg>
                            </div>

                            <div>
                                <h4 class="font-semibold text-lg text-gray-800">
                                    AI Career Assistant
                                </h4>

                                <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                                    Gunakan chatbot AI untuk rekomendasi karier alumni.
                                </p>
                            </div>
                        </div>

                        {{-- ITEM --}}
                        <div class="flex items-start gap-4">

                            <div class="w-14 h-14 rounded-2xl
                                        bg-indigo-100
                                        flex items-center justify-center
                                        flex-shrink-0">

                                <svg class="w-6 h-6 text-indigo-500"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M9 12h6m-6 4h6m2 5H7
                                             a2 2 0 01-2-2V5a2 2 0
                                             012-2h5.586a1 1 0 01.707.293
                                             l5.414 5.414a1 1 0 01.293.707V19
                                             a2 2 0 01-2 2z"/>
                                </svg>
                            </div>

                            <div>
                                <h4 class="font-semibold text-lg text-gray-800">
                                    Tracer Study
                                </h4>

                                <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                                    Pastikan data alumni selalu terupdate.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STATUS --}}
                <div class="bg-gradient-to-br
                            from-blue-600
                            to-indigo-700
                            rounded-[28px]
                            p-6 text-white shadow-xl">

                    <p class="text-blue-100 text-sm mb-2">
                        Status Akun
                    </p>

                    <h2 class="text-4xl font-bold mb-5">
                        Aktif
                    </h2>

                    <div class="h-3 rounded-full bg-white/20 overflow-hidden">
                        <div class="h-full w-full bg-white rounded-full"></div>
                    </div>

                    <p class="text-sm text-blue-100 mt-5 leading-relaxed">
                        Dashboard mahasiswa aktif dan siap digunakan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection