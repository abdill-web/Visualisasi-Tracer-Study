<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_clustering', function (Blueprint $table) {
            $table->id();
            $table->string('program_studi');
            $table->string('sertifikasi')->nullable();
            $table->string('metode_perkuliahan')->nullable();
            $table->string('metode_demonstrasi')->nullable();
            $table->string('metode_riset')->nullable();
            $table->string('metode_magang')->nullable();
            $table->string('metode_praktikum')->nullable();
            $table->string('metode_kerja_lapangan')->nullable();
            $table->string('metode_diskusi')->nullable();
            $table->integer('jml_lamar')->nullable();
            $table->integer('jml_respon')->nullable();
            $table->integer('jml_wawancara')->nullable();
            $table->decimal('kompetensi_etika', 3, 1)->nullable();
            $table->decimal('kompetensi_keahlian', 3, 1)->nullable();
            $table->decimal('kompetensi_bahasa_inggris', 3, 1)->nullable();
            $table->decimal('kompetensi_teknologi', 3, 1)->nullable();
            $table->decimal('kompetensi_komunikasi', 3, 1)->nullable();
            $table->decimal('kompetensi_kerjasama', 3, 1)->nullable();
            $table->decimal('kompetensi_pengembangan_diri', 3, 1)->nullable();
            $table->decimal('kompetensi_etos_kerja', 3, 1)->nullable();
            $table->decimal('kompetensi_kolaborasi', 3, 1)->nullable();
            $table->decimal('kompetensi_fleksibilitas', 3, 1)->nullable();
            $table->decimal('kompetensi_literasi', 3, 1)->nullable();
            $table->decimal('kompetensi_inisiatif', 3, 1)->nullable();
            $table->decimal('kompetensi_kepemimpinan', 3, 1)->nullable();
            $table->decimal('kompetensi_wirausaha', 3, 1)->nullable();
            $table->decimal('kompetensi_lifelong_learning', 3, 1)->nullable();
            $table->integer('label_cluster');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_clustering');
    }
};