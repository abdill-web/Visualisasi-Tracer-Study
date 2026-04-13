@extends('layouts.app')

@section('title', 'Data Mahasiswa')

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
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Data Mahasiswa</h1>
                <p class="text-gray-500 text-sm">Total {{ $total }} mahasiswa terdaftar</p>
            </div>
            <a href="{{ route('admin.mahasiswa.import') }}"
               class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2.5 rounded-lg text-sm font-medium flex items-center gap-2 transition">
                <i class="fas fa-upload"></i> Import CSV
            </a>
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

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 mb-4 text-sm">
                <i class="fas fa-circle-check mr-1"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="text-left px-6 py-3 text-gray-600 font-semibold">NIM</th>
                        <th class="text-left px-6 py-3 text-gray-600 font-semibold">Nama</th>
                        <th class="text-left px-6 py-3 text-gray-600 font-semibold">Program Studi</th>
                        <th class="text-left px-6 py-3 text-gray-600 font-semibold">Tahun Lulus</th>
                        <th class="text-left px-6 py-3 text-gray-600 font-semibold">Status</th>
                        <th class="text-left px-6 py-3 text-gray-600 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($mahasiswa as $mhs)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-mono text-gray-700">{{ $mhs->nim }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $mhs->nama }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $mhs->program_studi }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $mhs->tahun_lulus ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if($mhs->tracer_study_count > 0)
                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-medium">Sudah Mengisi</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full font-medium">Belum Mengisi</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}"
                                  onsubmit="return confirm('Hapus data mahasiswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <i class="fas fa-users text-4xl mb-3 block"></i>
                            Belum ada data mahasiswa. <a href="{{ route('admin.mahasiswa.import') }}" class="text-blue-600 hover:underline">Import CSV sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t">
                {{ $mahasiswa->links() }}
            </div>
        </div>
    </div>
</div>
@endsection