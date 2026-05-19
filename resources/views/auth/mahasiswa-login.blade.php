@extends('layouts.app')

@section('title', 'Login Mahasiswa')

@section('content')
<div class="min-h-screen bg-[#f3f4f6] flex items-center justify-center p-4">

    <div class="w-full max-w-7xl bg-white rounded-[28px] shadow-2xl overflow-hidden border border-gray-200">

        <div class="grid lg:grid-cols-2 min-h-[750px]">

            {{-- LEFT SIDE --}}
            <div class="relative hidden lg:block overflow-hidden">

                {{-- BACKGROUND IMAGE --}}
                <div class="absolute inset-0">

                    {{-- GANTI GAMBAR DARI LU --}}
                    <img src="{{ asset('images/login-bg.jpg') }}"
                         class="w-full h-full object-cover">

                    <div class="absolute inset-0 bg-gradient-to-br
                                from-blue-950/80
                                via-black/40
                                to-indigo-950/70">
                    </div>
                </div>

                {{-- CONTENT --}}
                <div class="relative z-10 h-full flex flex-col justify-between p-12">

                    {{-- TOP --}}
                    <div class="flex items-start justify-between">

                        {{-- LOGO AREA --}}
                        <div class="flex items-center gap-4">

                            <div class="w-16 h-16 rounded-2xl
                                        bg-white/15 backdrop-blur-md
                                        border border-white/20
                                        flex items-center justify-center p-2">

                                {{-- LOGO KAMPUS --}}
                                <img src="{{ asset('images/logo-kampus.png') }}"
                                     alt="Logo Kampus"
                                     class="w-full h-full object-contain">
                            </div>

                            <div>
                                <h2 class="text-white font-bold text-2xl">
                                    Tracer Study
                                </h2>

                                <p class="text-white/70 text-sm">
                                    Universitas Mercu Buana
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- CENTER TEXT --}}
                    <div class="flex justify-center">

                        <div class="backdrop-blur-xl
                                    bg-white/10
                                    border border-white/20
                                    rounded-[40px]
                                    px-14 py-10
                                    shadow-2xl">

                            <h1 class="text-white text-6xl font-bold
                                       text-center leading-tight">

                                Make your dream <br>
                                come true
                            </h1>
                        </div>
                    </div>

                    {{-- FEATURES --}}
                    <div class="space-y-4">

                        {{-- CARD 1 --}}
                        <div class="bg-white/10
                                    backdrop-blur-xl
                                    rounded-3xl
                                    border border-white/10
                                    p-5">

                            <div class="flex items-start gap-4">

                                <div class="w-14 h-14 rounded-2xl
                                            bg-white flex items-center justify-center">

                                    <svg class="w-7 h-7 text-blue-500"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>

                                <div>
                                    <h3 class="text-white font-semibold text-xl mb-1">
                                        AI Career Analytics
                                    </h3>

                                    <p class="text-white/70 text-sm">
                                        Analisis pola karier alumni berbasis AI dan Machine Learning
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- CARD 2 --}}
                        <div class="bg-white/10
                                    backdrop-blur-xl
                                    rounded-3xl
                                    border border-white/10
                                    p-5">

                            <div class="flex items-start gap-4">

                                <div class="w-14 h-14 rounded-2xl
                                            bg-white flex items-center justify-center">

                                    <svg class="w-7 h-7 text-indigo-500"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M17 20h5V4H2v16h5m10 0v-5a3 3 0 00-6 0v5m6 0H7"/>
                                    </svg>
                                </div>

                                <div>
                                    <h3 class="text-white font-semibold text-xl mb-1">
                                        Smart Alumni Tracking
                                    </h3>

                                    <p class="text-white/70 text-sm">
                                        Monitoring perjalanan alumni secara real-time
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="flex items-center justify-center
                        bg-[#fafafa]
                        px-6 py-10 lg:px-16">

                <div class="w-full max-w-md">

                    {{-- MOBILE LOGO --}}
                    <div class="lg:hidden flex justify-center mb-8">

                        <div class="text-center">

                            <img src="{{ asset('images/logo-kampus.png') }}"
                                 class="w-20 h-20 object-contain mx-auto mb-3">

                            <h1 class="text-3xl font-bold text-blue-600">
                                Tracer Study
                            </h1>

                            <p class="text-gray-500 text-sm">
                                Universitas Mercu Buana
                            </p>
                        </div>
                    </div>

                    {{-- HEADER --}}
                    <div class="text-center mb-8">

                        <h2 class="text-5xl font-bold text-[#2563eb] mb-3">
                            Welcome Back
                        </h2>

                        <p class="text-gray-500">
                            Login menggunakan NIM dan tanggal lahir
                        </p>
                    </div>

                    {{-- LOGIN BADGE --}}
                    <div class="mb-8 flex justify-center">

                        <div class="px-6 py-3 rounded-full
                                    bg-blue-100
                                    text-blue-600
                                    font-semibold text-sm">

                            Portal Login Mahasiswa
                        </div>
                    </div>

                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="mb-6
                                    bg-red-50
                                    border border-red-200
                                    text-red-500
                                    rounded-2xl
                                    px-4 py-3 text-sm">

                            {{ $errors->first() }}
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form method="POST"
                          action="{{ route('mahasiswa.login') }}"
                          id="loginForm"
                          class="space-y-5">

                        @csrf

                        {{-- NIM --}}
                        <div>

                            <label class="block text-sm
                                         font-semibold
                                         text-gray-700 mb-2">

                                NIM
                            </label>

                            <div class="relative">

                                <input type="text"
                                       name="nim"
                                       value="{{ old('nim') }}"
                                       placeholder="Masukkan NIM"
                                       required
                                       class="w-full h-14
                                              px-5 pr-12
                                              rounded-2xl
                                              border border-gray-300
                                              bg-white
                                              focus:outline-none
                                              focus:ring-2
                                              focus:ring-blue-500
                                              focus:border-transparent
                                              transition">

                                <div class="absolute right-5 top-1/2 -translate-y-1/2">

                                    <svg class="w-5 h-5 text-gray-400"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M5.121 17.804A13.937
                                                 13.937 0 0112 16
                                                 c2.5 0 4.847.655
                                                 6.879 1.804M15 10
                                                 a3 3 0 11-6 0
                                                 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- PASSWORD --}}
                        <div>

                            <div class="flex items-center justify-between mb-2">

                                <label class="text-sm
                                             font-semibold
                                             text-gray-700">

                                    Password
                                </label>

                                <span class="text-xs text-gray-400">
                                    Format DDMMYYYY
                                </span>
                            </div>

                            <div class="relative">

                                <input type="password"
                                       name="tanggal_lahir"
                                       id="passwordInput"
                                       maxlength="8"
                                       placeholder="Contoh: 05101992"
                                       required
                                       class="w-full h-14
                                              px-5 pr-14
                                              rounded-2xl
                                              border border-gray-300
                                              bg-white
                                              focus:outline-none
                                              focus:ring-2
                                              focus:ring-blue-500
                                              focus:border-transparent
                                              transition">

                                {{-- TOGGLE PASSWORD --}}
                                <button type="button"
                                        onclick="togglePassword()"
                                        class="absolute right-5 top-1/2
                                               -translate-y-1/2
                                               text-gray-400
                                               hover:text-blue-500
                                               transition">

                                    <svg id="eyeIcon"
                                         xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0
                                                 3 3 0 016 0z"/>

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M2.458 12C3.732 7.943
                                                 7.523 5 12 5
                                                 c4.478 0 8.268 2.943
                                                 9.542 7-1.274 4.057
                                                 -5.064 7-9.542 7
                                                 -4.477 0-8.268-2.943
                                                 -9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- CAPTCHA STYLE --}}
                        <div class="bg-white
                                    border border-gray-300
                                    rounded-2xl
                                    p-4 w-fit">

                            <div class="flex items-center gap-3">

                                <input type="checkbox"
                                       class="w-5 h-5 rounded border-gray-300">

                                <span class="text-sm text-gray-600">
                                    I am human
                                </span>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <button type="submit"
                                id="submitBtn"
                                class="w-full h-14
                                       rounded-2xl
                                       bg-gradient-to-r
                                       from-blue-600
                                       to-indigo-600
                                       text-white
                                       font-semibold
                                       text-lg
                                       hover:scale-[1.01]
                                       active:scale-[0.99]
                                       transition-all duration-300
                                       shadow-lg shadow-blue-500/20">

                            <span id="btnText">
                                Sign In
                            </span>
                        </button>

                    </form>

                    {{-- FOOTER --}}
                    <div class="mt-8 text-center">

                        <a href="{{ route('login') }}"
                           class="text-blue-600 font-medium hover:underline">

                            Login sebagai Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {

    const input = document.getElementById('passwordInput');
    const icon = document.getElementById('eyeIcon');

    if (input.type === 'password') {

        input.type = 'text';
        icon.classList.add('text-blue-500');

    } else {

        input.type = 'password';
        icon.classList.remove('text-blue-500');
    }
}

document.getElementById('loginForm').addEventListener('submit', function () {

    const btn = document.getElementById('submitBtn');
    const txt = document.getElementById('btnText');

    btn.disabled = true;

    txt.innerHTML = `
        <div class="flex items-center justify-center gap-2">
            <svg class="animate-spin h-5 w-5"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24">

                <circle class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4">
                </circle>

                <path class="opacity-75"
                      fill="currentColor"
                      d="M4 12a8 8 0 018-8V0
                         C5.373 0 0 5.373 0 12h4z">
                </path>
            </svg>

            Memverifikasi...
        </div>
    `;
});
</script>
@endsection