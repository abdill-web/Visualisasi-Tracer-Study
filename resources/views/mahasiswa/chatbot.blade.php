@extends('layouts.app')

@section('title', 'AI Career Assistant')

@section('content')
<div class="min-h-screen bg-[#f5f7fb] flex flex-col">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-200">

        <div class="h-20 px-6 lg:px-10 flex items-center justify-between">

            {{-- LEFT --}}
            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100
                            flex items-center justify-center p-2">

                    <img src="{{ asset('images/logo-kampus.png') }}"
                         class="w-full h-full object-contain">
                </div>

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        AI Career Assistant
                    </h1>

                    <p class="text-sm text-gray-500">
                        Tracer Study Universitas Mercu Buana
                    </p>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-4">

                {{-- USER --}}
                <div class="hidden md:flex items-center gap-3
                            bg-white border border-gray-200
                            rounded-2xl px-4 py-2 shadow-sm">

                    <div class="w-10 h-10 rounded-xl
                                bg-gradient-to-r from-blue-500 to-indigo-500
                                flex items-center justify-center">

                        <span class="text-white font-semibold">
                            {{ strtoupper(substr(Auth::guard('mahasiswa')->user()->nama, 0, 1)) }}
                        </span>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-800">
                            {{ Auth::guard('mahasiswa')->user()->nama }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Mahasiswa
                        </p>
                    </div>
                </div>

                {{-- BACK --}}
                <a href="{{ route('mahasiswa.dashboard') }}"
                   class="h-12 px-5 rounded-2xl
                          border border-gray-200
                          bg-white hover:bg-blue-50
                          hover:border-blue-200
                          text-gray-600 hover:text-blue-600
                          transition-all duration-300
                          flex items-center gap-2 shadow-sm">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>

                    Dashboard
                </a>
            </div>
        </div>
    </nav>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col max-w-6xl mx-auto w-full px-6 py-6">

        {{-- HERO --}}
        <div class="relative overflow-hidden rounded-[32px]
                    bg-gradient-to-r
                    from-blue-600
                    via-indigo-600
                    to-blue-700
                    p-7 lg:p-9
                    mb-6 text-white shadow-2xl">

            {{-- GLOW --}}
            <div class="absolute top-[-80px] right-[-80px]
                        w-[240px] h-[240px]
                        rounded-full bg-white/10 blur-3xl">
            </div>

            <div class="relative z-10">

                <div class="flex flex-col lg:flex-row
                            lg:items-center lg:justify-between gap-6">

                    {{-- LEFT --}}
                    <div>

                        <p class="uppercase tracking-[4px]
                                  text-blue-100 text-xs mb-3">

                            AI CHATBOT
                        </p>

                        <h1 class="text-3xl lg:text-[42px]
                                   font-bold leading-tight mb-3">

                            AI Career Assistant
                        </h1>

                        <p class="text-blue-100 max-w-2xl">
                            Dapatkan rekomendasi karier, insight alumni,
                            dan bantuan seputar tracer study secara real-time.
                        </p>
                    </div>

                    {{-- RIGHT --}}
                    <div class="hidden lg:flex items-center gap-4">

                        <div class="bg-white/10 backdrop-blur-xl
                                    border border-white/10
                                    rounded-3xl px-6 py-5">

                            <p class="text-sm text-blue-100 mb-1">
                                AI Status
                            </p>

                            <h3 class="text-xl font-semibold">
                                Online
                            </h3>
                        </div>

                        <div class="bg-white/10 backdrop-blur-xl
                                    border border-white/10
                                    rounded-3xl px-6 py-5">

                            <p class="text-sm text-blue-100 mb-1">
                                Model
                            </p>

                            <h3 class="text-xl font-semibold">
                                Gemini AI
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SUGGESTIONS --}}
        <div id="suggestions" class="mb-6">

            {{-- RECOMMENDATION --}}
            <div class="bg-white border border-gray-200
                        rounded-[28px] p-6 shadow-sm mb-5">

                <div class="flex flex-col lg:flex-row
                            lg:items-center lg:justify-between gap-5">

                    {{-- LEFT --}}
                    <div class="flex items-start gap-4">

                        <div class="w-14 h-14 rounded-2xl
                                    bg-blue-100
                                    flex items-center justify-center
                                    flex-shrink-0">

                            <svg class="w-7 h-7 text-blue-500"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9.663 17h4.673M12 3v1
                                         m6.364 1.636l-.707.707
                                         M21 12h-1M4 12H3
                                         m3.343-5.657l-.707-.707
                                         m2.828 9.9a5 5 0 117.072 0
                                         l-.548.547A3.374 3.374 0 0014 18.469V19
                                         a2 2 0 11-4 0v-.531
                                         c0-.895-.356-1.754-.988-2.386
                                         l-.548-.547z"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-1">
                                Rekomendasi Karier Personal
                            </h3>

                            <p class="text-gray-500 leading-relaxed">
                                Analisis karier berdasarkan data tracer study alumni.
                            </p>
                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <button onclick="getCareerRecommendation()"
                            class="px-6 py-3 rounded-2xl
                                   bg-gradient-to-r
                                   from-blue-600 to-indigo-600
                                   text-white font-semibold
                                   hover:scale-[1.02]
                                   transition-all duration-300
                                   shadow-lg shadow-blue-500/20">

                        Analisis Karier Saya
                    </button>
                </div>
            </div>

            {{-- QUICK QUESTIONS --}}
            <div class="grid md:grid-cols-2 gap-4">

                @foreach([
                    'Bidang pekerjaan apa yang paling banyak diminati alumni UMB?',
                    'Berapa rata-rata pendapatan alumni UMB per bulan?',
                    'Tips apa untuk cepat mendapat pekerjaan setelah lulus?',
                    'Ada lowongan kerja yang sesuai untuk saya?',
                ] as $q)

                <button onclick="sendSuggestion('{{ $q }}')"
                        class="text-left p-5 rounded-2xl
                               bg-white border border-gray-200
                               hover:border-blue-300
                               hover:bg-blue-50/50
                               transition-all duration-300 shadow-sm">

                    <p class="text-gray-700 font-medium leading-relaxed">
                        {{ $q }}
                    </p>
                </button>

                @endforeach
            </div>
        </div>

        {{-- CHAT CONTAINER --}}
        <div class="flex-1 flex flex-col
                    bg-white border border-gray-200
                    rounded-[32px]
                    shadow-sm overflow-hidden">

            {{-- CHAT HEADER --}}
            <div class="border-b border-gray-100 px-6 py-5
                        flex items-center gap-4">

                <div class="w-14 h-14 rounded-2xl
                            bg-gradient-to-r
                            from-blue-500 to-indigo-500
                            flex items-center justify-center
                            shadow-lg shadow-blue-500/20">

                    <svg class="w-7 h-7 text-white"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9.663 17h4.673M12 3v1
                                 m6.364 1.636l-.707.707
                                 M21 12h-1M4 12H3
                                 m3.343-5.657l-.707-.707
                                 m2.828 9.9a5 5 0 117.072 0
                                 l-.548.547A3.374 3.374 0 0014 18.469V19
                                 a2 2 0 11-4 0v-.531
                                 c0-.895-.356-1.754-.988-2.386
                                 l-.548-.547z"/>
                    </svg>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-gray-800">
                        AI Career Assistant
                    </h3>

                    <p class="text-sm text-green-500">
                        Online
                    </p>
                </div>
            </div>

            {{-- MESSAGES --}}
            <div id="chatMessages"
                 class="flex-1 overflow-y-auto
                        px-6 py-6 flex flex-col gap-5
                        min-h-[450px] max-h-[550px]">
            </div>

            {{-- INPUT --}}
            <div class="border-t border-gray-100 p-5 bg-gray-50">

                <div class="flex items-end gap-4">

                    {{-- INPUT --}}
                    <div class="flex-1 bg-white
                                border border-gray-200
                                rounded-2xl px-5 py-4">

                        <textarea id="userInput"
                                  placeholder="Tanyakan seputar karier, pekerjaan, atau tracer study alumni..."
                                  rows="1"
                                  class="w-full bg-transparent
                                         text-gray-800 text-sm
                                         placeholder-gray-400
                                         resize-none
                                         focus:outline-none
                                         leading-relaxed"
                                  onkeydown="handleKeydown(event)"
                                  oninput="autoResize(this)"></textarea>
                    </div>

                    {{-- SEND --}}
                    <button onclick="sendMessage()"
                            id="sendBtn"
                            class="w-14 h-14 rounded-2xl
                                   bg-gradient-to-r
                                   from-blue-600 to-indigo-600
                                   flex items-center justify-center
                                   hover:scale-[1.03]
                                   transition-all duration-300
                                   shadow-lg shadow-blue-500/20">

                        <svg class="w-5 h-5 text-white"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </button>
                </div>

                <p class="text-center text-xs text-gray-400 mt-4">
                    AI dapat membuat kesalahan. Verifikasi informasi penting secara mandiri.
                </p>
            </div>
        </div>
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

