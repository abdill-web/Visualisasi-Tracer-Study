@extends('layouts.app')

@section('title', 'Import Mahasiswa')

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

    <div class="p-8 max-w-2xl mx-auto">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.mahasiswa.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Import Data Mahasiswa</h1>
        </div>

        {{-- Format CSV --}}
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6">
            <h3 class="font-semibold text-blue-800 mb-2"><i class="fas fa-info-circle mr-1"></i> Format CSV</h3>
            <p class="text-blue-700 text-sm mb-3">Pastikan file CSV kamu memiliki kolom dengan urutan berikut:</p>
            <div class="bg-white rounded-lg p-3 font-mono text-sm text-gray-700 overflow-x-auto">
                nim, nama, tanggal_lahir, program_studi, fakultas, tahun_masuk, tahun_lulus
            </div>
            <p class="text-blue-600 text-xs mt-2">* Kolom fakultas, tahun_masuk, tahun_lulus bersifat opsional</p>
            <p class="text-blue-600 text-xs">* Format tanggal_lahir: YYYY-MM-DD (contoh: 2000-05-14)</p>
        </div>

        {{-- Contoh CSV --}}
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 mb-6">
            <h3 class="font-semibold text-gray-700 mb-2"><i class="fas fa-file-csv mr-1"></i> Contoh isi CSV</h3>
            <div class="font-mono text-xs text-gray-600 space-y-1">
                <p>nim,nama,tanggal_lahir,program_studi,fakultas,tahun_masuk,tahun_lulus</p>
                <p>2021001,Budi Santoso,2000-05-14,Teknik Informatika,Fakultas Teknik,2021,2025</p>
                <p>2021002,Siti Rahayu,1999-12-01,Sistem Informasi,Fakultas Teknik,2021,2025</p>
            </div>
        </div>

        {{-- Form Upload --}}
        <div class="bg-white rounded-xl shadow p-6">
            <form method="POST" action="{{ route('admin.mahasiswa.import.post') }}" enctype="multipart/form-data">
                @csrf

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 mb-4 text-sm">
                        <i class="fas fa-circle-check mr-1"></i> {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-4 text-sm">
                        <i class="fas fa-circle-exclamation mr-1"></i> {{ $errors->first() }}
                    </div>
                @endif

                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih File CSV</label>
                <input
                    type="file"
                    name="csv_file"
                    accept=".csv"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
                    required
                />

                <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 rounded-lg transition flex items-center justify-center gap-2">
                    <i class="fas fa-upload"></i> Import Data
                </button>
            </form>
        </div>
    </div>
</div>
@endsection