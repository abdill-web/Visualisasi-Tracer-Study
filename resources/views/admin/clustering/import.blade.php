@extends('layouts.app')

@section('title', 'Import Clustering')

@section('content')

<div class="min-h-screen bg-[#f5f7fb]">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-gray-200
                px-8 py-4 sticky top-0 z-50">

        <div class="max-w-7xl mx-auto
                    flex items-center justify-between">

            {{-- LEFT --}}
            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-2xl
                            bg-gradient-to-br
                            from-purple-500 to-indigo-600
                            flex items-center justify-center
                            shadow-lg shadow-purple-500/20">

                    <img src="{{ asset('images/logo-kampus.png') }}"
                         alt="Logo"
                         class="w-8 h-8 object-contain">
                </div>

                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Clustering AI
                    </h1>

                    <p class="text-sm text-gray-500">
                        Machine Learning Career Analysis
                    </p>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-4">

                {{-- USER --}}
                <div class="flex items-center gap-3
                            bg-white border border-gray-200
                            rounded-2xl px-4 py-2 shadow-sm">

                    <div class="w-11 h-11 rounded-xl
                                bg-gradient-to-br
                                from-purple-500 to-indigo-600
                                flex items-center justify-center
                                text-white font-bold">

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-800">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Administrator
                        </p>
                    </div>
                </div>

                {{-- LOGOUT --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="flex items-center gap-2
                                   px-5 py-3 rounded-2xl
                                   bg-white border border-gray-200
                                   text-gray-600 hover:text-red-500
                                   hover:border-red-200
                                   transition-all duration-300
                                   shadow-sm">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1
                                     a3 3 0 01-3 3H6a3 3 0 01-3-3V7
                                     a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>

                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-10">

        {{-- HERO --}}
        <div class="bg-gradient-to-r
                    from-purple-500
                    via-indigo-500
                    to-purple-600
                    rounded-[36px]
                    p-10 lg:p-12
                    shadow-xl shadow-purple-500/10
                    mb-8">

            <div class="flex flex-col lg:flex-row
                        lg:items-center
                        lg:justify-between gap-8">

                {{-- LEFT --}}
                <div>

                    <p class="text-purple-100
                              text-xs uppercase
                              tracking-[0.4em]
                              mb-4">

                        MACHINE LEARNING
                    </p>

                    <h1 class="text-5xl lg:text-6xl
                               font-bold text-white
                               leading-tight mb-4">

                        Import<br>
                        Clustering CSV
                    </h1>

                    <p class="text-purple-100 text-lg">
                        Upload hasil clustering machine learning
                        untuk analisis pola karir alumni.
                    </p>
                </div>

                {{-- RIGHT --}}
                <div class="grid grid-cols-2 gap-4">

                    <div class="bg-white/10 backdrop-blur-md
                                border border-white/10
                                rounded-[28px]
                                px-6 py-5 min-w-[170px]">

                        <p class="text-purple-100 text-sm mb-2">
                            Format File
                        </p>

                        <h3 class="text-4xl font-bold text-white">
                            CSV
                        </h3>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md
                                border border-white/10
                                rounded-[28px]
                                px-6 py-5 min-w-[170px]">

                        <p class="text-purple-100 text-sm mb-2">
                            Cluster
                        </p>

                        <h3 class="text-4xl font-bold text-white">
                            0 & 1
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- ALERT --}}
        @if(session('success'))

        <div class="mb-6 bg-emerald-50
                    border border-emerald-200
                    text-emerald-700
                    rounded-[28px]
                    px-6 py-5">

            <div class="flex items-center gap-3">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7"/>
                </svg>

                <span class="font-medium">
                    {{ session('success') }}
                </span>
            </div>
        </div>

        @endif

        @if($errors->any())

        <div class="mb-6 bg-red-50
                    border border-red-200
                    text-red-700
                    rounded-[28px]
                    px-6 py-5">

            <div class="flex items-center gap-3">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 8v4m0 4h.01M4.93
                             19h14.14c1.54 0 2.5
                             -1.67 1.73-3L13.73 4
                             c-.77-1.33-2.69-1.33
                             -3.46 0L3.2 16c-.77
                             1.33.19 3 1.73 3z"/>
                </svg>

                <span class="font-medium">
                    {{ $errors->first() }}
                </span>
            </div>
        </div>

        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT --}}
            <div class="lg:col-span-2">

                <div class="bg-white rounded-[36px]
                            border border-gray-200
                            shadow-sm overflow-hidden">

                    {{-- HEADER --}}
                    <div class="px-8 py-6 border-b border-gray-100">

                        <p class="text-xs uppercase
                                  tracking-[0.3em]
                                  text-gray-500 mb-2">

                            FILE UPLOAD
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900">
                            Upload File Clustering
                        </h2>
                    </div>

                    {{-- BODY --}}
                    <div class="p-8">

                        <form method="POST"
                              action="{{ route('admin.clustering.import.post') }}"
                              enctype="multipart/form-data">

                            @csrf

                            {{-- DROPZONE --}}
                            <div class="mb-8">

                                <label class="block text-sm font-semibold
                                             text-gray-700 mb-4">

                                    Pilih File CSV
                                </label>

                                <label
                                    class="group flex flex-col items-center justify-center
                                           w-full min-h-[300px]
                                           border-2 border-dashed border-gray-300
                                           rounded-[32px]
                                           hover:border-purple-400
                                           hover:bg-purple-50/40
                                           transition-all duration-300
                                           cursor-pointer">

                                    <div class="flex flex-col items-center text-center px-6">

                                        <div class="w-24 h-24 rounded-[30px]
                                                    bg-purple-100
                                                    flex items-center justify-center
                                                    mb-6
                                                    group-hover:scale-105
                                                    transition">

                                            <svg class="w-12 h-12 text-purple-600"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M7 16a4 4 0
                                                         01-.88-7.903A5
                                                         5 0 1115.9 6L16
                                                         6a5 5 0 011
                                                         9.9M15 13l-3-3
                                                         m0 0l-3 3m3-3v12"/>
                                            </svg>
                                        </div>

                                        <h3 class="text-2xl font-bold
                                                   text-gray-900 mb-3">

                                            Klik untuk Upload CSV
                                        </h3>

                                        <p class="text-gray-500 leading-relaxed max-w-md">
                                            Upload file CSV hasil clustering
                                            machine learning untuk menampilkan
                                            visualisasi AI alumni.
                                        </p>

                                        <div class="mt-6 px-5 py-3 rounded-2xl
                                                    bg-gray-100 text-gray-600
                                                    text-sm font-medium">

                                            Format yang didukung: .csv
                                        </div>
                                    </div>

                                    <input type="file"
                                           id="csv_file"
                                           name="csv_file"
                                           accept=".csv"
                                           class="hidden"
                                           required>
                                </label>

                                {{-- FILE PREVIEW --}}
                                <div id="file-preview"
                                     class="hidden mt-6">

                                    <div class="flex items-center gap-4
                                                bg-purple-50
                                                border border-purple-200
                                                rounded-[28px]
                                                p-5">

                                        <div class="w-14 h-14 rounded-2xl
                                                    bg-purple-100
                                                    flex items-center justify-center">

                                            <svg class="w-7 h-7 text-purple-600"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M7 7V3a1 1 0
                                                         011-1h8l5 5v13
                                                         a2 2 0 01-2 2H8
                                                         a2 2 0 01-2-2V7z"/>
                                            </svg>
                                        </div>

                                        <div class="flex-1">

                                            <p class="text-sm text-gray-500 mb-1">
                                                File dipilih
                                            </p>

                                            <p id="file-name"
                                               class="font-semibold text-gray-900">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- BUTTON --}}
                            <button type="submit"
                                    class="w-full py-5 rounded-[24px]
                                           text-white font-semibold text-lg
                                           shadow-lg shadow-purple-500/20
                                           transition-all duration-300
                                           hover:scale-[1.01]
                                           active:scale-[0.99]"
                                    style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">

                                Import Data Clustering
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="space-y-6">

                {{-- FORMAT --}}
                <div class="bg-white rounded-[36px]
                            border border-gray-200
                            shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-100">

                        <h2 class="text-xl font-bold text-gray-900">
                            Format CSV
                        </h2>
                    </div>

                    <div class="p-6">

                        <p class="text-gray-500 text-sm leading-relaxed mb-5">
                            File CSV harus berasal dari hasil clustering
                            machine learning dengan format:
                        </p>

                        <div class="bg-gray-100
                                    rounded-[24px]
                                    p-5 overflow-x-auto">

                            <code class="text-purple-700
                                         text-xs font-mono">

                                ..., label_cluster
                            </code>
                        </div>

                        <div class="mt-5 space-y-3">

                            <div class="flex items-start gap-3">

                                <div class="w-2 h-2 rounded-full
                                            bg-purple-500 mt-2">
                                </div>

                                <p class="text-sm text-gray-600">
                                    Kolom terakhir wajib bernama
                                    <span class="font-semibold">
                                        label_cluster
                                    </span>
                                </p>
                            </div>

                            <div class="flex items-start gap-3">

                                <div class="w-2 h-2 rounded-full
                                            bg-purple-500 mt-2">
                                </div>

                                <p class="text-sm text-gray-600">
                                    Nilai cluster menggunakan
                                    angka 0 atau 1
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- INFO --}}
                <div class="bg-white rounded-[36px]
                            border border-gray-200
                            shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-100">

                        <h2 class="text-xl font-bold text-gray-900">
                            Informasi Cluster
                        </h2>
                    </div>

                    <div class="p-6 space-y-5">

                        {{-- CLUSTER 0 --}}
                        <div class="flex items-start gap-4">

                            <div class="w-4 h-4 rounded-full
                                        bg-emerald-500 mt-1">
                            </div>

                            <div>

                                <h3 class="font-semibold text-gray-900">
                                    Cluster 0
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    High Performer — alumni dengan
                                    kompetensi dan adaptasi tinggi.
                                </p>
                            </div>
                        </div>

                        {{-- CLUSTER 1 --}}
                        <div class="flex items-start gap-4">

                            <div class="w-4 h-4 rounded-full
                                        bg-amber-500 mt-1">
                            </div>

                            <div>

                                <h3 class="font-semibold text-gray-900">
                                    Cluster 1
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Moderate Performer — alumni dengan
                                    kompetensi dan adaptasi sedang.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>

const fileInput = document.getElementById('csv_file');
const filePreview = document.getElementById('file-preview');
const fileName = document.getElementById('file-name');

fileInput.addEventListener('change', function () {

    if (this.files.length > 0) {

        filePreview.classList.remove('hidden');
        fileName.textContent = this.files[0].name;

    } else {

        filePreview.classList.add('hidden');
        fileName.textContent = '';
    }
});

</script>

@endsection