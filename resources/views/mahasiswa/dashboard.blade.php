@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa - Tracer Study')

@section('content')
<div class="min-h-screen bg-[#0f1117]">

    {{-- NAVBAR --}}
    <nav class="bg-[#0a0a0f]/80 backdrop-blur-xl border-b border-white/5 px-8 py-4 flex items-center justify-between sticky top-0 z-50">

        <div class="flex items-center gap-3">

            <div class="w-8 h-8 rounded-lg bg-blue-500/20 border border-blue-500/30 flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 14l6.16-3.422A12.083 12.083 0 0112 20.055a12.083 12.083 0 01-6.16-9.477L12 14z"/>
                </svg>
            </div>

            <span class="text-white font-semibold text-sm tracking-wide">
                Tracer Study
            </span>

        </div>

        <div class="flex items-center gap-4">

            <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white/5 border border-white/10">

                <div class="w-6 h-6 rounded-full bg-blue-500/30 flex items-center justify-center">
                    <span class="text-blue-400 text-xs font-bold">
                        {{ strtoupper(substr(Auth::guard('mahasiswa')->user()->nama, 0, 1)) }}
                    </span>
                </div>

                <span class="text-gray-300 text-sm">
                    {{ Auth::guard('mahasiswa')->user()->nama }}
                </span>

            </div>

            <form method="POST" action="{{ route('mahasiswa.logout') }}">
                @csrf

                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5 border border-white/10 transition">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>

                    Logout
                </button>

            </form>

        </div>
    </nav>

    {{-- CONTENT --}}
    <div class="px-8 py-10 max-w-4xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-10">

            <p class="text-gray-600 text-xs uppercase tracking-widest mb-2">
                Dashboard Mahasiswa
            </p>

            <h1 class="text-3xl font-bold text-white">
                Selamat Datang
            </h1>

            <p class="text-gray-500 text-sm mt-1">
                Kelola dan isi data tracer study alumni
            </p>

        </div>

        {{-- PROFILE CARD --}}
        <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl overflow-hidden mb-6">

            <div class="p-8">

                <div class="flex items-center gap-5">

                    <div class="w-20 h-20 rounded-2xl bg-blue-500/15 border border-blue-500/20 flex items-center justify-center">

                        <svg class="w-10 h-10 text-blue-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0zm6 1a9 9 0 11-18 0 9 9 0 0118 0z"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-2xl font-bold text-white mb-1">
                            {{ Auth::guard('mahasiswa')->user()->nama }}
                        </h2>

                        <div class="space-y-1">

                            <p class="text-gray-400 text-sm">
                                NIM:
                                <span class="text-gray-300 font-medium">
                                    {{ Auth::guard('mahasiswa')->user()->nim }}
                                </span>
                            </p>

                            <p class="text-gray-500 text-sm">
                                {{ Auth::guard('mahasiswa')->user()->program_studi }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- STATUS --}}
        @php
            $tracer = Auth::guard('mahasiswa')->user()->tracerStudy;
        @endphp

        @if($tracer)

            {{-- SUDAH MENGISI --}}
            <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-2xl p-6 mb-6">

                <div class="flex items-start gap-4">

                    <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 flex items-center justify-center flex-shrink-0">

                        <svg class="w-7 h-7 text-emerald-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"/>

                        </svg>

                    </div>

                    <div>

                        <h3 class="text-lg font-semibold text-emerald-400 mb-1">
                            Form Tracer Study Sudah Diisi
                        </h3>

                        <p class="text-sm text-emerald-300/80">
                            Terima kasih telah berpartisipasi dalam pengisian tracer study alumni.
                        </p>

                    </div>

                </div>

            </div>

            <a href="{{ route('mahasiswa.tracer.edit') }}"
               class="w-full inline-flex items-center justify-center gap-2
                      px-6 py-4 rounded-2xl
                      bg-blue-500 hover:bg-blue-600
                      text-white font-semibold transition">

                <svg class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>

                </svg>

                Edit Jawaban

            </a>

        @else

            {{-- BELUM MENGISI --}}
            <div class="bg-amber-500/10 border border-amber-500/20 rounded-2xl p-6 mb-6">

                <div class="flex items-start gap-4">

                    <div class="w-14 h-14 rounded-2xl bg-amber-500/20 flex items-center justify-center flex-shrink-0">

                        <svg class="w-7 h-7 text-amber-400"
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

                        <h3 class="text-lg font-semibold text-amber-400 mb-1">
                            Kamu Belum Mengisi Tracer Study
                        </h3>

                        <p class="text-sm text-amber-300/80">
                            Mohon luangkan waktu untuk mengisi form tracer study alumni.
                        </p>

                    </div>

                </div>

            </div>

            <a href="{{ route('mahasiswa.tracer.form') }}"
               class="w-full inline-flex items-center justify-center gap-2
                      px-6 py-4 rounded-2xl
                      bg-blue-500 hover:bg-blue-600
                      text-white font-semibold transition">

                <svg class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                </svg>

                Isi Form Tracer Study Sekarang

            </a>

        @endif

    </div>
</div>
@endsection