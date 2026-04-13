<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracer_study', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');

            // Status Kerja
            $table->enum('status_kerja', ['bekerja', 'wirausaha', 'melanjutkan_studi', 'belum_bekerja']);
            $table->string('nama_perusahaan')->nullable();
            $table->string('bidang_perusahaan')->nullable();
            $table->string('posisi_jabatan')->nullable();
            $table->enum('skala_perusahaan', ['lokal', 'nasional', 'multinasional'])->nullable();
            $table->integer('pendapatan_per_bulan')->nullable();
            $table->integer('bulan_tunggu_kerja')->nullable(); // berapa bulan setelah lulus dapat kerja

            // Relevansi
            $table->enum('kesesuaian_bidang', ['sangat_sesuai', 'sesuai', 'kurang_sesuai', 'tidak_sesuai'])->nullable();
            $table->enum('kontribusi_prodi', ['sangat_membantu', 'membantu', 'kurang_membantu', 'tidak_membantu'])->nullable();

            // Studi Lanjut
            $table->string('nama_instansi_studi')->nullable();
            $table->string('program_studi_lanjut')->nullable();
            $table->enum('jenjang_studi_lanjut', ['S2', 'S3', 'profesi', 'lainnya'])->nullable();

            // Wirausaha
            $table->string('nama_usaha')->nullable();
            $table->string('bidang_usaha')->nullable();

            // Saran
            $table->text('saran_untuk_prodi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracer_study');
    }
};