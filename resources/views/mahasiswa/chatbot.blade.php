@extends('layouts.app')

@section('title', 'Chatbot - Tracer Study')

@section('content')
<div class="min-h-screen bg-[#0f1117] flex flex-col">

    {{-- NAVBAR --}}
    <nav class="bg-[#0a0a0f]/80 backdrop-blur-xl border-b border-white/5 px-8 py-4 flex items-center justify-between sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-blue-500/20 border border-blue-500/30 flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                </svg>
            </div>
            <a href="{{ route('mahasiswa.dashboard') }}" class="text-gray-500 text-sm hover:text-gray-300 transition">Dashboard</a>
            <span class="text-gray-700">/</span>
            <span class="text-gray-300 text-sm">AI Chatbot</span>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-gray-500 text-sm">{{ Auth::guard('mahasiswa')->user()->nama }}</span>
            <a href="{{ route('mahasiswa.dashboard') }}"
               class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5 border border-white/10 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </nav>

    {{-- CHAT AREA --}}
    <div class="flex-1 flex flex-col max-w-3xl mx-auto w-full px-4 py-6">

        {{-- HEADER --}}
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-blue-500/20 border border-blue-500/30 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white">AI Career Assistant</h1>
            <p class="text-gray-500 text-sm mt-1">Tanyakan apa saja seputar karir dan tracer study alumni UMB</p>
        </div>

{{-- SUGGESTED QUESTIONS --}}
<div id="suggestions" class="mb-6">
    {{-- Rekomendasi Karir Card --}}
    <div class="bg-gradient-to-r from-blue-500/10 to-indigo-500/10 border border-blue-500/20 rounded-2xl p-5 mb-4">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-xl bg-blue-500/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
            </div>
            <div>
                <p class="text-white text-sm font-semibold">Rekomendasi Karir Personal</p>
                <p class="text-gray-500 text-xs">Dapatkan rekomendasi karir yang sesuai dengan profil kamu</p>
            </div>
        </div>
        <button onclick="getCareerRecommendation()"
                class="w-full py-2.5 rounded-xl text-sm font-medium text-white transition-all duration-300 hover:scale-[1.01]"
                style="background: linear-gradient(135deg, #3b82f6, #6366f1);">
            ✨ Analisis Karir Saya Sekarang
        </button>
    </div>

    {{-- Quick Questions --}}
    <div class="grid grid-cols-2 gap-3">
        @foreach([
            'Bidang pekerjaan apa yang paling banyak diminati alumni UMB?',
            'Berapa rata-rata pendapatan alumni UMB per bulan?',
            'Tips apa untuk cepat mendapat pekerjaan setelah lulus?',
            'Ada lowongan kerja yang sesuai untuk saya?',
        ] as $q)
        <button onclick="sendSuggestion('{{ $q }}')"
                class="text-left px-4 py-3 bg-white/[0.03] border border-white/[0.08] rounded-xl text-sm text-gray-400 hover:text-white hover:bg-white/[0.06] hover:border-blue-500/30 transition">
            {{ $q }}
        </button>
        @endforeach
    </div>
</div>

        {{-- MESSAGES --}}
        <div id="chatMessages" class="flex-1 flex flex-col gap-4 mb-6 min-h-[200px]"></div>

        {{-- INPUT AREA --}}
        <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-4">
            <div class="flex items-end gap-3">
                <textarea id="userInput"
                          placeholder="Tanyakan seputar karir, pekerjaan, atau tracer study alumni UMB..."
                          rows="1"
                          class="flex-1 bg-transparent text-white text-sm placeholder-gray-600 resize-none focus:outline-none leading-relaxed"
                          onkeydown="handleKeydown(event)"
                          oninput="autoResize(this)"></textarea>
                <button onclick="sendMessage()"
                        id="sendBtn"
                        class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-all duration-300"
                        style="background: linear-gradient(135deg, #3b82f6, #6366f1);">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </div>
        </div>

        <p class="text-center text-xs text-gray-700 mt-3">AI dapat membuat kesalahan. Verifikasi informasi penting secara mandiri.</p>
    </div>
</div>

<script>
let chatHistory = [];

function autoResize(el) {
    el.style.height = 'auto';
    el.style.height = Math.min(el.scrollHeight, 120) + 'px';
}

function handleKeydown(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
}

function sendSuggestion(text) {
    document.getElementById('suggestions').style.display = 'none';
    document.getElementById('userInput').value = text;
    sendMessage();
}

