@extends('layouts.app')

@section('title', 'Login Admin - Tracer Study')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700">
    <div class="w-full max-w-md px-6">

        {{-- Logo & Header --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4">
                <i class="fas fa-shield-halved text-gray-700 text-4xl"></i>
            </div>
            <h1 class="text-white text-3xl font-bold">Admin Panel</h1>
            <p class="text-gray-400 mt-1">Tracer Study Management</p>
        </div>

        {{-- Card Login --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-gray-800 text-xl font-semibold mb-1">Login Administrator</h2>
            <p class="text-gray-500 text-sm mb-6">Masuk dengan akun admin kamu</p>

            {{-- Error --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-5 text-sm flex items-center gap-2">
                    <i class="fas fa-circle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@tracerstudy.com"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent text-sm"
                            required
                        />
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent text-sm"
                            required
                        />
                    </div>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full bg-gray-800 hover:bg-gray-900 text-white font-semibold py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2"
                >
                    <i class="fas fa-right-to-bracket"></i>
                    Masuk sebagai Admin
                </button>
            </form>

            {{-- Link Mahasiswa --}}
            <div class="mt-6 text-center">
                <p class="text-gray-400 text-xs">
                    Login sebagai mahasiswa?
                    <a href="{{ route('mahasiswa.login') }}" class="text-blue-600 hover:underline font-medium">Klik di sini</a>
                </p>
            </div>
        </div>

        <p class="text-center text-gray-500 text-xs mt-6">
            © {{ date('Y') }} Tracer Study — Universitas
        </p>
    </div>
</div>
@endsection