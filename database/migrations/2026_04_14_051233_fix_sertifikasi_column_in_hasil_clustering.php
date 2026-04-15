<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_clustering', function (Blueprint $table) {
            $table->text('sertifikasi')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('hasil_clustering', function (Blueprint $table) {
            $table->string('sertifikasi')->nullable()->change();
        });
    }
};