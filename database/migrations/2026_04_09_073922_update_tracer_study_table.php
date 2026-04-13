<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('tracer_study');
        Schema::create('tracer_study', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');

            // IDENTITAS
            $table->string('tahun_lulus')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('npwp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('sertifikasi')->nullable();

            // SUMBER DANA
            $table->string('sumber_dana')->nullable();

            // METODE PEMBELAJARAN (JSON)
            $table->json('metode_pembelajaran')->nullable();

            // TRANSISI KERJA
            $table->string('mulai_cari_kerja')->nullable();
            $table->integer('jml_lamar')->nullable();
            $table->integer('jml_respon')->nullable();
            $table->integer('jml_wawancara')->nullable();
            $table->string('aktif_cari_kerja')->nullable();
            $table->string('aktif_cari_kerja_lainnya')->nullable();

            // STATUS
            $table->string('status_saat_ini')->nullable();

            // BEKERJA
            $table->string('dapat_kerja_6bulan')->nullable();
            $table->integer('bulan_dapat_kerja')->nullable();
            $table->string('posisi_jabatan')->nullable();
            $table->string('job_title')->nullable();
            $table->bigInteger('pendapatan')->nullable();
            $table->string('provinsi_kerja')->nullable();
            $table->string('kota_kerja')->nullable();
            $table->string('jenis_perusahaan')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('tingkat_perusahaan')->nullable();
            $table->string('bidang_perusahaan')->nullable();
            $table->string('nama_atasan')->nullable();
            $table->string('jabatan_atasan')->nullable();
            $table->string('email_atasan')->nullable();
            $table->string('kesesuaian_bidang')->nullable();
            $table->string('tingkat_pendidikan_sesuai')->nullable();
            $table->json('alasan_tidak_sesuai')->nullable();
            $table->string('alasan_tidak_sesuai_lainnya')->nullable();

            // WIRAUSAHA
            $table->string('posisi_wirausaha')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->integer('bulan_mulai_wirausaha')->nullable();
            $table->string('tingkat_usaha')->nullable();
            $table->string('sosmed_usaha')->nullable();
            $table->bigInteger('omzet')->nullable();
            $table->bigInteger('pendapatan_wirausaha')->nullable();
            $table->string('jumlah_rekan_kerja')->nullable();
            $table->json('legalitas_usaha')->nullable();
            $table->string('legalitas_usaha_lainnya')->nullable();
            $table->json('motivasi_wirausaha')->nullable();
            $table->string('motivasi_wirausaha_lainnya')->nullable();
            $table->string('nama_partner')->nullable();
            $table->string('jabatan_partner')->nullable();
            $table->string('email_partner')->nullable();

            // STUDI LANJUT
            $table->string('lokasi_studi_lanjut')->nullable();
            $table->string('alasan_studi_lanjut')->nullable();
            $table->string('biaya_studi_lanjut')->nullable();
            $table->string('nama_kampus_lanjut')->nullable();
            $table->string('kota_kampus_lanjut')->nullable();
            $table->string('negara_kampus_lanjut')->nullable();
            $table->string('prodi_lanjut')->nullable();
            $table->date('tanggal_masuk_lanjut')->nullable();

            // TIDAK BEKERJA
            $table->string('alasan_tidak_bekerja')->nullable();
            $table->string('alasan_tidak_bekerja_lainnya')->nullable();

            // KOMPETENSI (JSON)
            $table->json('kompetensi_saat_lulus')->nullable();
            $table->json('kompetensi_saat_ini')->nullable();

            // KRITIK SARAN
            $table->text('saran_kuesioner')->nullable();
            $table->text('saran_umb')->nullable();
            $table->boolean('persetujuan')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracer_study');
    }
};