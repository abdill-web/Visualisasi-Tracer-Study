@extends('layouts.app')

@section('title', 'Data Tracer Study')

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
            <a href="{{ route('admin.dashboard') }}" class="text-gray-500 text-sm hover:text-gray-300 transition">Dashboard</a>
            <span class="text-gray-700">/</span>
            <span class="text-gray-300 text-sm">Data Tracer Study</span>
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
                <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5 border border-white/10 transition">
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
            <p class="text-gray-600 text-xs uppercase tracking-widest mb-2">Tracer Study</p>
            <h1 class="text-3xl font-bold text-white">Data Pengisian</h1>
            <p class="text-gray-500 text-sm mt-1">Total {{ $sudahIsi }} mahasiswa sudah mengisi form tracer study</p>
        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-3 gap-4 mb-8">
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-gray-500 text-xs uppercase tracking-wide">Sudah Mengisi</p>
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white">{{ $sudahIsi }}</p>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-gray-500 text-xs uppercase tracking-wide">Belum Mengisi</p>
                    <div class="w-8 h-8 rounded-lg bg-amber-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white">{{ $belumIsi }}</p>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-gray-500 text-xs uppercase tracking-wide">Response Rate</p>
                    <div class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white">{{ $responseRate }}<span class="text-xl text-gray-500">%</span></p>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-white/[0.06]">
                <h2 class="text-white font-semibold text-sm">Daftar Pengisian</h2>
            </div>
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/[0.06]">
                        <th class="text-left px-6 py-3.5 text-gray-500 font-medium text-xs uppercase tracking-wide">Nama</th>
                        <th class="text-left px-6 py-3.5 text-gray-500 font-medium text-xs uppercase tracking-wide">NIM</th>
                        <th class="text-left px-6 py-3.5 text-gray-500 font-medium text-xs uppercase tracking-wide">Program Studi</th>
                        <th class="text-left px-6 py-3.5 text-gray-500 font-medium text-xs uppercase tracking-wide">Status</th>
                        <th class="text-left px-6 py-3.5 text-gray-500 font-medium text-xs uppercase tracking-wide">Perusahaan</th>
                        <th class="text-left px-6 py-3.5 text-gray-500 font-medium text-xs uppercase tracking-wide">Tanggal</th>
                        <th class="text-left px-6 py-3.5 text-gray-500 font-medium text-xs uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr class="border-b border-white/[0.04] hover:bg-white/[0.02] transition">
                        <td class="px-6 py-4 font-medium text-white">{{ $item->mahasiswa->nama }}</td>
                        <td class="px-6 py-4 font-mono text-gray-500 text-xs">{{ $item->mahasiswa->nim }}</td>
                        <td class="px-6 py-4 text-gray-400 text-xs">{{ $item->mahasiswa->program_studi }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusMap = [
                                    'bekerja'      => ['label' => 'Bekerja',       'class' => 'bg-emerald-500/15 text-emerald-400 border border-emerald-500/20'],
                                    'wirausaha'    => ['label' => 'Wirausaha',     'class' => 'bg-amber-500/15 text-amber-400 border border-amber-500/20'],
                                    'studi_lanjut' => ['label' => 'Studi Lanjut', 'class' => 'bg-blue-500/15 text-blue-400 border border-blue-500/20'],
                                    'tidak_bekerja'=> ['label' => 'Tidak Bekerja','class' => 'bg-red-500/15 text-red-400 border border-red-500/20'],
                                    'belum_bekerja'=> ['label' => 'Belum Bekerja','class' => 'bg-gray-500/15 text-gray-400 border border-gray-500/20'],
                                ];
                                $s = $statusMap[$item->status_saat_ini] ?? ['label' => $item->status_saat_ini ?? '-', 'class' => 'bg-gray-500/15 text-gray-400'];
                            @endphp
                            <span class="text-xs px-2.5 py-1 rounded-full font-medium {{ $s['class'] }}">{{ $s['label'] }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-xs">
                            {{ $item->nama_perusahaan ?? $item->nama_usaha ?? $item->nama_kampus_lanjut ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-gray-600 text-xs">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.tracer.show', $item->id) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium
                                      bg-white/5 border border-white/10 text-gray-300 hover:text-white hover:bg-white/10 transition">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="text-gray-600 text-sm">Belum ada data tracer study yang masuk</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t border-white/[0.06]">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
@endsection