@extends('layouts.app')

@section('title', 'Login Admin')

@section('content')

<div class="min-h-screen bg-[#f5f7fb] flex items-center justify-center p-6">

    <div class="w-full max-w-6xl
                bg-white rounded-[36px]
                shadow-2xl border border-gray-200
                overflow-hidden grid lg:grid-cols-2">

        {{-- LEFT SIDE --}}
        <div class="relative hidden lg:flex flex-col justify-between
                    p-10 text-white overflow-hidden">

            {{-- BACKGROUND --}}
            <div class="absolute inset-0">
                <img src="{{ asset('images/admin-bg.jpg') }}"
                     alt="Background"
                     class="w-full h-full object-cover">
            </div>

            {{-- OVERLAY --}}
            <div class="absolute inset-0
                        bg-gradient-to-br
                        from-emerald-700/80
                        via-teal-700/70
                        to-emerald-900/80">
            </div>

            {{-- CONTENT --}}
            <div class="relative z-10">

                {{-- LOGO --}}
                <div class="flex items-center gap-4 mb-12">

                    <div class="w-16 h-16 rounded-2xl
                                bg-white/10 backdrop-blur-md
                                border border-white/20
                                flex items-center justify-center">

                        <img src="{{ asset('images/logo-kampus.png') }}"
                             alt="Logo"
                             class="w-9 h-9 object-contain">
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold">
                            Tracer Study
                        </h1>

                        <p class="text-sm text-emerald-100">
                            Universitas Mercu Buana
                        </p>
                    </div>
                </div>

                {{-- TEXT HERO --}}
                <div class="mt-16">

                    <div class="bg-white/10 backdrop-blur-md
                                border border-white/20
                                rounded-[40px]
                                px-10 py-14">

                        <h2 class="text-5xl
                                    font-bold
                                    leading-[1.2]
                                    text-center">
                            Admin<br>
                            Dashboard<br>
                            Access
                        </h2>
                    </div>
                </div>
            </div>

            {{-- FEATURE --}}
            <div class="relative z-10 space-y-4">

                <div class="bg-white/10 backdrop-blur-md
                            border border-white/10
                            rounded-[28px]
                            p-5">

                    <h3 class="font-semibold text-xl mb-1">
                        Alumni Management
                    </h3>

                    <p class="text-sm text-emerald-100">
                        Kelola data tracer study mahasiswa dan alumni.
                    </p>
                </div>

                <div class="bg-white/10 backdrop-blur-md
                            border border-white/10
                            rounded-[28px]
                            p-5">

                    <h3 class="font-semibold text-xl mb-1">
                        AI Analytics
                    </h3>

                    <p class="text-sm text-emerald-100">
                        Visualisasi dan clustering data alumni berbasis AI.
                    </p>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="flex items-center justify-center p-8 lg:p-14">

            <div class="w-full max-w-md">

                {{-- HEADER --}}
                <div class="text-center mb-10">

                    <h2 class="text-5xl font-bold
                               text-emerald-600 mb-3">

                        Welcome Back
                    </h2>

                    <p class="text-gray-500 text-sm">
                        Login sebagai administrator tracer study
                    </p>
                </div>

                {{-- BADGE --}}
                <div class="flex justify-center mb-8">

                    <div class="px-6 py-3 rounded-full
                                bg-emerald-100
                                text-emerald-700
                                font-semibold text-sm">

                        Portal Login Admin
                    </div>
                </div>

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="mb-6
                                bg-red-50 border border-red-200
                                text-red-600 text-sm
                                rounded-2xl p-4">

                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST"
                      action="{{ route('login') }}"
                      id="adminForm">

                    @csrf

                    {{-- EMAIL --}}
                    <div class="mb-5">

                        <label class="block text-xs font-semibold
                                     text-gray-500 uppercase
                                     tracking-wide mb-2">

                            Email Admin
                        </label>

                        <div class="relative">

                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Masukkan email admin"
                                   required
                                   class="w-full border border-gray-200
                                          rounded-2xl px-5 py-4 pr-12
                                          text-sm text-gray-800
                                          placeholder-gray-400
                                          focus:outline-none
                                          focus:ring-4
                                          focus:ring-emerald-500/10
                                          focus:border-emerald-400
                                          transition-all duration-300">

                            <div class="absolute right-4 top-1/2 -translate-y-1/2">

                                <svg class="w-5 h-5 text-gray-400"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M16 12H8m0 0l4-4m-4 4l4 4"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-6">

                        <div class="flex items-center justify-between mb-2">

                            <label class="block text-xs font-semibold
                                         text-gray-500 uppercase
                                         tracking-wide">

                                Password
                            </label>

                            <span class="text-xs text-gray-400">
                                Admin Only
                            </span>
                        </div>

                        <div class="relative">

                            <input type="password"
                                   name="password"
                                   id="adminPassword"
                                   placeholder="Masukkan password"
                                   required
                                   class="w-full border border-gray-200
                                          rounded-2xl px-5 py-4 pr-12
                                          text-sm text-gray-800
                                          placeholder-gray-400
                                          focus:outline-none
                                          focus:ring-4
                                          focus:ring-emerald-500/10
                                          focus:border-emerald-400
                                          transition-all duration-300">

                            <button type="button"
                                    onclick="togglePassword()"
                                    class="absolute right-4 top-1/2
                                           -translate-y-1/2
                                           text-gray-400
                                           hover:text-emerald-600
                                           transition">

                                <svg id="eyeIcon"
                                     class="w-5 h-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0
                                             3 3 0 016 0z"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M2.458 12C3.732 7.943
                                             7.523 5 12 5c4.478 0
                                             8.268 2.943 9.542 7
                                             -1.274 4.057-5.064 7
                                             -9.542 7-4.477 0
                                             -8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit"
                            class="w-full py-4 rounded-2xl
                                   text-white font-semibold text-lg
                                   shadow-lg shadow-emerald-500/20
                                   transition-all duration-300
                                   hover:scale-[1.01]
                                   active:scale-[0.99]"
                            style="background: linear-gradient(135deg, #10b981, #14b8a6);">

                        Login Admin
                    </button>
                </form>

                {{-- FOOTER --}}
                <div class="mt-8 text-center">

                    <a href="{{ route('mahasiswa.login') }}"
                       class="text-sm text-emerald-600
                              hover:text-emerald-700
                              font-medium transition">

                        Login sebagai Mahasiswa
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {

    const input = document.getElementById('adminPassword');

    if (input.type === 'password') {
        input.type = 'text';
    } else {
        input.type = 'password';
    }
}
</script>

@endsection