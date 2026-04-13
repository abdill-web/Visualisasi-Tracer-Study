@extends('layouts.app')

@section('title', 'Dashboard Admin - Tracer Study')

@section('content')
<div class="min-h-screen bg-gray-100">

    {{-- Navbar --}}
    <nav class="bg-gray-900 text-white px-6 py-4 flex items-center justify-between shadow-lg">
        <div class="flex items-center gap-3">
            <i class="fas fa-shield-halved text-xl"></i>
            <span class="font-bold text-lg">Tracer Study — Admin Panel</span>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-gray-300 text-sm">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    <i class="fas fa-right-from-bracket mr-1"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    {{-- Content --}}
    <div class="p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Dashboard</h1>
        <p class="text-gray-500 mb-8">Selamat datang di panel admin Tracer Study</p>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
                <div class="bg-blue-100 text-blue-600 rounded-full w-14 h-14 flex items-center justify-center text-2xl">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Mahasiswa</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $total }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
                <div class="bg-green-100 text-green-600 rounded-full w-14 h-14 flex items-center justify-center text-2xl">
                    <i class="fas fa-file-circle-check"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Sudah Mengisi</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $sudahIsi }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
                <div class="bg-yellow-100 text-yellow-600 rounded-full w-14 h-14 flex items-center justify-center text-2xl">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Belum Mengisi</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $belumIsi }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
                <div class="bg-purple-100 text-purple-600 rounded-full w-14 h-14 flex items-center justify-center text-2xl">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Response Rate</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $responseRate }}%</p>
                </div>
            </div>
        </div>

        {{-- Menu Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('admin.mahasiswa.index') }}"
                class="bg-white rounded-xl shadow p-6 hover:shadow-md transition hover:border-blue-300 border border-transparent">
                    <div class="text-blue-600 text-3xl mb-3"><i class="fas fa-users"></i></div>
                    <h3 class="font-semibold text-gray-800 text-lg mb-1">Kelola Mahasiswa</h3>
                    <p class="text-gray-500 text-sm">Import & kelola data mahasiswa dari CSV</p>
            </a>
            <a href="{{ route('admin.tracer.index') }}"
                class="bg-white rounded-xl shadow p-6 hover:shadow-md transition hover:border-green-300 border border-transparent">
                    <div class="text-green-600 text-3xl mb-3"><i class="fas fa-table-list"></i></div>
                    <h3 class="font-semibold text-gray-800 text-lg mb-1">Data Tracer Study</h3>
                    <p class="text-gray-500 text-sm">Lihat & kelola semua data pengisian</p>
            </a>
            <a href="{{ route('admin.visualisasi.index') }}"
                class="bg-white rounded-xl shadow p-6 hover:shadow-md transition hover:border-purple-300 border border-transparent">
                    <div class="text-purple-600 text-3xl mb-3"><i class="fas fa-chart-line"></i></div>
                    <h3 class="font-semibold text-gray-800 text-lg mb-1">Visualisasi & AI</h3>
                    <p class="text-gray-500 text-sm">Analisis pola karir berbasis AI</p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection