@extends('layouts.app')

@section('title', 'Login Mahasiswa - Tracer Study')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 via-blue-800 to-blue-600">
    <div class="w-full max-w-md px-6">

        {{-- Logo & Header --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4">
                <i class="fas fa-graduation-cap text-blue-700 text-4xl"></i>
            </div>
            <h1 class="text-white text-3xl font-bold">Tracer Study</h1>
            <p class="text-blue-200 mt-1">Portal Alumni Mahasiswa</p>
        </div>

        {{-- Card Login --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-gray-800 text-xl font-semibold mb-1">Selamat Datang!</h2>
            <p class="text-gray-500 text-sm mb-6">Masuk menggunakan akun SIA kamu</p>

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-5 text-sm flex items-center gap-2">
                    <i class="fas fa-circle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('mahasiswa.login') }}">
                @csrf

                {{-- NIM --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIM</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fas fa-id-card"></i>
                        </span>
                        <input
                            type="text"
                            name="nim"
                            value="{{ old('nim') }}"
                            placeholder="Masukkan NIM kamu"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                            required
                        />
                    </div>
                </div>

                {{-- Tanggal Lahir --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-gray-400 font-normal">(Tanggal Lahir format DDMMYYYY)</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fas fa-calendar"></i>
                        </span>
<input
    type="text"
    name="tanggal_lahir"
    placeholder="Contoh: 05101992"
    maxlength="8"
    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
    required
/>
                    </div>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2"
                >
                    <i class="fas fa-right-to-bracket"></i>
                    Masuk
                </button>
            </form>

            {{-- Link Admin --}}
            <div class="mt-6 text-center">
                <p class="text-gray-400 text-xs">
                    Login sebagai admin?
                    <a href="/login" class="text-blue-600 hover:underline font-medium">Klik di sini</a>
                </p>
            </div>
        </div>

        <p class="text-center text-blue-200 text-xs mt-6">
            © {{ date('Y') }} Tracer Study — Universitas
        </p>
    </div>
</div>
@endsection