@extends('layouts.app')

@section('title', 'Data Mahasiswa')

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

                        DATA MAHASISWA
                    </p>

                    <h1 class="text-5xl lg:text-6xl
                               font-bold text-white
                               leading-tight mb-4">

                        Kelola<br>
                        Mahasiswa
                    </h1>

                    <p class="text-emerald-100 text-lg">
                        Monitoring dan pengelolaan data mahasiswa
                        tracer study Universitas Mercu Buana.
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

        {{-- ACTION --}}
        <div class="flex flex-col lg:flex-row
                    lg:items-center lg:justify-between
                    gap-5 mb-8">

            <div>

                <p class="text-xs uppercase
                          tracking-[0.3em]
                          text-gray-500 mb-2">

                    MANAGEMENT
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    Data Mahasiswa
                </h2>
            </div>

            <a href="{{ route('admin.mahasiswa.import') }}"
               class="inline-flex items-center justify-center gap-2
                      px-6 py-4 rounded-2xl
                      text-white font-semibold
                      shadow-lg shadow-emerald-500/20
                      transition-all duration-300
                      hover:scale-[1.01]
                      active:scale-[0.99]"
               style="background: linear-gradient(135deg, #10b981, #14b8a6);">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M7 16a4 4 0 01-.88-7.903A5 5 0
                             1115.9 6L16 6a5 5 0 011 9.9M15 13
                             l-3-3m0 0l-3 3m3-3v12"/>
                </svg>

                Import CSV
            </a>
        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            {{-- CARD --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="flex items-center justify-between mb-5">

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
                    Mahasiswa telah mengisi tracer study
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="flex items-center justify-between mb-5">

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
                    Menunggu pengisian tracer study
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-[32px]
                        border border-gray-200
                        shadow-sm p-7">

                <div class="flex items-center justify-between mb-5">

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
                        </svg>
                    </div>
                </div>

                <p class="text-gray-500 text-sm">
                    Tingkat partisipasi mahasiswa
                </p>
            </div>
        </div>

        {{-- SUCCESS --}}
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

        {{-- TABLE --}}
        <div class="bg-white rounded-[36px]
                    border border-gray-200
                    shadow-sm overflow-hidden">

            {{-- TABLE HEADER --}}
            <div class="px-8 py-6 border-b border-gray-100">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs uppercase
                                  tracking-[0.3em]
                                  text-gray-500 mb-2">

                            MAHASISWA
                        </p>

                        <h3 class="text-2xl font-bold text-gray-900">
                            Daftar Mahasiswa
                        </h3>
                    </div>

                    <div class="px-4 py-2 rounded-2xl
                                bg-gray-100 text-gray-600
                                text-sm font-medium">

                        {{ $total }} Data
                    </div>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="text-left px-8 py-5
                                       text-xs font-semibold
                                       uppercase tracking-wide
                                       text-gray-500">

                                NIM
                            </th>

                            <th class="text-left px-8 py-5
                                       text-xs font-semibold
                                       uppercase tracking-wide
                                       text-gray-500">

                                Nama
                            </th>

                            <th class="text-left px-8 py-5
                                       text-xs font-semibold
                                       uppercase tracking-wide
                                       text-gray-500">

                                Program Studi
                            </th>

                            <th class="text-left px-8 py-5
                                       text-xs font-semibold
                                       uppercase tracking-wide
                                       text-gray-500">

                                Tahun Lulus
                            </th>

                            <th class="text-left px-8 py-5
                                       text-xs font-semibold
                                       uppercase tracking-wide
                                       text-gray-500">

                                Status
                            </th>

                            <th class="text-left px-8 py-5
                                       text-xs font-semibold
                                       uppercase tracking-wide
                                       text-gray-500">

                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($mahasiswa as $mhs)

                        <tr class="border-b border-gray-100
                                   hover:bg-gray-50
                                   transition">

                            <td class="px-8 py-5">

                                <div class="font-mono
                                            text-sm text-gray-500">

                                    {{ $mhs->nim }}
                                </div>
                            </td>

                            <td class="px-8 py-5">

                                <div class="flex items-center gap-4">

                                    <div class="w-12 h-12 rounded-2xl
                                                bg-gradient-to-br
                                                from-emerald-500
                                                to-teal-600
                                                flex items-center justify-center
                                                text-white font-bold">

                                        {{ strtoupper(substr($mhs->nama, 0, 1)) }}
                                    </div>

                                    <div>

                                        <p class="font-semibold text-gray-900">
                                            {{ $mhs->nama }}
                                        </p>

                                        <p class="text-sm text-gray-500">
                                            Mahasiswa
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-8 py-5 text-gray-600">
                                {{ $mhs->program_studi }}
                            </td>

                            <td class="px-8 py-5 text-gray-500">
                                {{ $mhs->tahun_lulus ?? '-' }}
                            </td>

                            <td class="px-8 py-5">

                                @if($mhs->tracer_study_count > 0)

                                    <span class="inline-flex items-center gap-2
                                                 px-4 py-2 rounded-full
                                                 bg-emerald-100
                                                 text-emerald-700
                                                 text-sm font-medium">

                                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>

                                        Sudah Mengisi
                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-2
                                                 px-4 py-2 rounded-full
                                                 bg-amber-100
                                                 text-amber-700
                                                 text-sm font-medium">

                                        <div class="w-2 h-2 rounded-full bg-amber-500"></div>

                                        Belum Mengisi
                                    </span>

                                @endif
                            </td>

                            <td class="px-8 py-5">

                                <form method="POST"
                                      action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}"
                                      onsubmit="return confirm('Hapus data mahasiswa ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="inline-flex items-center gap-2
                                                   px-4 py-2 rounded-2xl
                                                   bg-red-50 border border-red-200
                                                   text-red-600
                                                   hover:bg-red-100
                                                   transition-all duration-300">

                                        <svg class="w-4 h-4"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0
                                                     0116.138 21H7.862a2 2 0
                                                     01-1.995-1.858L5 7m5
                                                     4v6m4-6v6M9 7V4a1 1 0
                                                     011-1h4a1 1 0 011 1v3m-7
                                                     0h8"/>
                                        </svg>

                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        @empty

                        <tr>

                            <td colspan="6"
                                class="px-8 py-20 text-center">

                                <div class="w-20 h-20 rounded-[28px]
                                            bg-gray-100
                                            flex items-center justify-center
                                            mx-auto mb-6">

                                    <svg class="w-10 h-10 text-gray-400"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M17 20h5V4H2v16h5m10 0v-6a2 2 0
                                                 00-2-2H9a2 2 0 00-2 2v6m10
                                                 0H7"/>
                                    </svg>
                                </div>

                                <h3 class="text-2xl font-bold
                                           text-gray-800 mb-2">

                                    Belum Ada Data
                                </h3>

                                <p class="text-gray-500 mb-6">
                                    Import data mahasiswa untuk memulai
                                </p>

                                <a href="{{ route('admin.mahasiswa.import') }}"
                                   class="inline-flex items-center gap-2
                                          px-6 py-4 rounded-2xl
                                          text-white font-semibold
                                          shadow-lg shadow-emerald-500/20
                                          transition-all duration-300"
                                   style="background: linear-gradient(135deg, #10b981, #14b8a6);">

                                    Import CSV
                                </a>
                            </td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="px-8 py-6 border-t border-gray-100
                        bg-gray-50">

                {{ $mahasiswa->links() }}
            </div>
        </div>
    </div>
</div>

@endsection