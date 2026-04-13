@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa - Tracer Study')

@section('content')
<div class="min-h-screen bg-gray-100">

    {{-- Navbar --}}
    <nav class="bg-blue-800 text-white px-6 py-4 flex items-center justify-between shadow-lg">
        <div class="flex items-center gap-3">
            <i class="fas fa-graduation-cap text-xl"></i>
            <span class="font-bold text-lg">Tracer Study</span>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-blue-200 text-sm">{{ Auth::guard('mahasiswa')->user()->nama }}</span>
            <form method="POST" action="{{ route('mahasiswa.logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    <i class="fas fa-right-from-bracket mr-1"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    {{-- Content --}}
    <div class="p-8 max-w-3xl mx-auto">

        {{-- Welcome Card --}}
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <div class="flex items-center gap-4">
                <div class="bg-blue-100 text-blue-700 rounded-full w-16 h-16 flex items-center justify-center text-3xl">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">{{ Auth::guard('mahasiswa')->user()->nama }}</h1>
                    <p class="text-gray-500 text-sm">NIM: {{ Auth::guard('mahasiswa')->user()->nim }}</p>
                    <p class="text-gray-500 text-sm">{{ Auth::guard('mahasiswa')->user()->program_studi }}</p>
                </div>
            </div>
        </div>

        {{-- Status Pengisian --}}
        @php $tracer = Auth::guard('mahasiswa')->user()->tracerStudy; @endphp

        @if($tracer)
            {{-- Sudah mengisi --}}
            <div class="bg-green-50 border border-green-200 rounded-xl p-6 mb-6 flex items-center gap-4">
                <div class="bg-green-100 text-green-600 rounded-full w-12 h-12 flex items-center justify-center text-xl">
                    <i class="fas fa-circle-check"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-green-800">Kamu sudah mengisi form Tracer Study!</h3>
                    <p class="text-green-600 text-sm">Terima kasih atas partisipasimu.</p>
                </div>
            </div>
            <a href="{{ route('mahasiswa.tracer.edit') }}"
               class="block w-full text-center bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 rounded-xl transition">
                <i class="fas fa-pen mr-2"></i> Edit Jawaban
            </a>
        @else
            {{-- Belum mengisi --}}
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-6 flex items-center gap-4">
                <div class="bg-yellow-100 text-yellow-600 rounded-full w-12 h-12 flex items-center justify-center text-xl">
                    <i class="fas fa-circle-exclamation"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-yellow-800">Kamu belum mengisi form Tracer Study</h3>
                    <p class="text-yellow-600 text-sm">Mohon luangkan waktu untuk mengisi form berikut.</p>
                </div>
            </div>
            <a href="{{ route('mahasiswa.tracer.form') }}"
               class="block w-full text-center bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 rounded-xl transition">
                <i class="fas fa-file-pen mr-2"></i> Isi Form Tracer Study Sekarang
            </a>
        @endif
    </div>
</div>
@endsection