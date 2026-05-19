@extends('layouts.app')

@section('title', 'Dashboard Admin')

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
                <form method="POST"
                      action="{{ route('logout') }}">

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

                        DASHBOARD ADMIN
                    </p>

                    <h1 class="text-5xl lg:text-6xl
                               font-bold text-white
                               leading-tight mb-4">

                        Selamat Datang,<br>
                        {{ Auth::user()->name }}
                    </h1>

                    <p class="text-emerald-100 text-lg">
                        Kelola data alumni, tracer study,
                        visualisasi AI, dan monitoring sistem.
                    </p>
                </div>

                {{-- RIGHT --}}
                <div class="grid grid-cols-2 gap-4">

                    <div class="bg-white/10 backdrop-blur-md
                                border border-white/10
                                rounded-[28px]
                                px-6 py-5 min-w-[170px]">

                        <p class="text-emerald-100 text-sm mb-2">
                            Total Mahasiswa
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
                            Response Rate
                        </p>

                        <h3 class="text-4xl font-bold text-white">
                            {{ $responseRate }}%
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-1 md:grid-cols-2
                    lg:grid-cols-4 gap-6 mb-10">

            {{-- CARD --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7
                        hover:shadow-md
                        transition-all duration-300">

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <p class="text-sm text-gray-500 mb-1">
                            Total Mahasiswa
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
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857
                                     M17 20H7m10 0v-2c0-.656-.126-1.283
                                     -.356-1.857M7 20H2v-2a3 3 0
                                     015.356-1.857M7 20v-2c0-.656
                                     .126-1.283.356-1.857m0 0
                                     a5.002 5.002 0 019.288 0M15 7
                                     a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>

                <p class="text-gray-500 text-sm">
                    Alumni terdaftar di sistem
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7
                        hover:shadow-md
                        transition-all duration-300">

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <p class="text-sm text-gray-500 mb-1">
                            Sudah Mengisi
                        </p>

                        <h2 class="text-5xl font-bold text-gray-900">
                            {{ $sudahIsi }}
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
                                  d="M9 12l2 2 4-4m6 2
                                     a9 9 0 11-18 0
                                     9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <p class="text-gray-500 text-sm">
                    Responden tracer study aktif
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7
                        hover:shadow-md
                        transition-all duration-300">

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <p class="text-sm text-gray-500 mb-1">
                            Belum Mengisi
                        </p>

                        <h2 class="text-5xl font-bold text-gray-900">
                            {{ $belumIsi }}
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
                                  d="M12 8v4l3 3m6-3
                                     a9 9 0 11-18 0
                                     9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <p class="text-gray-500 text-sm">
                    Menunggu pengisian data
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7
                        hover:shadow-md
                        transition-all duration-300">

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <p class="text-sm text-gray-500 mb-1">
                            Response Rate
                        </p>

                        <h2 class="text-5xl font-bold text-gray-900">
                            {{ $responseRate }}%
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
                                  d="M11 3.055A9.001 9.001 0
                                     1020.945 13H11V3.055z"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M20.488 9H15V3.512
                                     A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                    </div>
                </div>

                <p class="text-gray-500 text-sm">
                    Tingkat partisipasi alumni
                </p>
            </div>
        </div>

        {{-- MENU TITLE --}}
        <div class="mb-5">

            <p class="text-xs uppercase
                      tracking-[0.3em]
                      text-gray-500 mb-2">

                MENU UTAMA
            </p>

            <h2 class="text-3xl font-bold text-gray-900">
                Kelola Sistem
            </h2>
        </div>

        {{-- MENU CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- MENU --}}
            <a href="{{ route('admin.mahasiswa.index') }}"
               class="group bg-white rounded-[32px]
                      border border-gray-200
                      p-8 shadow-sm
                      hover:shadow-xl
                      hover:-translate-y-1
                      transition-all duration-300">

                <div class="w-20 h-20 rounded-[28px]
                            bg-blue-100
                            flex items-center justify-center
                            mb-6 group-hover:scale-105
                            transition">

                    <svg class="w-10 h-10 text-blue-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17 20h5v-2a3 3 0
                                 00-5.356-1.857M17 20H7
                                 m10 0v-2c0-.656-.126
                                 -1.283-.356-1.857M7
                                 20H2v-2a3 3 0
                                 015.356-1.857M7
                                 20v-2c0-.656.126
                                 -1.283.356-1.857m0 0
                                 a5.002 5.002 0
                                 019.288 0M15 7a3 3 0
                                 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>

                <h3 class="text-2xl font-bold
                           text-gray-900 mb-3">

                    Kelola Mahasiswa
                </h3>

                <p class="text-gray-500 leading-relaxed">
                    Import, edit, dan manajemen data mahasiswa
                    serta alumni tracer study.
                </p>

                <div class="mt-6 text-blue-600
                            font-semibold flex items-center gap-2">

                    Buka Menu

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            {{-- MENU --}}
            <a href="{{ route('admin.tracer.index') }}"
               class="group bg-white rounded-[32px]
                      border border-gray-200
                      p-8 shadow-sm
                      hover:shadow-xl
                      hover:-translate-y-1
                      transition-all duration-300">

                <div class="w-20 h-20 rounded-[28px]
                            bg-emerald-100
                            flex items-center justify-center
                            mb-6 group-hover:scale-105
                            transition">

                    <svg class="w-10 h-10 text-emerald-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5H7a2 2 0
                                 00-2 2v12a2 2 0
                                 002 2h10a2 2 0
                                 002-2V7a2 2 0
                                 00-2-2h-2M9 5a2 2 0
                                 002 2h2a2 2 0
                                 002-2M9 5a2 2 0
                                 012-2h2a2 2 0
                                 012 2m-3 7h3m-3
                                 4h3m-6-4h.01M9
                                 16h.01"/>
                    </svg>
                </div>

                <h3 class="text-2xl font-bold
                           text-gray-900 mb-3">

                    Data Tracer Study
                </h3>

                <p class="text-gray-500 leading-relaxed">
                    Monitoring seluruh data pengisian
                    tracer study alumni secara realtime.
                </p>

                <div class="mt-6 text-emerald-600
                            font-semibold flex items-center gap-2">

                    Buka Menu

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            {{-- MENU --}}
            <a href="{{ route('admin.visualisasi.index') }}"
               class="group bg-white rounded-[32px]
                      border border-gray-200
                      p-8 shadow-sm
                      hover:shadow-xl
                      hover:-translate-y-1
                      transition-all duration-300">

                <div class="w-20 h-20 rounded-[28px]
                            bg-purple-100
                            flex items-center justify-center
                            mb-6 group-hover:scale-105
                            transition">

                    <svg class="w-10 h-10 text-purple-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 19v-6a2 2 0
                                 00-2-2H5a2 2 0
                                 00-2 2v6a2 2 0
                                 002 2h2a2 2 0
                                 002-2zm0 0V9a2 2 0
                                 012-2h2a2 2 0
                                 012 2v10m-6 0a2 2 0
                                 002 2h2a2 2 0
                                 002-2m0 0V5a2 2 0
                                 012-2h2a2 2 0
                                 012 2v14a2 2 0
                                 01-2 2h-2a2 2 0
                                 01-2-2z"/>
                    </svg>
                </div>

                <h3 class="text-2xl font-bold
                           text-gray-900 mb-3">

                    Visualisasi & AI
                </h3>

                <p class="text-gray-500 leading-relaxed">
                    Analisis pola karir alumni berbasis
                    AI dan machine learning.
                </p>

                <div class="mt-6 text-purple-600
                            font-semibold flex items-center gap-2">

                    Buka Menu

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection