@extends('layouts.app')

@section('title', 'Detail Tracer Study')

@section('content')
<div class="min-h-screen bg-gray-100">
    <nav class="bg-gray-900 text-white px-6 py-4 flex items-center justify-between shadow-lg">
        <div class="flex items-center gap-3">
            <i class="fas fa-shield-halved text-xl"></i>
            <span class="font-bold text-lg">Tracer Study — Admin Panel</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.tracer.index') }}" class="text-gray-300 hover:text-white text-sm">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    <i class="fas fa-right-from-bracket mr-1"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="p-8 max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Detail Tracer Study</h1>

        {{-- Identitas --}}
        <div class="bg-white rounded-xl shadow p-6 mb-5">
            <h2 class="font-bold text-gray-700 mb-4 pb-2 border-b flex items-center gap-2">
                <i class="fas fa-user text-blue-600"></i> Identitas Mahasiswa
            </h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">Nama</span><p class="font-medium text-gray-800">{{ $tracer->mahasiswa->nama }}</p></div>
                <div><span class="text-gray-500">NIM</span><p class="font-medium text-gray-800">{{ $tracer->mahasiswa->nim }}</p></div>
                <div><span class="text-gray-500">Program Studi</span><p class="font-medium text-gray-800">{{ $tracer->mahasiswa->program_studi }}</p></div>
                <div><span class="text-gray-500">Tahun Lulus</span><p class="font-medium text-gray-800">{{ $tracer->tahun_lulus ?? '-' }}</p></div>
                <div><span class="text-gray-500">No. Telepon</span><p class="font-medium text-gray-800">{{ $tracer->no_telepon ?? '-' }}</p></div>
                <div><span class="text-gray-500">Email</span><p class="font-medium text-gray-800">{{ $tracer->email ?? '-' }}</p></div>
                <div><span class="text-gray-500">Instagram</span><p class="font-medium text-gray-800">{{ $tracer->instagram ?? '-' }}</p></div>
                <div><span class="text-gray-500">LinkedIn</span><p class="font-medium text-gray-800">{{ $tracer->linkedin ?? '-' }}</p></div>
            </div>
        </div>

        {{-- Status --}}
        <div class="bg-white rounded-xl shadow p-6 mb-5">
            <h2 class="font-bold text-gray-700 mb-4 pb-2 border-b flex items-center gap-2">
                <i class="fas fa-circle-dot text-blue-600"></i> Status & Pekerjaan
            </h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">Status Saat Ini</span><p class="font-medium text-gray-800 capitalize">{{ str_replace('_', ' ', $tracer->status_saat_ini) ?? '-' }}</p></div>
                <div><span class="text-gray-500">Sumber Dana Kuliah</span><p class="font-medium text-gray-800">{{ $tracer->sumber_dana ?? '-' }}</p></div>

                @if($tracer->status_saat_ini == 'bekerja')
                <div><span class="text-gray-500">Nama Perusahaan</span><p class="font-medium text-gray-800">{{ $tracer->nama_perusahaan ?? '-' }}</p></div>
                <div><span class="text-gray-500">Posisi/Jabatan</span><p class="font-medium text-gray-800">{{ $tracer->posisi_jabatan ?? '-' }}</p></div>
                <div><span class="text-gray-500">Bidang Perusahaan</span><p class="font-medium text-gray-800">{{ $tracer->bidang_perusahaan ?? '-' }}</p></div>
                <div><span class="text-gray-500">Pendapatan/Bulan</span><p class="font-medium text-gray-800">Rp {{ number_format($tracer->pendapatan ?? 0, 0, ',', '.') }}</p></div>
                <div><span class="text-gray-500">Kota Kerja</span><p class="font-medium text-gray-800">{{ $tracer->kota_kerja ?? '-' }}, {{ $tracer->provinsi_kerja ?? '-' }}</p></div>
                <div><span class="text-gray-500">Kesesuaian Bidang</span><p class="font-medium text-gray-800">{{ $tracer->kesesuaian_bidang ?? '-' }}</p></div>
                @endif

                @if($tracer->status_saat_ini == 'wirausaha')
                <div><span class="text-gray-500">Jenis Usaha</span><p class="font-medium text-gray-800">{{ $tracer->jenis_usaha ?? '-' }}</p></div>
                <div><span class="text-gray-500">Posisi di Usaha</span><p class="font-medium text-gray-800">{{ $tracer->posisi_wirausaha ?? '-' }}</p></div>
                <div><span class="text-gray-500">Omzet/Bulan</span><p class="font-medium text-gray-800">Rp {{ number_format($tracer->omzet ?? 0, 0, ',', '.') }}</p></div>
                <div><span class="text-gray-500">Tingkat Usaha</span><p class="font-medium text-gray-800">{{ $tracer->tingkat_usaha ?? '-' }}</p></div>
                @endif

                @if($tracer->status_saat_ini == 'studi_lanjut')
                <div><span class="text-gray-500">Nama Kampus</span><p class="font-medium text-gray-800">{{ $tracer->nama_kampus_lanjut ?? '-' }}</p></div>
                <div><span class="text-gray-500">Program Studi Lanjut</span><p class="font-medium text-gray-800">{{ $tracer->prodi_lanjut ?? '-' }}</p></div>
                <div><span class="text-gray-500">Lokasi</span><p class="font-medium text-gray-800">{{ $tracer->kota_kampus_lanjut ?? '-' }}, {{ $tracer->negara_kampus_lanjut ?? '-' }}</p></div>
                <div><span class="text-gray-500">Sumber Biaya</span><p class="font-medium text-gray-800">{{ $tracer->biaya_studi_lanjut ?? '-' }}</p></div>
                @endif
            </div>
        </div>

        {{-- Kritik Saran --}}
        @if($tracer->saran_kuesioner || $tracer->saran_umb)
        <div class="bg-white rounded-xl shadow p-6 mb-5">
            <h2 class="font-bold text-gray-700 mb-4 pb-2 border-b flex items-center gap-2">
                <i class="fas fa-comment-dots text-blue-600"></i> Kritik & Saran
            </h2>
            <div class="space-y-3 text-sm">
                @if($tracer->saran_kuesioner)
                <div><span class="text-gray-500">Saran untuk Kuesioner</span><p class="text-gray-800 mt-1">{{ $tracer->saran_kuesioner }}</p></div>
                @endif
                @if($tracer->saran_umb)
                <div><span class="text-gray-500">Saran untuk UMB</span><p class="text-gray-800 mt-1">{{ $tracer->saran_umb }}</p></div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection