@extends('layouts.app')

@section('title', 'Dashboard Admin - Tracer Study')

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
            <span class="text-white font-semibold text-sm">Tracer Study</span>
            <span class="text-gray-600 text-sm">/</span>
            <span class="text-gray-400 text-sm">Admin Panel</span>
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
                <button type="submit"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5 border border-white/10 transition">
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
            <p class="text-gray-600 text-xs uppercase tracking-widest mb-2">Overview</p>
            <h1 class="text-3xl font-bold text-white">Dashboard</h1>
            <p class="text-gray-500 text-sm mt-1">Selamat datang kembali, {{ Auth::user()->name }}</p>
        </div>

        {{-- STATS CARDS --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6 hover:bg-white/[0.05] transition">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-gray-500 text-xs uppercase tracking-wide">Total Mahasiswa</p>
                    <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-white">{{ $total }}</p>
                <p class="text-gray-600 text-xs mt-2">Alumni terdaftar</p>
            </div>

            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6 hover:bg-white/[0.05] transition">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-gray-500 text-xs uppercase tracking-wide">Sudah Mengisi</p>
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-white">{{ $sudahIsi }}</p>
                <p class="text-gray-600 text-xs mt-2">Responden aktif</p>
            </div>

            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6 hover:bg-white/[0.05] transition">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-gray-500 text-xs uppercase tracking-wide">Belum Mengisi</p>
                    <div class="w-8 h-8 rounded-lg bg-amber-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-white">{{ $belumIsi }}</p>
                <p class="text-gray-600 text-xs mt-2">Menunggu respons</p>
            </div>

            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6 hover:bg-white/[0.05] transition">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-gray-500 text-xs uppercase tracking-wide">Response Rate</p>
                    <div class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-white">{{ $responseRate }}<span class="text-2xl text-gray-500">%</span></p>
                <p class="text-gray-600 text-xs mt-2">Tingkat partisipasi</p>
            </div>
        </div>

        {{-- MENU CARDS --}}
        <div class="mb-4">
            <p class="text-gray-600 text-xs uppercase tracking-widest">Menu Utama</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <a href="{{ route('admin.mahasiswa.index') }}"
               class="group bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6
                      hover:bg-white/[0.06] hover:border-blue-500/30 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-blue-500/20 border border-blue-500/20 flex items-center justify-center mb-5
                            group-hover:bg-blue-500/30 transition">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold mb-1">Kelola Mahasiswa</h3>
                <p class="text-gray-600 text-sm">Import & kelola data mahasiswa dari CSV</p>
                <div class="mt-5 flex items-center gap-1 text-blue-400 text-xs opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-[-4px] group-hover:translate-x-0">
                    <span>Buka</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            <a href="{{ route('admin.tracer.index') }}"
               class="group bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6
                      hover:bg-white/[0.06] hover:border-emerald-500/30 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 border border-emerald-500/20 flex items-center justify-center mb-5
                            group-hover:bg-emerald-500/30 transition">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold mb-1">Data Tracer Study</h3>
                <p class="text-gray-600 text-sm">Lihat & kelola semua data pengisian</p>
                <div class="mt-5 flex items-center gap-1 text-emerald-400 text-xs opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-[-4px] group-hover:translate-x-0">
                    <span>Buka</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            <a href="{{ route('admin.visualisasi.index') }}"
               class="group bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6
                      hover:bg-white/[0.06] hover:border-purple-500/30 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-purple-500/20 border border-purple-500/20 flex items-center justify-center mb-5
                            group-hover:bg-purple-500/30 transition">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold mb-1">Visualisasi & AI</h3>
                <p class="text-gray-600 text-sm">Analisis pola karir berbasis AI & ML</p>
                <div class="mt-5 flex items-center gap-1 text-purple-400 text-xs opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-[-4px] group-hover:translate-x-0">
                    <span>Buka</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection