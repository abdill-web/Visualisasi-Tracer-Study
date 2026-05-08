@extends('layouts.app')

@section('title', 'Admin Login - Tracer Study')

@section('content')
<div class="min-h-screen bg-[#0a0a0f] flex overflow-hidden relative">

    {{-- GRID BACKGROUND --}}
    <div class="absolute inset-0 opacity-[0.03]"
         style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px);
                background-size: 40px 40px;"></div>

    {{-- GLOW ORBS — warna berbeda dari mahasiswa (emerald/teal) --}}
    <div class="absolute top-[-200px] right-[-200px] w-[600px] h-[600px] rounded-full"
         style="background: radial-gradient(circle, rgba(16,185,129,0.12) 0%, transparent 70%);"></div>
    <div class="absolute bottom-[-200px] left-[-100px] w-[500px] h-[500px] rounded-full"
         style="background: radial-gradient(circle, rgba(20,184,166,0.10) 0%, transparent 70%);"></div>

    {{-- LEFT PANEL --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 order-2 lg:order-1">
        <div class="w-full max-w-md" id="loginCard">

            {{-- BADGE --}}
            <div class="inline-flex items-center gap-2 mb-8 px-3 py-1.5 rounded-full border border-emerald-500/30 bg-emerald-500/10">
                <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <span class="text-emerald-400 text-xs font-medium tracking-widest uppercase">Admin Access</span>
            </div>

            {{-- HEADER --}}
            <div class="mb-10">
                <h2 class="text-3xl font-bold text-white mb-2">Panel Administrator</h2>
                <p class="text-gray-500 text-sm">Masuk untuk mengelola data tracer study</p>
            </div>

            {{-- ERROR --}}
            @if ($errors->any())
            <div class="mb-6 flex items-start gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20">
                <svg class="w-4 h-4 text-red-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-red-400 text-sm">{{ $errors->first() }}</p>
            </div>
            @endif

            {{-- FORM --}}
            <form method="POST" action="{{ route('login') }}" id="adminForm">
                @csrf

                {{-- EMAIL --}}
                <div class="mb-5">
                    <label class="block text-xs font-medium text-gray-400 mb-2 tracking-wide uppercase">
                        Email Administrator
                    </label>
                    <div class="relative group">
                        <input type="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="admin@tracerstudy.com"
                               class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3.5
                                      text-white text-sm placeholder-gray-600
                                      focus:outline-none focus:border-emerald-500/60 focus:bg-white/[0.05]
                                      transition-all duration-300"
                               required/>
                        <div class="absolute inset-0 rounded-xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300 pointer-events-none"
                             style="box-shadow: 0 0 0 1px rgba(16,185,129,0.4), 0 0 20px rgba(16,185,129,0.08);"></div>
                    </div>
                </div>

                {{-- PASSWORD --}}
                <div class="mb-8">
                    <label class="block text-xs font-medium text-gray-400 mb-2 tracking-wide uppercase">
                        Password
                    </label>
                    <div class="relative group">
                        <input type="password" name="password"
                               id="adminPasswordInput"
                               placeholder="••••••••"
                               class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3.5
                                      text-white text-sm placeholder-gray-600
                                      focus:outline-none focus:border-emerald-500/60 focus:bg-white/[0.05]
                                      transition-all duration-300 pr-12"
                               required/>
                        <button type="button" onclick="toggleAdminPassword()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 hover:text-gray-400 transition">
                            <svg id="adminEyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                        <div class="absolute inset-0 rounded-xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300 pointer-events-none"
                             style="box-shadow: 0 0 0 1px rgba(16,185,129,0.4), 0 0 20px rgba(16,185,129,0.08);"></div>
                    </div>
                </div>

                {{-- SUBMIT --}}
                <button type="submit" id="adminSubmitBtn"
                        class="w-full relative overflow-hidden rounded-xl py-3.5 font-semibold text-sm text-white
                               transition-all duration-300 hover:scale-[1.01] active:scale-[0.99]"
                        style="background: linear-gradient(135deg, #10b981, #0d9488);">
                    <span id="adminBtnText" class="relative z-10 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Masuk ke Panel Admin
                    </span>
                </button>
            </form>

            {{-- FOOTER --}}
            <div class="mt-8 pt-6 border-t border-white/5 flex items-center justify-between">
                <p class="text-xs text-gray-600">Bukan admin?</p>
                <a href="{{ route('mahasiswa.login') }}" class="text-xs text-emerald-400 hover:text-emerald-300 transition flex items-center gap-1">
                    Login Mahasiswa
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <p class="text-center text-xs text-gray-700 mt-6">© {{ date('Y') }} Universitas Mercu Buana</p>
        </div>
    </div>

    {{-- DIVIDER --}}
    <div class="hidden lg:block w-px bg-gradient-to-b from-transparent via-white/10 to-transparent my-16 order-2"></div>

    {{-- RIGHT PANEL --}}
    <div class="hidden lg:flex w-1/2 flex-col justify-between p-16 relative order-3">

        {{-- TOP: Logo --}}
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-kampus.png') }}" class="h-10 object-contain">
        </div>

        {{-- MIDDLE --}}
        <div>
            <div class="inline-flex items-center gap-2 mb-6 px-3 py-1.5 rounded-full border border-emerald-500/30 bg-emerald-500/10">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-emerald-400 text-xs font-medium tracking-widest uppercase">Management System</span>
            </div>

            <h1 class="text-5xl font-bold text-white leading-[1.15] mb-6">
                Kelola Data<br>
                <span class="text-emerald-400">Alumni UMB.</span>
            </h1>

            <p class="text-gray-500 text-base leading-relaxed max-w-sm mb-10">
                Pantau, analisis, dan visualisasikan data tracer study alumni
                secara real-time dengan teknologi AI dan machine learning.
            </p>

            {{-- ADMIN FEATURES --}}
            <div class="grid grid-cols-2 gap-3">
                <div class="px-4 py-4 rounded-xl bg-white/[0.03] border border-white/[0.06]">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center mb-3">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <p class="text-white text-xs font-semibold">Kelola Mahasiswa</p>
                    <p class="text-gray-600 text-xs mt-0.5">Import & manajemen data</p>
                </div>
                <div class="px-4 py-4 rounded-xl bg-white/[0.03] border border-white/[0.06]">
                    <div class="w-8 h-8 rounded-lg bg-teal-500/20 flex items-center justify-center mb-3">
                        <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <p class="text-white text-xs font-semibold">Visualisasi AI</p>
                    <p class="text-gray-600 text-xs mt-0.5">Analisis pola karir</p>
                </div>
                <div class="px-4 py-4 rounded-xl bg-white/[0.03] border border-white/[0.06]">
                    <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center mb-3">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <p class="text-white text-xs font-semibold">Data Tracer</p>
                    <p class="text-gray-600 text-xs mt-0.5">Lihat semua pengisian</p>
                </div>
                <div class="px-4 py-4 rounded-xl bg-white/[0.03] border border-white/[0.06]">
                    <div class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center mb-3">
                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <p class="text-white text-xs font-semibold">Clustering ML</p>
                    <p class="text-gray-600 text-xs mt-0.5">Hasil model prediksi</p>
                </div>
            </div>
        </div>

        {{-- BOTTOM --}}
        <p class="text-gray-700 text-xs">© {{ date('Y') }} Universitas Mercu Buana</p>
    </div>
</div>

<script>
function toggleAdminPassword() {
    const input = document.getElementById('adminPasswordInput');
    const icon = document.getElementById('adminEyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.style.opacity = '0.4';
    } else {
        input.type = 'password';
        icon.style.opacity = '1';
    }
}

document.getElementById('adminForm').addEventListener('submit', function() {
    const btn = document.getElementById('adminSubmitBtn');
    const txt = document.getElementById('adminBtnText');
    btn.disabled = true;
    txt.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
    </svg> Memverifikasi...`;
});

window.addEventListener('load', () => {
    const card = document.getElementById('loginCard');
    card.style.opacity = '0';
    card.style.transform = 'translateY(24px)';
    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    setTimeout(() => {
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
    }, 100);
});
</script>
@endsection