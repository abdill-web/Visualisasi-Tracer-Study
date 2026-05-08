@extends('layouts.app')

@section('title', 'Login - Tracer Study')

@section('content')
<div class="min-h-screen bg-[#0a0a0f] flex overflow-hidden relative">

    {{-- GRID BACKGROUND --}}
    <div class="absolute inset-0 opacity-[0.03]"
         style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px);
                background-size: 40px 40px;"></div>

    {{-- GLOW ORBS --}}
    <div class="absolute top-[-200px] left-[-200px] w-[600px] h-[600px] rounded-full"
         style="background: radial-gradient(circle, rgba(59,130,246,0.15) 0%, transparent 70%);"></div>
    <div class="absolute bottom-[-200px] right-[-100px] w-[500px] h-[500px] rounded-full"
         style="background: radial-gradient(circle, rgba(99,102,241,0.12) 0%, transparent 70%);"></div>

    {{-- LEFT PANEL --}}
    <div class="hidden lg:flex w-1/2 flex-col justify-between p-16 relative">

        {{-- TOP: Logo --}}
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-kampus.png') }}" class="h-10 object-contain">
        </div>

        {{-- MIDDLE --}}
        <div>
            <div class="inline-flex items-center gap-2 mb-6 px-3 py-1.5 rounded-full border border-blue-500/30 bg-blue-500/10">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                <span class="text-blue-400 text-xs font-medium tracking-widest uppercase">Alumni Portal</span>
            </div>

            <h1 class="text-5xl font-bold text-white leading-[1.15] mb-6">
                Jejak Karier<br>
                <span id="typedText" class="text-blue-400"></span>
            </h1>

            <p class="text-gray-500 text-base leading-relaxed max-w-sm mb-10">
                Pantau perjalanan profesional alumni dan kontribusi nyata
                dalam ekosistem industri yang terus berkembang.
            </p>

            {{-- FEATURE CARDS --}}
            <div class="flex flex-col gap-3">
                <div class="flex items-center gap-4 px-4 py-3.5 rounded-xl bg-white/[0.03] border border-white/[0.06]">
                    <div class="w-9 h-9 rounded-lg bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white text-sm font-medium">Isi Kuesioner Online</p>
                        <p class="text-gray-600 text-xs mt-0.5">Form tracer study mudah dan cepat diisi</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 px-4 py-3.5 rounded-xl bg-white/[0.03] border border-white/[0.06]">
                    <div class="w-9 h-9 rounded-lg bg-indigo-500/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white text-sm font-medium">Visualisasi Pola Karir</p>
                        <p class="text-gray-600 text-xs mt-0.5">Analisis data alumni berbasis AI & ML</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 px-4 py-3.5 rounded-xl bg-white/[0.03] border border-white/[0.06]">
                    <div class="w-9 h-9 rounded-lg bg-purple-500/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white text-sm font-medium">Data Alumni Terintegrasi</p>
                        <p class="text-gray-600 text-xs mt-0.5">Terhubung langsung dengan sistem SIA kampus</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- BOTTOM --}}
        <p class="text-gray-700 text-xs">© {{ date('Y') }} Universitas Mercu Buana</p>
    </div>

    {{-- DIVIDER --}}
    <div class="hidden lg:block w-px bg-gradient-to-b from-transparent via-white/10 to-transparent my-16"></div>

    {{-- RIGHT PANEL --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md" id="loginCard">

            {{-- HEADER --}}
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-white mb-2">Masuk ke Akun</h2>
                <p class="text-gray-500 text-sm">Gunakan NIM dan tanggal lahir kamu</p>
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
            <form method="POST" action="{{ route('mahasiswa.login') }}" id="loginForm">
                @csrf

                {{-- NIM --}}
                <div class="mb-5">
                    <label class="block text-xs font-medium text-gray-400 mb-2 tracking-wide uppercase">
                        Nomor Induk Mahasiswa
                    </label>
                    <div class="relative group">
                        <input type="text" name="nim"
                               value="{{ old('nim') }}"
                               placeholder="Masukkan NIM kamu"
                               class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3.5
                                      text-white text-sm placeholder-gray-600
                                      focus:outline-none focus:border-blue-500/60 focus:bg-white/[0.05]
                                      transition-all duration-300"
                               required/>
                        <div class="absolute inset-0 rounded-xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300 pointer-events-none"
                             style="box-shadow: 0 0 0 1px rgba(59,130,246,0.4), 0 0 20px rgba(59,130,246,0.1);"></div>
                    </div>
                </div>

                {{-- PASSWORD --}}
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-xs font-medium text-gray-400 tracking-wide uppercase">Password</label>
                        <span class="text-xs text-gray-600 font-mono bg-white/5 px-2 py-0.5 rounded">DDMMYYYY</span>
                    </div>
                    <div class="relative group">
                        <input type="password" name="tanggal_lahir"
                               id="passwordInput"
                               maxlength="8"
                               placeholder="Tanggal lahir kamu"
                               class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3.5
                                      text-white text-sm placeholder-gray-600
                                      focus:outline-none focus:border-blue-500/60 focus:bg-white/[0.05]
                                      transition-all duration-300 pr-12"
                               required/>
                        <button type="button" onclick="togglePassword()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 hover:text-gray-400 transition">
                            <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                        <div class="absolute inset-0 rounded-xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300 pointer-events-none"
                             style="box-shadow: 0 0 0 1px rgba(59,130,246,0.4), 0 0 20px rgba(59,130,246,0.1);"></div>
                    </div>
                    <p class="text-xs text-gray-600 mt-2">
                        Contoh: lahir 5 Oktober 1992 →
                        <span class="font-mono text-gray-500">05101992</span>
                    </p>
                </div>

                {{-- SUBMIT --}}
                <button type="submit" id="submitBtn"
                        class="w-full relative overflow-hidden rounded-xl py-3.5 font-semibold text-sm text-white
                               transition-all duration-300 hover:scale-[1.01] active:scale-[0.99]"
                        style="background: linear-gradient(135deg, #3b82f6, #6366f1);">
                    <span id="btnText" class="relative z-10 flex items-center justify-center gap-2">
                        Masuk Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </span>
                </button>
            </form>

            {{-- FOOTER --}}
            <div class="mt-8 pt-6 border-t border-white/5 flex items-center justify-between">
                <p class="text-xs text-gray-600">Login sebagai admin?</p>
                <a href="{{ route('login') }}" class="text-xs text-blue-400 hover:text-blue-300 transition flex items-center gap-1">
                    Admin Panel
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            {{-- MOBILE FOOTER --}}
            <p class="lg:hidden text-center text-xs text-gray-700 mt-6">© {{ date('Y') }} Universitas Mercu Buana</p>
        </div>
    </div>
</div>

<script>
// Typing animation
const words = ['Dimulai Di Sini.', 'Tercatat Bersama.', 'Menginspirasi.'];
let wordIndex = 0, charIndex = 0, isDeleting = false;
const typedEl = document.getElementById('typedText');

function type() {
    if (!typedEl) return;
    const current = words[wordIndex];
    if (isDeleting) {
        typedEl.textContent = current.substring(0, charIndex--);
        if (charIndex < 0) {
            isDeleting = false;
            wordIndex = (wordIndex + 1) % words.length;
            setTimeout(type, 500);
            return;
        }
    } else {
        typedEl.textContent = current.substring(0, charIndex++);
        if (charIndex > current.length) {
            isDeleting = true;
            setTimeout(type, 2000);
            return;
        }
    }
    setTimeout(type, isDeleting ? 60 : 100);
}
setTimeout(type, 1000);

// Toggle password visibility
function togglePassword() {
    const input = document.getElementById('passwordInput');
    const icon = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.style.opacity = '0.4';
    } else {
        input.type = 'password';
        icon.style.opacity = '1';
    }
}

// Loading state on submit
document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    const txt = document.getElementById('btnText');
    btn.disabled = true;
    txt.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
    </svg> Memverifikasi...`;
});

// Entrance animation
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