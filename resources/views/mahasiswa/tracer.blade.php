@extends('layouts.app')

@section('title', 'Form Tracer Study')

@section('content')
<div class="min-h-screen bg-gray-50">

    <nav class="bg-blue-800 text-white px-6 py-4 flex items-center justify-between shadow-lg sticky top-0 z-10">
        <div class="flex items-center gap-3">
            <i class="fas fa-graduation-cap text-xl"></i>
            <span class="font-bold text-lg">Tracer Study</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('mahasiswa.dashboard') }}" class="text-blue-200 hover:text-white text-sm flex items-center gap-1">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
            <span class="text-blue-200 text-sm">{{ Auth::guard('mahasiswa')->user()->nama }}</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto py-8 px-4">

        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Form Tracer Study</h1>
            <p class="text-gray-500 text-sm mt-1">Lulusan D3 & S1 — Mohon isi dengan jujur dan lengkap</p>
        </div>

        @if(session('success'))
        <div class="bg-green-50 border border-green-300 text-green-700 rounded-xl px-4 py-3 mb-6 text-sm flex items-center gap-2">
            <i class="fas fa-circle-check"></i> {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ $tracer ? route('mahasiswa.tracer.update') : route('mahasiswa.tracer.store') }}">
            @csrf
            @if($tracer) @method('PUT') @endif

            {{-- ══ 1. IDENTITAS ══ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-5">
                <div class="flex items-center gap-2 mb-5 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-blue-600 text-sm"></i>
                    </div>
                    <h2 class="font-bold text-gray-800">Identitas Data Pribadi</h2>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Nama</label>
                        <input type="text" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm bg-gray-50 text-gray-600 cursor-not-allowed" value="{{ $mahasiswa->nama }}" disabled/>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">NIM</label>
                        <input type="text" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm bg-gray-50 text-gray-600 cursor-not-allowed" value="{{ $mahasiswa->nim }}" disabled/>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Program Studi</label>
                        <input type="text" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm bg-gray-50 text-gray-600 cursor-not-allowed" value="{{ $mahasiswa->program_studi }}" disabled/>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Tahun Lulus <span class="text-red-500 normal-case">*</span></label>
                        <input type="text" name="tahun_lulus" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" placeholder="Contoh: 2024" value="{{ old('tahun_lulus', $tracer->tahun_lulus ?? '') }}"/>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">No. Telepon/WA Aktif <span class="text-red-500 normal-case">*</span></label>
                        <input type="text" name="no_telepon" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" placeholder="08123456789" value="{{ old('no_telepon', $tracer->no_telepon ?? '') }}"/>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Email Aktif <span class="text-red-500 normal-case">*</span></label>
                        <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" placeholder="email@gmail.com" value="{{ old('email', $tracer->email ?? '') }}"/>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">NPWP</label>
                    <input type="text" name="npwp" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" placeholder="Isi angka saja tanpa titik atau strip. Jika tidak punya, isi angka 0" value="{{ old('npwp', $tracer->npwp ?? '') }}"/>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Instagram</label>
                        <input type="text" name="instagram" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" placeholder="@username" value="{{ old('instagram', $tracer->instagram ?? '') }}"/>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">LinkedIn</label>
                        <input type="text" name="linkedin" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" placeholder="linkedin.com/in/username" value="{{ old('linkedin', $tracer->linkedin ?? '') }}"/>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Sertifikasi Profesi (setelah lulus)</label>
                    <input type="text" name="sertifikasi" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" placeholder="Contoh: Google Analytics, AWS. Kosongkan jika tidak ada." value="{{ old('sertifikasi', $tracer->sertifikasi ?? '') }}"/>
                </div>
            </div>

            {{-- ══ 2. SUMBER DANA ══ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-5">
                <div class="flex items-center gap-2 mb-5 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-wallet text-blue-600 text-sm"></i>
                    </div>
                    <h2 class="font-bold text-gray-800">Sumber Dana Kuliah</h2>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Sumber dana pembiayaan kuliah di UMB <span class="text-red-500 normal-case">*</span></label>
                    <select name="sumber_dana" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                        <option value="">-- Pilih salah satu --</option>
                        @foreach(['Biaya sendiri / keluarga','Beasiswa pemerintah (Bidikmisi/KIP)','Beasiswa swasta','Beasiswa UMB','Pinjaman / kredit pendidikan','Lainnya'] as $opt)
                            <option value="{{ $opt }}" {{ old('sumber_dana', $tracer->sumber_dana ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- ══ 3. TRANSISI KERJA ══ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-5">
                <div class="flex items-center gap-2 mb-5 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-briefcase text-blue-600 text-sm"></i>
                    </div>
                    <h2 class="font-bold text-gray-800">Masa Transisi ke Dunia Kerja</h2>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Kapan Anda mulai mencari pekerjaan? <span class="text-red-500 normal-case">*</span></label>
                    <p class="text-xs text-gray-400 mb-1">Mohon pekerjaan sambilan (freelance) tidak dimasukkan</p>
                    <select name="mulai_cari_kerja" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                        <option value="">-- Pilih salah satu --</option>
                        @foreach(['Sebelum lulus','Setelah lulus','Saya tidak mencari kerja'] as $opt)
                            <option value="{{ $opt }}" {{ old('mulai_cari_kerja', $tracer->mulai_cari_kerja ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-3 gap-3 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Jumlah Dilamar</label>
                        <p class="text-xs text-gray-400 mb-1">Isi 0 jika wirausaha</p>
                        <input type="number" name="jml_lamar" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" placeholder="0" value="{{ old('jml_lamar', $tracer->jml_lamar ?? '') }}"/>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Jumlah Merespon</label>
                        <p class="text-xs text-gray-400 mb-1">&nbsp;</p>
                        <input type="number" name="jml_respon" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" placeholder="0" value="{{ old('jml_respon', $tracer->jml_respon ?? '') }}"/>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Undangan Interview</label>
                        <p class="text-xs text-gray-400 mb-1">&nbsp;</p>
                        <input type="number" name="jml_wawancara" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" placeholder="0" value="{{ old('jml_wawancara', $tracer->jml_wawancara ?? '') }}"/>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Apakah aktif mencari kerja dalam 4 minggu terakhir?</label>
                    <select name="aktif_cari_kerja" id="aktif_cari_kerja" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" onchange="toggleAktifLainnya()">
                        <option value="">-- Pilih salah satu --</option>
                        @foreach(['Tidak','Tidak, tapi sedang menunggu hasil lamaran','Ya, akan mulai bekerja dalam 2 minggu ke depan','Ya, tapi belum pasti dalam 2 minggu ke depan','Lainnya'] as $opt)
                            <option value="{{ $opt }}" {{ old('aktif_cari_kerja', $tracer->aktif_cari_kerja ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="aktif_lainnya_div" class="{{ old('aktif_cari_kerja', $tracer->aktif_cari_kerja ?? '') == 'Lainnya' ? '' : 'hidden' }}">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Jelaskan (jika memilih Lainnya)</label>
                    <input type="text" name="aktif_cari_kerja_lainnya" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" value="{{ old('aktif_cari_kerja_lainnya', $tracer->aktif_cari_kerja_lainnya ?? '') }}"/>
                </div>
            </div>

            {{-- ══ 4. STATUS SAAT INI ══ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-5">
                <div class="flex items-center gap-2 mb-5 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-circle-dot text-blue-600 text-sm"></i>
                    </div>
                    <h2 class="font-bold text-gray-800">Status Saat Ini</h2>
                </div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Jelaskan status Anda saat ini <span class="text-red-500 normal-case">*</span></label>
                <select name="status_saat_ini" id="status_saat_ini" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" onchange="toggleStatusSection()">
                    <option value="">-- Pilih salah satu --</option>
                    <option value="bekerja" {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'bekerja' ? 'selected' : '' }}>Bekerja (Full Time)</option>
                    <option value="wirausaha" {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'wirausaha' ? 'selected' : '' }}>Wiraswasta / Wirausaha (termasuk Freelancer, Content Creator)</option>
                    <option value="studi_lanjut" {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'studi_lanjut' ? 'selected' : '' }}>Melanjutkan Pendidikan</option>
                    <option value="tidak_bekerja" {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'tidak_bekerja' ? 'selected' : '' }}>Tidak Kerja (sedang mencari kerja)</option>
                    <option value="belum_bekerja" {{ old('status_saat_ini', $tracer->status_saat_ini ?? '') == 'belum_bekerja' ? 'selected' : '' }}>Belum memungkinkan untuk bekerja</option>
                </select>
            </div>

            {{-- ══ 5A. BEKERJA ══ --}}
            <div id="section_bekerja" class="hidden">
                <div class="bg-white rounded-2xl shadow-sm border border-green-200 p-6 mb-5">
                    <div class="flex items-center gap-2 mb-5 pb-3 border-b border-green-100">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-building text-green-600 text-sm"></i>
                        </div>
                        <h2 class="font-bold text-green-800">Info Pekerjaan</h2>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Mendapat kerja ≤ 6 bulan / sebelum lulus?</label>
                            <select name="dapat_kerja_6bulan" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih --</option>
                                <option value="Ya" {{ old('dapat_kerja_6bulan', $tracer->dapat_kerja_6bulan ?? '') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('dapat_kerja_6bulan', $tracer->dapat_kerja_6bulan ?? '') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Berapa bulan mendapat pekerjaan?</label>
                            <input type="number" name="bulan_dapat_kerja" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Contoh: 3" value="{{ old('bulan_dapat_kerja', $tracer->bulan_dapat_kerja ?? '') }}"/>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Posisi / Jabatan</label>
                            <input type="text" name="posisi_jabatan" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Contoh: Staff Marketing" value="{{ old('posisi_jabatan', $tracer->posisi_jabatan ?? '') }}"/>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Job Title (Detail)</label>
                            <input type="text" name="job_title" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Contoh: Digital Marketing Specialist" value="{{ old('job_title', $tracer->job_title ?? '') }}"/>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Contoh: PT Jaya Jaya" value="{{ old('nama_perusahaan', $tracer->nama_perusahaan ?? '') }}"/>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Jenis Perusahaan</label>
                            <select name="jenis_perusahaan" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih --</option>
                                @foreach(['BUMN','Swasta Nasional','Swasta Asing/Multinasional','Instansi Pemerintah','TNI/Polri','Organisasi Non-profit','Lainnya'] as $opt)
                                    <option value="{{ $opt }}" {{ old('jenis_perusahaan', $tracer->jenis_perusahaan ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Bidang / Sektor</label>
                            <select name="bidang_perusahaan" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih --</option>
                                @foreach(['Teknologi Informasi','Perbankan & Keuangan','Pendidikan','Kesehatan','Manufaktur','Perdagangan & Retail','Media & Komunikasi','Konsultan','Pemerintahan','Transportasi & Logistik','Properti','Lainnya'] as $opt)
                                    <option value="{{ $opt }}" {{ old('bidang_perusahaan', $tracer->bidang_perusahaan ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Tingkat Perusahaan</label>
                            <select name="tingkat_perusahaan" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih --</option>
                                @foreach(['Lokal / Wiraswasta tidak berbadan hukum','Nasional / Wiraswasta berbadan hukum','Multinasional / Internasional'] as $opt)
                                    <option value="{{ $opt }}" {{ old('tingkat_perusahaan', $tracer->tingkat_perusahaan ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Provinsi Tempat Kerja</label>
                            <select name="provinsi_kerja" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih --</option>
                                @foreach(['DKI Jakarta','Jawa Barat','Jawa Tengah','Jawa Timur','Banten','DI Yogyakarta','Bali','Sumatera Utara','Sumatera Selatan','Kalimantan Timur','Sulawesi Selatan','Lainnya'] as $prov)
                                    <option value="{{ $prov }}" {{ old('provinsi_kerja', $tracer->provinsi_kerja ?? '') == $prov ? 'selected' : '' }}>{{ $prov }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Kota Tempat Kerja</label>
                            <input type="text" name="kota_kerja" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Contoh: Jakarta Selatan" value="{{ old('kota_kerja', $tracer->kota_kerja ?? '') }}"/>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Rata-rata Pendapatan per Bulan (Rp)</label>
                        <p class="text-xs text-gray-400 mb-1">Termasuk gaji pokok, tunjangan, dan pendapatan lainnya</p>
                        <input type="number" name="pendapatan" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Contoh: 5000000" value="{{ old('pendapatan', $tracer->pendapatan ?? '') }}"/>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Kesesuaian Bidang Studi</label>
                            <select name="kesesuaian_bidang" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih --</option>
                                @foreach(['Sangat erat','Erat','Cukup erat','Kurang erat','Tidak sama sekali'] as $opt)
                                    <option value="{{ $opt }}" {{ old('kesesuaian_bidang', $tracer->kesesuaian_bidang ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Tingkat Pendidikan yang Sesuai</label>
                            <select name="tingkat_pendidikan_sesuai" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih --</option>
                                @foreach(['Setingkat lebih tinggi','Tingkat yang sama','Setingkat lebih rendah','Tidak perlu pendidikan tinggi'] as $opt)
                                    <option value="{{ $opt }}" {{ old('tingkat_pendidikan_sesuai', $tracer->tingkat_pendidikan_sesuai ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Data Atasan — untuk Survey Pengguna</p>
                        <div class="grid grid-cols-2 gap-4 mb-3">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Nama Atasan</label>
                                <input type="text" name="nama_atasan" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white" value="{{ old('nama_atasan', $tracer->nama_atasan ?? '') }}"/>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Jabatan Atasan</label>
                                <input type="text" name="jabatan_atasan" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white" value="{{ old('jabatan_atasan', $tracer->jabatan_atasan ?? '') }}"/>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Email Atasan</label>
                            <input type="email" name="email_atasan" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white" placeholder="Akan digunakan untuk Survey Penilaian Pengguna" value="{{ old('email_atasan', $tracer->email_atasan ?? '') }}"/>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══ 5B. WIRAUSAHA ══ --}}
            <div id="section_wirausaha" class="hidden">
                <div class="bg-white rounded-2xl shadow-sm border border-orange-200 p-6 mb-5">
                    <div class="flex items-center gap-2 mb-5 pb-3 border-b border-orange-100">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-store text-orange-500 text-sm"></i>
                        </div>
                        <h2 class="font-bold text-orange-700">Info Wirausaha</h2>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Posisi di Usaha</label>
                            <select name="posisi_wirausaha" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih --</option>
                                @foreach(['Founder','Co-Founder','Staff','Freelance / Kerja Lepas (termasuk konten creator, influencer)'] as $opt)
                                    <option value="{{ $opt }}" {{ old('posisi_wirausaha', $tracer->posisi_wirausaha ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Jenis Usaha</label>
                            <select name="jenis_usaha" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih --</option>
                                @foreach(['Kuliner / F&B','Fashion & Kecantikan','Teknologi / Startup','Jasa Konsultan','Pendidikan','Perdagangan','Konten Digital','Lainnya'] as $opt)
                                    <option value="{{ $opt }}" {{ old('jenis_usaha', $tracer->jenis_usaha ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Bulan Setelah Lulus Mulai Wirausaha</label>
                            <input type="number" name="bulan_mulai_wirausaha" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Contoh: 3" value="{{ old('bulan_mulai_wirausaha', $tracer->bulan_mulai_wirausaha ?? '') }}"/>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Tingkat Usaha</label>
                            <select name="tingkat_usaha" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih --</option>
                                @foreach(['Lokal / Wiraswasta tidak berbadan hukum','Nasional / Wiraswasta berbadan hukum','Multinasional / Internasional'] as $opt)
                                    <option value="{{ $opt }}" {{ old('tingkat_usaha', $tracer->tingkat_usaha ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Akun TikTok / Instagram Usaha</label>
                            <input type="text" name="sosmed_usaha" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="@namaakun" value="{{ old('sosmed_usaha', $tracer->sosmed_usaha ?? '') }}"/>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Jumlah Rekan Kerja</label>
                            <select name="jumlah_rekan_kerja" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih --</option>
                                @foreach(['< 5','≥ 5 s.d. < 10','≥ 10 s.d. < 25','≥ 25 s.d. < 50','≥ 50'] as $opt)
                                    <option value="{{ $opt }}" {{ old('jumlah_rekan_kerja', $tracer->jumlah_rekan_kerja ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Omzet per Bulan (Rp)</label>
                            <p class="text-xs text-gray-400 mb-1">Pendapatan kotor</p>
                            <input type="number" name="omzet" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('omzet', $tracer->omzet ?? '') }}"/>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Pendapatan Pribadi per Bulan (Rp)</label>
                            <p class="text-xs text-gray-400 mb-1">Take home pay</p>
                            <input type="number" name="pendapatan_wirausaha" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('pendapatan_wirausaha', $tracer->pendapatan_wirausaha ?? '') }}"/>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Motivasi Berwirausaha <span class="normal-case text-gray-400 font-normal">(boleh pilih lebih dari satu)</span></label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach(['Ingin mandiri secara finansial','Tidak ingin terikat jam kerja','Meneruskan usaha keluarga','Sulit mendapat pekerjaan','Passion / hobi','Ingin menciptakan lapangan kerja','Lainnya'] as $mot)
                                @php $checked = in_array($mot, json_decode($tracer->motivasi_wirausaha ?? '[]', true) ?? []); @endphp
                                <label class="flex items-center gap-2 text-sm text-gray-700 bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 cursor-pointer hover:bg-blue-50 hover:border-blue-300 transition">
                                    <input type="checkbox" name="motivasi_wirausaha[]" value="{{ $mot }}" {{ $checked ? 'checked' : '' }} class="accent-blue-600"/>
                                    {{ $mot }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Motivasi Lainnya</label>
                        <input type="text" name="motivasi_wirausaha_lainnya" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Isi jika memilih 'Lainnya' di atas" value="{{ old('motivasi_wirausaha_lainnya', $tracer->motivasi_wirausaha_lainnya ?? '') }}"/>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Data Partner Kerja — untuk Survey Pengguna</p>
                        <div class="grid grid-cols-2 gap-4 mb-3">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Nama Partner</label>
                                <input type="text" name="nama_partner" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white" value="{{ old('nama_partner', $tracer->nama_partner ?? '') }}"/>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Jabatan Partner</label>
                                <input type="text" name="jabatan_partner" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white" value="{{ old('jabatan_partner', $tracer->jabatan_partner ?? '') }}"/>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Email Partner</label>
                            <input type="email" name="email_partner" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white" value="{{ old('email_partner', $tracer->email_partner ?? '') }}"/>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══ 5C. STUDI LANJUT ══ --}}
            <div id="section_studi_lanjut" class="hidden">
                <div class="bg-white rounded-2xl shadow-sm border border-purple-200 p-6 mb-5">
                    <div class="flex items-center gap-2 mb-5 pb-3 border-b border-purple-100">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-book-open text-purple-600 text-sm"></i>
                        </div>
                        <h2 class="font-bold text-purple-800">Info Studi Lanjut</h2>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Lokasi Studi Lanjut</label>
                            <select name="lokasi_studi_lanjut" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih --</option>
                                <option value="Dalam Negeri" {{ old('lokasi_studi_lanjut', $tracer->lokasi_studi_lanjut ?? '') == 'Dalam Negeri' ? 'selected' : '' }}>Dalam Negeri</option>
                                <option value="Luar Negeri" {{ old('lokasi_studi_lanjut', $tracer->lokasi_studi_lanjut ?? '') == 'Luar Negeri' ? 'selected' : '' }}>Luar Negeri</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Alasan Melanjutkan Studi</label>
                            <select name="alasan_studi_lanjut" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih --</option>
                                @foreach(['Ingin meningkatkan kompetensi','Syarat karir / pekerjaan','Beasiswa','Keinginan sendiri','Dorongan keluarga','Lainnya'] as $opt)
                                    <option value="{{ $opt }}" {{ old('alasan_studi_lanjut', $tracer->alasan_studi_lanjut ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Sumber Biaya Kuliah S2</label>
                            <select name="biaya_studi_lanjut" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">-- Pilih --</option>
                                <option value="Biaya sendiri" {{ old('biaya_studi_lanjut', $tracer->biaya_studi_lanjut ?? '') == 'Biaya sendiri' ? 'selected' : '' }}>Biaya sendiri</option>
                                <option value="Beasiswa" {{ old('biaya_studi_lanjut', $tracer->biaya_studi_lanjut ?? '') == 'Beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Nama Perguruan Tinggi</label>
                            <input type="text" name="nama_kampus_lanjut" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('nama_kampus_lanjut', $tracer->nama_kampus_lanjut ?? '') }}"/>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Program Studi</label>
                            <input type="text" name="prodi_lanjut" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('prodi_lanjut', $tracer->prodi_lanjut ?? '') }}"/>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Kota Kampus</label>
                            <input type="text" name="kota_kampus_lanjut" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('kota_kampus_lanjut', $tracer->kota_kampus_lanjut ?? '') }}"/>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Negara</label>
                            <input type="text" name="negara_kampus_lanjut" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Indonesia" value="{{ old('negara_kampus_lanjut', $tracer->negara_kampus_lanjut ?? '') }}"/>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk_lanjut" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('tanggal_masuk_lanjut', $tracer->tanggal_masuk_lanjut ?? '') }}"/>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══ 5D. TIDAK BEKERJA ══ --}}
            <div id="section_tidak_bekerja" class="hidden">
                <div class="bg-white rounded-2xl shadow-sm border border-red-200 p-6 mb-5">
                    <div class="flex items-center gap-2 mb-5 pb-3 border-b border-red-100">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-circle-xmark text-red-500 text-sm"></i>
                        </div>
                        <h2 class="font-bold text-red-700">Alasan Tidak Bekerja</h2>
                    </div>
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Alasan tidak bekerja</label>
                        <select name="alasan_tidak_bekerja" id="alasan_tidak_bekerja" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" onchange="toggleAlasanLainnya()">
                            <option value="">-- Pilih salah satu --</option>
                            @foreach(['Mengundurkan diri dari pekerjaan sebelumnya','Habis masa kontrak','Belum mendapat panggilan kerja','Berencana melanjutkan studi','Alasan keluarga','Menikah','Lainnya'] as $opt)
                                <option value="{{ $opt }}" {{ old('alasan_tidak_bekerja', $tracer->alasan_tidak_bekerja ?? '') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="alasan_lainnya_div" class="{{ old('alasan_tidak_bekerja', $tracer->alasan_tidak_bekerja ?? '') == 'Lainnya' ? '' : 'hidden' }}">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Jelaskan (jika memilih Lainnya)</label>
                        <input type="text" name="alasan_tidak_bekerja_lainnya" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('alasan_tidak_bekerja_lainnya', $tracer->alasan_tidak_bekerja_lainnya ?? '') }}"/>
                    </div>
                </div>
            </div>

            {{-- ══ 6. KRITIK & SARAN ══ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-5">
                <div class="flex items-center gap-2 mb-5 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-comment-dots text-blue-600 text-sm"></i>
                    </div>
                    <h2 class="font-bold text-gray-800">Kritik & Saran</h2>
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Kritik dan saran untuk kuesioner Tracer Study UMB</label>
                    <textarea name="saran_kuesioner" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none" placeholder="Tuliskan kritik dan saran Anda...">{{ old('saran_kuesioner', $tracer->saran_kuesioner ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Kritik dan saran untuk UMB yang lebih baik</label>
                    <textarea name="saran_umb" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none" placeholder="Tuliskan kritik dan saran Anda...">{{ old('saran_umb', $tracer->saran_umb ?? '') }}</textarea>
                </div>
            </div>

            {{-- ══ 7. PERSETUJUAN ══ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex items-center gap-2 mb-4 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-shield-check text-blue-600 text-sm"></i>
                    </div>
                    <h2 class="font-bold text-gray-800">Persetujuan</h2>
                </div>
                <label class="flex items-start gap-3 cursor-pointer bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <input type="checkbox" name="persetujuan" value="1" class="mt-0.5 accent-blue-600 w-4 h-4 flex-shrink-0"
                           {{ old('persetujuan', $tracer->persetujuan ?? false) ? 'checked' : '' }} required/>
                    <span class="text-sm text-gray-700 leading-relaxed">
                        Saya telah mengisi jawaban kuesioner ini dengan <strong>benar dan sesuai</strong>.
                        Data yang diberikan akan digunakan untuk keperluan Tracer Study UMB dan dijaga kerahasiaannya.
                    </span>
                </label>
            </div>

            {{-- SUBMIT --}}
            <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 active:bg-blue-900 text-white font-bold py-4 rounded-xl transition text-base flex items-center justify-center gap-2 shadow-lg">
                <i class="fas fa-paper-plane"></i>
                {{ $tracer ? 'Simpan Perubahan' : 'Kirim Form Tracer Study' }}
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