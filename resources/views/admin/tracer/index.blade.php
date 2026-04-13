@extends('layouts.app')

@section('title', 'Data Tracer Study')

@section('content')
<div class="min-h-screen bg-gray-100">
    <nav class="bg-gray-900 text-white px-6 py-4 flex items-center justify-between shadow-lg">
        <div class="flex items-center gap-3">
            <i class="fas fa-shield-halved text-xl"></i>
            <span class="font-bold text-lg">Tracer Study — Admin Panel</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-white text-sm">
                <i class="fas fa-house mr-1"></i> Dashboard
            </a>
            <span class="text-gray-300 text-sm">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    <i class="fas fa-right-from-bracket mr-1"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="p-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Data Tracer Study</h1>
                <p class="text-gray-500 text-sm">Total {{ $sudahIsi }} mahasiswa sudah mengisi</p>
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow p-4 flex items-center gap-3">
                <div class="bg-green-100 text-green-600 rounded-full w-10 h-10 flex items-center justify-center">
                    <i class="fas fa-check"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Sudah Mengisi</p>
                    <p class="font-bold text-gray-800">{{ $sudahIsi }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-4 flex items-center gap-3">
                <div class="bg-yellow-100 text-yellow-600 rounded-full w-10 h-10 flex items-center justify-center">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Belum Mengisi</p>
                    <p class="font-bold text-gray-800">{{ $belumIsi }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-4 flex items-center gap-3">
                <div class="bg-purple-100 text-purple-600 rounded-full w-10 h-10 flex items-center justify-center">
                    <i class="fas fa-percent"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Response Rate</p>
                    <p class="font-bold text-gray-800">{{ $responseRate }}%</p>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="text-left px-6 py-3 text-gray-600 font-semibold">Nama</th>
                        <th class="text-left px-6 py-3 text-gray-600 font-semibold">NIM</th>
                        <th class="text-left px-6 py-3 text-gray-600 font-semibold">Program Studi</th>
                        <th class="text-left px-6 py-3 text-gray-600 font-semibold">Status</th>
                        <th class="text-left px-6 py-3 text-gray-600 font-semibold">Perusahaan/Usaha</th>
                        <th class="text-left px-6 py-3 text-gray-600 font-semibold">Tanggal Isi</th>
                        <th class="text-left px-6 py-3 text-gray-600 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($data as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $item->mahasiswa->nama }}</td>
                        <td class="px-6 py-4 font-mono text-gray-600">{{ $item->mahasiswa->nim }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $item->mahasiswa->program_studi }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusLabel = [
                                    'bekerja' => ['label' => 'Bekerja', 'class' => 'bg-green-100 text-green-700'],
                                    'wirausaha' => ['label' => 'Wirausaha', 'class' => 'bg-orange-100 text-orange-700'],
                                    'studi_lanjut' => ['label' => 'Studi Lanjut', 'class' => 'bg-purple-100 text-purple-700'],
                                    'tidak_bekerja' => ['label' => 'Tidak Bekerja', 'class' => 'bg-red-100 text-red-700'],
                                    'belum_bekerja' => ['label' => 'Belum Bekerja', 'class' => 'bg-gray-100 text-gray-700'],
                                ];
                                $s = $statusLabel[$item->status_saat_ini] ?? ['label' => $item->status_saat_ini, 'class' => 'bg-gray-100 text-gray-700'];
                            @endphp
                            <span class="text-xs px-3 py-1 rounded-full font-medium {{ $s['class'] }}">{{ $s['label'] }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $item->nama_perusahaan ?? $item->nama_usaha ?? $item->nama_kampus_lanjut ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-xs">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.tracer.show', $item->id) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1.5 rounded-lg transition">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <i class="fas fa-file-circle-xmark text-4xl mb-3 block"></i>
                            Belum ada data tracer study yang masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
@endsection