function addMessage(role, content) {
    const container = document.getElementById('chatMessages');
    const isUser = role === 'user';

    const div = document.createElement('div');
    div.className = `flex ${isUser ? 'justify-end' : 'justify-start'} items-end gap-3`;

    if (!isUser) {
        div.innerHTML = `
            <div class="w-8 h-8 rounded-xl bg-blue-500/20 border border-blue-500/30 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
            </div>
            <div class="max-w-[80%] bg-white/[0.05] border border-white/[0.08] rounded-2xl rounded-bl-sm px-5 py-3.5 text-sm text-gray-300 leading-relaxed">${formatMessage(content)}</div>
        `;
    } else {
        div.innerHTML = `
            <div class="max-w-[80%] px-5 py-3.5 rounded-2xl rounded-br-sm text-sm text-white leading-relaxed" style="background: linear-gradient(135deg, #3b82f6, #6366f1);">${content}</div>
            <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0 text-xs font-bold text-white">
                {{ strtoupper(substr(Auth::guard('mahasiswa')->user()->nama, 0, 1)) }}
            </div>
        `;
    }

    container.appendChild(div);
    container.scrollTop = container.scrollHeight;
    return div;
}

function formatMessage(text) {
    return text
        .replace(/\*\*(.*?)\*\*/g, '<strong class="text-white">$1</strong>')
        .replace(/\[([^\]]+)\]\((https?:\/\/[^\)]+)\)/g, '<a href="$2" target="_blank" class="text-blue-400 hover:text-blue-300 underline underline-offset-2 transition">$1 ↗</a>')
        .replace(/\n/g, '<br>');
}

function addTypingIndicator() {
    const container = document.getElementById('chatMessages');
    const div = document.createElement('div');
    div.id = 'typingIndicator';
    div.className = 'flex justify-start items-end gap-3';
    div.innerHTML = `
        <div class="w-8 h-8 rounded-xl bg-blue-500/20 border border-blue-500/30 flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
        </div>
        <div class="bg-white/[0.05] border border-white/[0.08] rounded-2xl rounded-bl-sm px-5 py-4 flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-gray-500 animate-bounce" style="animation-delay:0ms"></span>
            <span class="w-2 h-2 rounded-full bg-gray-500 animate-bounce" style="animation-delay:150ms"></span>
            <span class="w-2 h-2 rounded-full bg-gray-500 animate-bounce" style="animation-delay:300ms"></span>
        </div>
    `;
    container.appendChild(div);
    container.scrollTop = container.scrollHeight;
}

async function sendMessage() {
    const input = document.getElementById('userInput');
    const message = input.value.trim();
    if (!message) return;

    document.getElementById('suggestions').style.display = 'none';

    addMessage('user', message);
    chatHistory.push({ role: 'user', content: message });

    input.value = '';
    input.style.height = 'auto';

    const btn = document.getElementById('sendBtn');
    btn.disabled = true;
    btn.style.opacity = '0.5';

    addTypingIndicator();

    try {
        const response = await fetch("{{ route('mahasiswa.chatbot.chat') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message, history: chatHistory.slice(-10) })
        });

        const data = await response.json();

        document.getElementById('typingIndicator')?.remove();
        addMessage('assistant', data.reply);
        chatHistory.push({ role: 'assistant', content: data.reply });

    } catch (err) {
        document.getElementById('typingIndicator')?.remove();
        addMessage('assistant', 'Maaf, terjadi kesalahan. Silakan coba lagi.');
    }

    btn.disabled = false;
    btn.style.opacity = '1';
    input.focus();
}

// Welcome message
window.addEventListener('load', () => {
    setTimeout(() => {
        addMessage('assistant', 'Halo **{{ Auth::guard('mahasiswa')->user()->nama }}**! 👋\n\nSaya adalah AI Career Assistant Tracer Study UMB. Saya siap membantu kamu dengan informasi seputar:\n\n- Pola karir dan pekerjaan alumni UMB\n- Tips mencari kerja dan wirausaha\n- Informasi tracer study\n- Dan pertanyaan lainnya seputar karir\n\nAda yang bisa saya bantu?');
    }, 500);
});

async function getCareerRecommendation() {
    document.getElementById('suggestions').style.display = 'none';

    const message = "REKOMENDASI_KARIR_PERSONAL";
    addMessage('user', '✨ Analisis rekomendasi karir saya');
    chatHistory.push({ role: 'user', content: message });

    const btn = document.getElementById('sendBtn');
    btn.disabled = true;
    btn.style.opacity = '0.5';
    addTypingIndicator();

    try {
        const response = await fetch("{{ route('mahasiswa.chatbot.chat') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message, history: [] })
        });

        const data = await response.json();
        document.getElementById('typingIndicator')?.remove();
        addMessage('assistant', data.reply);
        chatHistory.push({ role: 'assistant', content: data.reply });

    } catch (err) {
        document.getElementById('typingIndicator')?.remove();
        addMessage('assistant', 'Maaf, terjadi kesalahan. Silakan coba lagi.');
    }

    btn.disabled = false;
    btn.style.opacity = '1';
}
</script>
@endsection