@extends('layouts.app')

@section('title', 'Form Tracer Study')

@section('content')
<div class="min-h-screen bg-[#0f1117]">

    {{-- NAVBAR --}}
    <nav class="bg-[#0a0a0f]/80 backdrop-blur-xl border-b border-white/5 px-8 py-4 flex items-center justify-between sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-blue-500/20 border border-blue-500/30 flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
            </div>
            <a href="{{ route('mahasiswa.dashboard') }}" class="text-gray-500 text-sm hover:text-gray-300 transition">Dashboard</a>
            <span class="text-gray-700">/</span>
            <span class="text-gray-300 text-sm">Form Tracer Study</span>
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

    <div class="max-w-2xl mx-auto py-10 px-4">

        {{-- HEADER --}}
        <div class="text-center mb-10">
            <p class="text-gray-600 text-xs uppercase tracking-widest mb-2">Kuesioner</p>
            <h1 class="text-3xl font-bold text-white">Form Tracer Study</h1>
            <p class="text-gray-500 text-sm mt-2">Lulusan D3 & S1 — Mohon isi dengan jujur dan lengkap</p>
        </div>

        @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl px-5 py-4 mb-8 text-sm flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ $tracer ? route('mahasiswa.tracer.update') : route('mahasiswa.tracer.store') }}">
            @csrf
            @if($tracer) @method('PUT') @endif

            {{-- ══ 1. IDENTITAS ══ --}}
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6 mb-4">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/[0.06]">
                    <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h2 class="font-semibold text-white">Identitas Data Pribadi</h2>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Nama</label>
                        <input type="text" class="w-full bg-white/[0.02] border border-white/[0.06] rounded-xl px-4 py-3 text-sm text-gray-500 cursor-not-allowed" value="{{ $mahasiswa->nama }}" disabled/>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">NIM</label>
                        <input type="text" class="w-full bg-white/[0.02] border border-white/[0.06] rounded-xl px-4 py-3 text-sm text-gray-500 cursor-not-allowed" value="{{ $mahasiswa->nim }}" disabled/>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Program Studi</label>
                        <input type="text" class="w-full bg-white/[0.02] border border-white/[0.06] rounded-xl px-4 py-3 text-sm text-gray-500 cursor-not-allowed" value="{{ $mahasiswa->program_studi }}" disabled/>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Tahun Lulus <span class="text-red-400 normal-case">*</span></label>
                        <input type="text" name="tahun_lulus" placeholder="Contoh: 2024"
                               class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 focus:bg-white/[0.05] transition"
                               value="{{ old('tahun_lulus', $tracer->tahun_lulus ?? '') }}"/>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">No. Telepon/WA <span class="text-red-400 normal-case">*</span></label>
                        <input type="text" name="no_telepon" placeholder="08123456789"
                               class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 focus:bg-white/[0.05] transition"
                               value="{{ old('no_telepon', $tracer->no_telepon ?? '') }}"/>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Email Aktif <span class="text-red-400 normal-case">*</span></label>
                        <input type="email" name="email" placeholder="email@gmail.com"
                               class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 focus:bg-white/[0.05] transition"
                               value="{{ old('email', $tracer->email ?? '') }}"/>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">NPWP</label>
                    <input type="text" name="npwp" placeholder="Isi angka saja. Jika tidak punya, isi angka 0"
                           class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 focus:bg-white/[0.05] transition"
                           value="{{ old('npwp', $tracer->npwp ?? '') }}"/>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Instagram</label>
                        <input type="text" name="instagram" placeholder="@username"
                               class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 focus:bg-white/[0.05] transition"
                               value="{{ old('instagram', $tracer->instagram ?? '') }}"/>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">LinkedIn</label>
                        <input type="text" name="linkedin" placeholder="linkedin.com/in/username"
                               class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 focus:bg-white/[0.05] transition"
                               value="{{ old('linkedin', $tracer->linkedin ?? '') }}"/>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Sertifikasi Profesi (setelah lulus)</label>
                    <input type="text" name="sertifikasi" placeholder="Contoh: Google Analytics, AWS. Kosongkan jika tidak ada."
                           class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 focus:bg-white/[0.05] transition"
                           value="{{ old('sertifikasi', $tracer->sertifikasi ?? '') }}"/>
                </div>
            </div>

            {{-- ══ 2. SUMBER DANA ══ --}}
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6 mb-4">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/[0.06]">
                    <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <h2 class="font-semibold text-white">Sumber Dana Kuliah</h2>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Sumber dana pembiayaan kuliah di UMB <span class="text-red-400 normal-case">*</span></label>
                    <select name="sumber_dana" class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500/50 transition">
                        <option value="" class="bg-[#1a1a2e]">-- Pilih salah satu --</option>
                        @foreach(['Biaya sendiri / keluarga','Beasiswa pemerintah (Bidikmisi/KIP)','Beasiswa swasta','Beasiswa UMB','Pinjaman / kredit pendidikan','Lainnya'] as $opt)
                            <option value="{{ $opt }}" class="bg-[#1a1a2e]" {{ old('sumber_dana', $tracer->sumber_dana ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- ══ 3. TRANSISI KERJA ══ --}}
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6 mb-4">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/[0.06]">
                    <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h2 class="font-semibold text-white">Masa Transisi ke Dunia Kerja</h2>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Kapan mulai mencari pekerjaan? <span class="text-red-400 normal-case">*</span></label>
                    <p class="text-xs text-gray-600 mb-2">Mohon pekerjaan sambilan (freelance) tidak dimasukkan</p>
                    <select name="mulai_cari_kerja" class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500/50 transition">
                        <option value="" class="bg-[#1a1a2e]">-- Pilih salah satu --</option>
                        @foreach(['Sebelum lulus','Setelah lulus','Saya tidak mencari kerja'] as $opt)
                            <option value="{{ $opt }}" class="bg-[#1a1a2e]" {{ old('mulai_cari_kerja', $tracer->mulai_cari_kerja ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-3 gap-3 mb-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Jumlah Dilamar</label>
                        <p class="text-xs text-gray-600 mb-1">Isi 0 jika wirausaha</p>
                        <input type="number" name="jml_lamar" min="0" placeholder="0"
                               class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 transition"
                               value="{{ old('jml_lamar', $tracer->jml_lamar ?? '') }}"/>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Merespon</label>
                        <p class="text-xs text-gray-600 mb-1">&nbsp;</p>
                        <input type="number" name="jml_respon" min="0" placeholder="0"
                               class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 transition"
                               value="{{ old('jml_respon', $tracer->jml_respon ?? '') }}"/>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Wawancara</label>
                        <p class="text-xs text-gray-600 mb-1">&nbsp;</p>
                        <input type="number" name="jml_wawancara" min="0" placeholder="0"
                               class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 transition"
                               value="{{ old('jml_wawancara', $tracer->jml_wawancara ?? '') }}"/>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Aktif mencari kerja dalam 4 minggu terakhir?</label>
                    <select name="aktif_cari_kerja" id="aktif_cari_kerja" onchange="toggleAktifLainnya()"
                            class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500/50 transition">
                        <option value="" class="bg-[#1a1a2e]">-- Pilih salah satu --</option>
                        @foreach(['Tidak','Tidak, tapi sedang menunggu hasil lamaran','Ya, akan mulai bekerja dalam 2 minggu ke depan','Ya, tapi belum pasti dalam 2 minggu ke depan','Lainnya'] as $opt)
                            <option value="{{ $opt }}" class="bg-[#1a1a2e]" {{ old('aktif_cari_kerja', $tracer->aktif_cari_kerja ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="aktif_lainnya_div" class="{{ old('aktif_cari_kerja', $tracer->aktif_cari_kerja ?? '') == 'Lainnya' ? '' : 'hidden' }}">
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Jelaskan (jika Lainnya)</label>
                    <input type="text" name="aktif_cari_kerja_lainnya"
                           class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 transition"
                           value="{{ old('aktif_cari_kerja_lainnya', $tracer->aktif_cari_kerja_lainnya ?? '') }}"/>
                </div>
            </div>

            {{-- ══ 4. STATUS SAAT INI ══ --}}
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6 mb-4">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/[0.06]">
                    <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="font-semibold text-white">Status Saat Ini</h2>
                </div>
                <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Jelaskan status Anda saat ini <span class="text-red-400 normal-case">*</span></label>
                <select name="status_saat_ini" id="status_saat_ini" onchange="toggleStatusSection()"
                        class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500/50 transition">
                    <option value="" class="bg-[#1a1a2e]">-- Pilih salah satu --</option>
                    <option value="bekerja" class="bg-[#1a1a2e]" {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'bekerja' ? 'selected' : '' }}>Bekerja (Full Time)</option>
                    <option value="wirausaha" class="bg-[#1a1a2e]" {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'wirausaha' ? 'selected' : '' }}>Wiraswasta / Wirausaha (termasuk Freelancer, Content Creator)</option>
                    <option value="studi_lanjut" class="bg-[#1a1a2e]" {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'studi_lanjut' ? 'selected' : '' }}>Melanjutkan Pendidikan</option>
                    <option value="tidak_bekerja" class="bg-[#1a1a2e]" {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'tidak_bekerja' ? 'selected' : '' }}>Tidak Kerja (sedang mencari kerja)</option>
                    <option value="belum_bekerja" class="bg-[#1a1a2e]" {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'belum_bekerja' ? 'selected' : '' }}>Belum memungkinkan untuk bekerja</option>
                </select>
            </div>

            {{-- ══ 5A. BEKERJA ══ --}}
            <div id="section_bekerja" class="hidden">
                <div class="bg-white/[0.03] border border-emerald-500/20 rounded-2xl p-6 mb-4">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-emerald-500/10">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h2 class="font-semibold text-emerald-400">Info Pekerjaan</h2>
                    </div>

                    @php $inputClass = "w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-emerald-500/50 transition"; @endphp

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Mendapat kerja ≤ 6 bulan?</label>
                            <select name="dapat_kerja_6bulan" class="{{ $inputClass }}">
                                <option value="" class="bg-[#1a1a2e]">-- Pilih --</option>
                                <option value="Ya" class="bg-[#1a1a2e]" {{ old('dapat_kerja_6bulan', $tracer->dapat_kerja_6bulan ?? '') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" class="bg-[#1a1a2e]" {{ old('dapat_kerja_6bulan', $tracer->dapat_kerja_6bulan ?? '') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Berapa bulan mendapat kerja?</label>
                            <input type="number" name="bulan_dapat_kerja" min="0" placeholder="Contoh: 3" class="{{ $inputClass }}" value="{{ old('bulan_dapat_kerja', $tracer->bulan_dapat_kerja ?? '') }}"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Posisi / Jabatan</label>
                            <input type="text" name="posisi_jabatan" placeholder="Contoh: Staff Marketing" class="{{ $inputClass }}" value="{{ old('posisi_jabatan', $tracer->posisi_jabatan ?? '') }}"/>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Job Title (Detail)</label>
                            <input type="text" name="job_title" placeholder="Contoh: Digital Marketing Specialist" class="{{ $inputClass }}" value="{{ old('job_title', $tracer->job_title ?? '') }}"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" placeholder="Contoh: PT Jaya Jaya" class="{{ $inputClass }}" value="{{ old('nama_perusahaan', $tracer->nama_perusahaan ?? '') }}"/>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Jenis Perusahaan</label>
                            <select name="jenis_perusahaan" class="{{ $inputClass }}">
                                <option value="" class="bg-[#1a1a2e]">-- Pilih --</option>
                                @foreach(['BUMN','Swasta Nasional','Swasta Asing/Multinasional','Instansi Pemerintah','TNI/Polri','Organisasi Non-profit','Lainnya'] as $opt)
                                    <option value="{{ $opt }}" class="bg-[#1a1a2e]" {{ old('jenis_perusahaan', $tracer->jenis_perusahaan ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Bidang / Sektor</label>
                            <select name="bidang_perusahaan" class="{{ $inputClass }}">
                                <option value="" class="bg-[#1a1a2e]">-- Pilih --</option>
                                @foreach(['Teknologi Informasi','Perbankan & Keuangan','Pendidikan','Kesehatan','Manufaktur','Perdagangan & Retail','Media & Komunikasi','Konsultan','Pemerintahan','Transportasi & Logistik','Properti','Lainnya'] as $opt)
                                    <option value="{{ $opt }}" class="bg-[#1a1a2e]" {{ old('bidang_perusahaan', $tracer->bidang_perusahaan ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Tingkat Perusahaan</label>
                            <select name="tingkat_perusahaan" class="{{ $inputClass }}">
                                <option value="" class="bg-[#1a1a2e]">-- Pilih --</option>
                                @foreach(['Lokal / Wiraswasta tidak berbadan hukum','Nasional / Wiraswasta berbadan hukum','Multinasional / Internasional'] as $opt)
                                    <option value="{{ $opt }}" class="bg-[#1a1a2e]" {{ old('tingkat_perusahaan', $tracer->tingkat_perusahaan ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Provinsi Tempat Kerja</label>
                            <select name="provinsi_kerja" class="{{ $inputClass }}">
                                <option value="" class="bg-[#1a1a2e]">-- Pilih --</option>
                                @foreach(['DKI Jakarta','Jawa Barat','Jawa Tengah','Jawa Timur','Banten','DI Yogyakarta','Bali','Sumatera Utara','Sumatera Selatan','Kalimantan Timur','Sulawesi Selatan','Lainnya'] as $prov)
                                    <option value="{{ $prov }}" class="bg-[#1a1a2e]" {{ old('provinsi_kerja', $tracer->provinsi_kerja ?? '') == $prov ? 'selected' : '' }}>{{ $prov }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Kota Tempat Kerja</label>
                            <input type="text" name="kota_kerja" placeholder="Contoh: Jakarta Selatan" class="{{ $inputClass }}" value="{{ old('kota_kerja', $tracer->kota_kerja ?? '') }}"/>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Rata-rata Pendapatan per Bulan (Rp)</label>
                        <p class="text-xs text-gray-600 mb-1.5">Termasuk gaji pokok, tunjangan, dan pendapatan lainnya</p>
                        <input type="number" name="pendapatan" min="0" placeholder="Contoh: 5000000" class="{{ $inputClass }}" value="{{ old('pendapatan', $tracer->pendapatan ?? '') }}"/>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Kesesuaian Bidang Studi</label>
                            <select name="kesesuaian_bidang" class="{{ $inputClass }}">
                                <option value="" class="bg-[#1a1a2e]">-- Pilih --</option>
                                @foreach(['Sangat erat','Erat','Cukup erat','Kurang erat','Tidak sama sekali'] as $opt)
                                    <option value="{{ $opt }}" class="bg-[#1a1a2e]" {{ old('kesesuaian_bidang', $tracer->kesesuaian_bidang ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Tingkat Pendidikan yang Sesuai</label>
                            <select name="tingkat_pendidikan_sesuai" class="{{ $inputClass }}">
                                <option value="" class="bg-[#1a1a2e]">-- Pilih --</option>
                                @foreach(['Setingkat lebih tinggi','Tingkat yang sama','Setingkat lebih rendah','Tidak perlu pendidikan tinggi'] as $opt)
                                    <option value="{{ $opt }}" class="bg-[#1a1a2e]" {{ old('tingkat_pendidikan_sesuai', $tracer->tingkat_pendidikan_sesuai ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="bg-white/[0.02] border border-white/[0.06] rounded-xl p-4">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-4">Data Atasan — untuk Survey Pengguna</p>
                        <div class="grid grid-cols-2 gap-4 mb-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Nama Atasan</label>
                                <input type="text" name="nama_atasan" class="{{ $inputClass }}" value="{{ old('nama_atasan', $tracer->nama_atasan ?? '') }}"/>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Jabatan Atasan</label>
                                <input type="text" name="jabatan_atasan" class="{{ $inputClass }}" value="{{ old('jabatan_atasan', $tracer->jabatan_atasan ?? '') }}"/>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Email Atasan</label>
                            <input type="email" name="email_atasan" placeholder="Untuk Survey Penilaian Pengguna" class="{{ $inputClass }}" value="{{ old('email_atasan', $tracer->email_atasan ?? '') }}"/>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══ 5B. WIRAUSAHA ══ --}}
            <div id="section_wirausaha" class="hidden">
                <div class="bg-white/[0.03] border border-amber-500/20 rounded-2xl p-6 mb-4">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-amber-500/10">
                        <div class="w-8 h-8 rounded-lg bg-amber-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <h2 class="font-semibold text-amber-400">Info Wirausaha</h2>
                    </div>

                    @php $inputClassW = "w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-amber-500/50 transition"; @endphp

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Posisi di Usaha</label>
                            <select name="posisi_wirausaha" class="{{ $inputClassW }}">
                                <option value="" class="bg-[#1a1a2e]">-- Pilih --</option>
                                @foreach(['Founder','Co-Founder','Staff','Freelance / Kerja Lepas (termasuk konten creator, influencer)'] as $opt)
                                    <option value="{{ $opt }}" class="bg-[#1a1a2e]" {{ old('posisi_wirausaha', $tracer->posisi_wirausaha ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Jenis Usaha</label>
                            <select name="jenis_usaha" class="{{ $inputClassW }}">
                                <option value="" class="bg-[#1a1a2e]">-- Pilih --</option>
                                @foreach(['Kuliner / F&B','Fashion & Kecantikan','Teknologi / Startup','Jasa Konsultan','Pendidikan','Perdagangan','Konten Digital','Lainnya'] as $opt)
                                    <option value="{{ $opt }}" class="bg-[#1a1a2e]" {{ old('jenis_usaha', $tracer->jenis_usaha ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Bulan Setelah Lulus Mulai Wirausaha</label>
                            <input type="number" name="bulan_mulai_wirausaha" min="0" placeholder="Contoh: 3" class="{{ $inputClassW }}" value="{{ old('bulan_mulai_wirausaha', $tracer->bulan_mulai_wirausaha ?? '') }}"/>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Tingkat Usaha</label>
                            <select name="tingkat_usaha" class="{{ $inputClassW }}">
                                <option value="" class="bg-[#1a1a2e]">-- Pilih --</option>
                                @foreach(['Lokal / Wiraswasta tidak berbadan hukum','Nasional / Wiraswasta berbadan hukum','Multinasional / Internasional'] as $opt)
                                    <option value="{{ $opt }}" class="bg-[#1a1a2e]" {{ old('tingkat_usaha', $tracer->tingkat_usaha ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Akun TikTok / Instagram Usaha</label>
                            <input type="text" name="sosmed_usaha" placeholder="@namaakun" class="{{ $inputClassW }}" value="{{ old('sosmed_usaha', $tracer->sosmed_usaha ?? '') }}"/>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Jumlah Rekan Kerja</label>
                            <select name="jumlah_rekan_kerja" class="{{ $inputClassW }}">
                                <option value="" class="bg-[#1a1a2e]">-- Pilih --</option>
                                @foreach(['< 5','≥ 5 s.d. < 10','≥ 10 s.d. < 25','≥ 25 s.d. < 50','≥ 50'] as $opt)
                                    <option value="{{ $opt }}" class="bg-[#1a1a2e]" {{ old('jumlah_rekan_kerja', $tracer->jumlah_rekan_kerja ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Omzet per Bulan (Rp)</label>
                            <p class="text-xs text-gray-600 mb-1.5">Pendapatan kotor</p>
                            <input type="number" name="omzet" min="0" class="{{ $inputClassW }}" value="{{ old('omzet', $tracer->omzet ?? '') }}"/>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Pendapatan Pribadi per Bulan (Rp)</label>
                            <p class="text-xs text-gray-600 mb-1.5">Take home pay</p>
                            <input type="number" name="pendapatan_wirausaha" min="0" class="{{ $inputClassW }}" value="{{ old('pendapatan_wirausaha', $tracer->pendapatan_wirausaha ?? '') }}"/>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Motivasi Berwirausaha <span class="normal-case text-gray-600 font-normal">(boleh pilih lebih dari satu)</span></label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach(['Ingin mandiri secara finansial','Tidak ingin terikat jam kerja','Meneruskan usaha keluarga','Sulit mendapat pekerjaan','Passion / hobi','Ingin menciptakan lapangan kerja','Lainnya'] as $mot)
                                @php $checked = in_array($mot, json_decode($tracer->motivasi_wirausaha ?? '[]', true) ?? []); @endphp
                                <label class="flex items-center gap-2.5 text-sm text-gray-400 bg-white/[0.02] border border-white/[0.06] rounded-xl px-4 py-2.5 cursor-pointer hover:bg-amber-500/5 hover:border-amber-500/20 transition">
                                    <input type="checkbox" name="motivasi_wirausaha[]" value="{{ $mot }}" {{ $checked ? 'checked' : '' }} class="accent-amber-500"/>
                                    {{ $mot }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Motivasi Lainnya</label>
                        <input type="text" name="motivasi_wirausaha_lainnya" placeholder="Isi jika memilih 'Lainnya' di atas" class="{{ $inputClassW }}" value="{{ old('motivasi_wirausaha_lainnya', $tracer->motivasi_wirausaha_lainnya ?? '') }}"/>
                    </div>
                    <div class="bg-white/[0.02] border border-white/[0.06] rounded-xl p-4">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-4">Data Partner Kerja — untuk Survey Pengguna</p>
                        <div class="grid grid-cols-2 gap-4 mb-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Nama Partner</label>
                                <input type="text" name="nama_partner" class="{{ $inputClassW }}" value="{{ old('nama_partner', $tracer->nama_partner ?? '') }}"/>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Jabatan Partner</label>
                                <input type="text" name="jabatan_partner" class="{{ $inputClassW }}" value="{{ old('jabatan_partner', $tracer->jabatan_partner ?? '') }}"/>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Email Partner</label>
                            <input type="email" name="email_partner" class="{{ $inputClassW }}" value="{{ old('email_partner', $tracer->email_partner ?? '') }}"/>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══ 5C. STUDI LANJUT ══ --}}
            <div id="section_studi_lanjut" class="hidden">
                <div class="bg-white/[0.03] border border-purple-500/20 rounded-2xl p-6 mb-4">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-purple-500/10">
                        <div class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h2 class="font-semibold text-purple-400">Info Studi Lanjut</h2>
                    </div>

                    @php $inputClassS = "w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 transition"; @endphp

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Lokasi Studi Lanjut</label>
                            <select name="lokasi_studi_lanjut" class="{{ $inputClassS }}">
                                <option value="" class="bg-[#1a1a2e]">-- Pilih --</option>
                                <option value="Dalam Negeri" class="bg-[#1a1a2e]" {{ old('lokasi_studi_lanjut', $tracer->lokasi_studi_lanjut ?? '') == 'Dalam Negeri' ? 'selected' : '' }}>Dalam Negeri</option>
                                <option value="Luar Negeri" class="bg-[#1a1a2e]" {{ old('lokasi_studi_lanjut', $tracer->lokasi_studi_lanjut ?? '') == 'Luar Negeri' ? 'selected' : '' }}>Luar Negeri</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Alasan Melanjutkan Studi</label>
                            <select name="alasan_studi_lanjut" class="{{ $inputClassS }}">
                                <option value="" class="bg-[#1a1a2e]">-- Pilih --</option>
                                @foreach(['Ingin meningkatkan kompetensi','Syarat karir / pekerjaan','Beasiswa','Keinginan sendiri','Dorongan keluarga','Lainnya'] as $opt)
                                    <option value="{{ $opt }}" class="bg-[#1a1a2e]" {{ old('alasan_studi_lanjut', $tracer->alasan_studi_lanjut ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Sumber Biaya Kuliah S2</label>
                            <select name="biaya_studi_lanjut" class="{{ $inputClassS }}">
                                <option value="" class="bg-[#1a1a2e]">-- Pilih --</option>
                                <option value="Biaya sendiri" class="bg-[#1a1a2e]" {{ old('biaya_studi_lanjut', $tracer->biaya_studi_lanjut ?? '') == 'Biaya sendiri' ? 'selected' : '' }}>Biaya sendiri</option>
                                <option value="Beasiswa" class="bg-[#1a1a2e]" {{ old('biaya_studi_lanjut', $tracer->biaya_studi_lanjut ?? '') == 'Beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Nama Perguruan Tinggi</label>
                            <input type="text" name="nama_kampus_lanjut" class="{{ $inputClassS }}" value="{{ old('nama_kampus_lanjut', $tracer->nama_kampus_lanjut ?? '') }}"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Program Studi</label>
                            <input type="text" name="prodi_lanjut" class="{{ $inputClassS }}" value="{{ old('prodi_lanjut', $tracer->prodi_lanjut ?? '') }}"/>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Kota Kampus</label>
                            <input type="text" name="kota_kampus_lanjut" class="{{ $inputClassS }}" value="{{ old('kota_kampus_lanjut', $tracer->kota_kampus_lanjut ?? '') }}"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Negara</label>
                            <input type="text" name="negara_kampus_lanjut" placeholder="Indonesia" class="{{ $inputClassS }}" value="{{ old('negara_kampus_lanjut', $tracer->negara_kampus_lanjut ?? '') }}"/>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk_lanjut" class="{{ $inputClassS }}" value="{{ old('tanggal_masuk_lanjut', $tracer->tanggal_masuk_lanjut ?? '') }}"/>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══ 5D. TIDAK BEKERJA ══ --}}
            <div id="section_tidak_bekerja" class="hidden">
                <div class="bg-white/[0.03] border border-red-500/20 rounded-2xl p-6 mb-4">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-red-500/10">
                        <div class="w-8 h-8 rounded-lg bg-red-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h2 class="font-semibold text-red-400">Alasan Tidak Bekerja</h2>
                    </div>
                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Alasan tidak bekerja</label>
                        <select name="alasan_tidak_bekerja" id="alasan_tidak_bekerja" onchange="toggleAlasanLainnya()"
                                class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-red-500/50 transition">
                            <option value="" class="bg-[#1a1a2e]">-- Pilih salah satu --</option>
                            @foreach(['Mengundurkan diri dari pekerjaan sebelumnya','Habis masa kontrak','Belum mendapat panggilan kerja','Berencana melanjutkan studi','Alasan keluarga','Menikah','Lainnya'] as $opt)
                                <option value="{{ $opt }}" class="bg-[#1a1a2e]" {{ old('alasan_tidak_bekerja', $tracer->alasan_tidak_bekerja ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="alasan_lainnya_div" class="{{ old('alasan_tidak_bekerja', $tracer->alasan_tidak_bekerja ?? '') == 'Lainnya' ? '' : 'hidden' }}">
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Jelaskan (jika Lainnya)</label>
                        <input type="text" name="alasan_tidak_bekerja_lainnya"
                               class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-red-500/50 transition"
                               value="{{ old('alasan_tidak_bekerja_lainnya', $tracer->alasan_tidak_bekerja_lainnya ?? '') }}"/>
                    </div>
                </div>
            </div>

            {{-- ══ 6. KRITIK & SARAN ══ --}}
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6 mb-4">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/[0.06]">
                    <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <h2 class="font-semibold text-white">Kritik & Saran</h2>
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Kritik dan saran untuk kuesioner Tracer Study UMB</label>
                    <textarea name="saran_kuesioner" rows="3" placeholder="Tuliskan kritik dan saran Anda..."
                              class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 transition resize-none">{{ old('saran_kuesioner', $tracer->saran_kuesioner ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Kritik dan saran untuk UMB yang lebih baik</label>
                    <textarea name="saran_umb" rows="3" placeholder="Tuliskan kritik dan saran Anda..."
                              class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 transition resize-none">{{ old('saran_umb', $tracer->saran_umb ?? '') }}</textarea>
                </div>
            </div>

            {{-- ══ 7. PERSETUJUAN ══ --}}
            <div class="bg-white/[0.03] border border-white/[0.08] rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-5 pb-4 border-b border-white/[0.06]">
                    <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h2 class="font-semibold text-white">Persetujuan</h2>
                </div>
                <label class="flex items-start gap-3 cursor-pointer bg-blue-500/5 border border-blue-500/20 rounded-xl p-4 hover:bg-blue-500/10 transition">
                    <input type="checkbox" name="persetujuan" value="1"
                           class="mt-0.5 accent-blue-500 w-4 h-4 flex-shrink-0"
                           {{ old('persetujuan', $tracer->persetujuan ?? false) ? 'checked' : '' }} required/>
                    <span class="text-sm text-gray-400 leading-relaxed">
                        Saya telah mengisi jawaban kuesioner ini dengan <strong class="text-white">benar dan sesuai</strong>.
                        Data yang diberikan akan digunakan untuk keperluan Tracer Study UMB dan dijaga kerahasiaannya.
                    </span>
                </label>
            </div>

            {{-- SUBMIT --}}
            <button type="submit"
                    class="w-full relative overflow-hidden rounded-2xl py-4 font-semibold text-sm text-white
                           transition-all duration-300 hover:scale-[1.01] active:scale-[0.99]"
                    style="background: linear-gradient(135deg, #3b82f6, #6366f1);">
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    {{ $tracer ? 'Simpan Perubahan' : 'Kirim Form Tracer Study' }}
                </span>
            </button>
        </form>
    </div>
</div>

<script>
    function toggleStatusSection() {
        const status = document.getElementById('status_saat_ini').value;
        ['bekerja','wirausaha','studi_lanjut','tidak_bekerja'].forEach(s => {
            document.getElementById('section_' + s).classList.add('hidden');
        });
        if (status === 'bekerja') document.getElementById('section_bekerja').classList.remove('hidden');
        else if (status === 'wirausaha') document.getElementById('section_wirausaha').classList.remove('hidden');
        else if (status === 'studi_lanjut') document.getElementById('section_studi_lanjut').classList.remove('hidden');
        else if (['tidak_bekerja','belum_bekerja'].includes(status)) document.getElementById('section_tidak_bekerja').classList.remove('hidden');
    }
    function toggleAktifLainnya() {
        const val = document.getElementById('aktif_cari_kerja').value;
        document.getElementById('aktif_lainnya_div').classList.toggle('hidden', val !== 'Lainnya');
    }
    function toggleAlasanLainnya() {
        const val = document.getElementById('alasan_tidak_bekerja').value;
        document.getElementById('alasan_lainnya_div').classList.toggle('hidden', val !== 'Lainnya');
    }
    document.addEventListener('DOMContentLoaded', function() {
        toggleStatusSection();
        toggleAktifLainnya();
        toggleAlasanLainnya();
    });
</script>
@endsection     