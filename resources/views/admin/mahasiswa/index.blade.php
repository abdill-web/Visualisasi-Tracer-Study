@extends('layouts.app')

@section('title', 'Data Mahasiswa')

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

            <span class="text-gray-300 text-sm">Data Mahasiswa</span>
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

    <div class="px-8 py-10 max-w-7xl mx-auto">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-10">
            <div>
                <p class="text-gray-600 text-xs uppercase tracking-widest mb-2">
                    Mahasiswa
                </p>

                <h1 class="text-3xl font-bold text-white">
                    Data Mahasiswa
                </h1>

                <p class="text-gray-500 text-sm mt-1">
                    Total {{ $total }} mahasiswa terdaftar
                </p>
            </div>

            <a href="{{ route('admin.mahasiswa.import') }}"
               class="inline-flex items-center gap-2 px-5 py-3 rounded-xl
                      bg-emerald-500 hover:bg-emerald-600
                      text-white text-sm font-semibold transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
                Import CSV
            </a>
        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-3 gap-4 mb-8">

            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-gray-500 text-xs uppercase tracking-wide">
                        Sudah Mengisi
                    </p>

                    <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <p class="text-3xl font-bold text-white">
                    {{ $sudahIsi }}
                </p>
            </div>

            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-gray-500 text-xs uppercase tracking-wide">
                        Belum Mengisi
                    </p>

                    <div class="w-8 h-8 rounded-lg bg-amber-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <p class="text-3xl font-bold text-white">
                    {{ $belumIsi }}
                </p>
            </div>

            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-gray-500 text-xs uppercase tracking-wide">
                        Response Rate
                    </p>

                    <div class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        </svg>
                    </div>
                </div>

                <p class="text-3xl font-bold text-white">
                    {{ $responseRate }}
                    <span class="text-xl text-gray-500">%</span>
                </p>
            </div>

        </div>

        {{-- SUCCESS --}}
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

        {{-- TABLE --}}
        <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl overflow-hidden">

            <div class="px-6 py-4 border-b border-white/[0.06]">
                <h2 class="text-white font-semibold text-sm">
                    Daftar Mahasiswa
                </h2>
            </div>

            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/[0.06]">
                        <th class="text-left px-6 py-3.5 text-gray-500 font-medium text-xs uppercase tracking-wide">
                            NIM
                        </th>

                        <th class="text-left px-6 py-3.5 text-gray-500 font-medium text-xs uppercase tracking-wide">
                            Nama
                        </th>

                        <th class="text-left px-6 py-3.5 text-gray-500 font-medium text-xs uppercase tracking-wide">
                            Program Studi
                        </th>

                        <th class="text-left px-6 py-3.5 text-gray-500 font-medium text-xs uppercase tracking-wide">
                            Tahun Lulus
                        </th>

                        <th class="text-left px-6 py-3.5 text-gray-500 font-medium text-xs uppercase tracking-wide">
                            Status
                        </th>

                        <th class="text-left px-6 py-3.5 text-gray-500 font-medium text-xs uppercase tracking-wide">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($mahasiswa as $mhs)

                    <tr class="border-b border-white/[0.04] hover:bg-white/[0.02] transition">

                        <td class="px-6 py-4 font-mono text-gray-500 text-xs">
                            {{ $mhs->nim }}
                        </td>

                        <td class="px-6 py-4 font-medium text-white">
                            {{ $mhs->nama }}
                        </td>

                        <td class="px-6 py-4 text-gray-400 text-xs">
                            {{ $mhs->program_studi }}
                        </td>

                        <td class="px-6 py-4 text-gray-500 text-xs">
                            {{ $mhs->tahun_lulus ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            @if($mhs->tracer_study_count > 0)
                                <span class="text-xs px-2.5 py-1 rounded-full font-medium
                                             bg-emerald-500/15 text-emerald-400 border border-emerald-500/20">
                                    Sudah Mengisi
                                </span>
                            @else
                                <span class="text-xs px-2.5 py-1 rounded-full font-medium
                                             bg-amber-500/15 text-amber-400 border border-amber-500/20">
                                    Belum Mengisi
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <form method="POST"
                                  action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}"
                                  onsubmit="return confirm('Hapus data mahasiswa ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium
                                           bg-red-500/10 border border-red-500/20
                                           text-red-400 hover:bg-red-500/20 transition">

                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8"/>
                                    </svg>

                                    Hapus
                                </button>
                            </form>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">

                            <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 20h5V4H2v16h5m10 0v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6m10 0H7"/>
                                </svg>
                            </div>

                            <p class="text-gray-600 text-sm mb-2">
                                Belum ada data mahasiswa
                            </p>

                            <a href="{{ route('admin.mahasiswa.import') }}"
                               class="text-emerald-400 hover:text-emerald-300 text-sm transition">
                                Import CSV sekarang
                            </a>

                        </td>
                    </tr>

                    @endforelse
                </tbody>
            </table>

            <div class="px-6 py-4 border-t border-white/[0.06]">
                {{ $mahasiswa->links() }}
            </div>

        </div>
    </div>
</div>
@endsection