function formatMessage(text) {
    return text
        .replace(/\*\*(.*?)\*\*/g, '<strong class="text-gray-900">$1</strong>')
        .replace(/\[([^\]]+)\]\((https?:\/\/[^\)]+)\)/g,
            '<a href="$2" target="_blank" class="text-blue-600 hover:text-blue-700 underline">$1</a>')
        .replace(/\n/g, '<br>');
}

function addMessage(role, content) {

    const container = document.getElementById('chatMessages');
    const isUser = role === 'user';

    const div = document.createElement('div');
    div.className = `flex ${isUser ? 'justify-end' : 'justify-start'} items-end gap-3`;

    if (!isUser) {

        div.innerHTML = `
            <div class="w-10 h-10 rounded-2xl
                        bg-blue-100
                        flex items-center justify-center
                        flex-shrink-0">

                <svg class="w-5 h-5 text-blue-500"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9.663 17h4.673M12 3v1"/>
                </svg>
            </div>

            <div class="max-w-[80%]
                        bg-gray-100
                        rounded-3xl rounded-bl-md
                        px-5 py-4
                        text-sm text-gray-700
                        leading-relaxed">

                ${formatMessage(content)}
            </div>
        `;

    } else {

        div.innerHTML = `
            <div class="max-w-[80%]
                        px-5 py-4
                        rounded-3xl rounded-br-md
                        text-sm text-white
                        leading-relaxed
                        bg-gradient-to-r
                        from-blue-600 to-indigo-600">

                ${content}
            </div>

            <div class="w-10 h-10 rounded-2xl
                        bg-gradient-to-r
                        from-blue-500 to-indigo-500
                        flex items-center justify-center
                        flex-shrink-0">

                <span class="text-white text-sm font-bold">
                    {{ strtoupper(substr(Auth::guard('mahasiswa')->user()->nama, 0, 1)) }}
                </span>
            </div>
        `;
    }

    container.appendChild(div);
    container.scrollTop = container.scrollHeight;
}

function addTypingIndicator() {

    const container = document.getElementById('chatMessages');

    const div = document.createElement('div');

    div.id = 'typingIndicator';

    div.className = 'flex justify-start items-end gap-3';

    div.innerHTML = `
        <div class="w-10 h-10 rounded-2xl
                    bg-blue-100
                    flex items-center justify-center">

            <svg class="w-5 h-5 text-blue-500"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9.663 17h4.673M12 3v1"/>
            </svg>
        </div>

        <div class="bg-gray-100
                    rounded-3xl rounded-bl-md
                    px-5 py-4 flex items-center gap-1.5">

            <span class="w-2 h-2 rounded-full bg-gray-400 animate-bounce"></span>
            <span class="w-2 h-2 rounded-full bg-gray-400 animate-bounce delay-150"></span>
            <span class="w-2 h-2 rounded-full bg-gray-400 animate-bounce delay-300"></span>
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

    chatHistory.push({
        role: 'user',
        content: message
    });

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

            body: JSON.stringify({
                message,
                history: chatHistory.slice(-10)
            })
        });

        const data = await response.json();

        document.getElementById('typingIndicator')?.remove();

        addMessage('assistant', data.reply);

        chatHistory.push({
            role: 'assistant',
            content: data.reply
        });

    } catch (err) {

        document.getElementById('typingIndicator')?.remove();

        addMessage('assistant',
            'Maaf, terjadi kesalahan. Silakan coba lagi.');
    }

    btn.disabled = false;
    btn.style.opacity = '1';

    input.focus();
}

window.addEventListener('load', () => {

    setTimeout(() => {

        addMessage(
            'assistant',
            'Halo {{ Auth::guard('mahasiswa')->user()->nama }}.<br><br>Saya adalah AI Career Assistant Tracer Study UMB.<br><br>Saya siap membantu terkait:<br><br>• Pola karier alumni UMB<br>• Tips mencari kerja<br>• Rekomendasi karier<br>• Informasi tracer study<br><br>Ada yang bisa saya bantu?'
        );

    }, 500);
});

async function getCareerRecommendation() {

    document.getElementById('suggestions').style.display = 'none';

    const message = "REKOMENDASI_KARIR_PERSONAL";

    addMessage('user', 'Analisis rekomendasi karier saya');

    chatHistory.push({
        role: 'user',
        content: message
    });

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

            body: JSON.stringify({
                message,
                history: []
            })
        });

        const data = await response.json();

        document.getElementById('typingIndicator')?.remove();

        addMessage('assistant', data.reply);

        chatHistory.push({
            role: 'assistant',
            content: data.reply
        });

    } catch (err) {

        document.getElementById('typingIndicator')?.remove();

        addMessage('assistant',
            'Maaf, terjadi kesalahan. Silakan coba lagi.');
    }

    btn.disabled = false;
    btn.style.opacity = '1';
}
</script>
@endsection