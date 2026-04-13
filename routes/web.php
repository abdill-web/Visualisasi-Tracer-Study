<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MahasiswaLoginController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Mahasiswa\TracerStudyController as MahasiswaTracerController;
use App\Http\Controllers\Admin\TracerStudyController as AdminTracerController;

// Halaman utama → redirect ke login mahasiswa
Route::get('/', function () {
    return redirect()->route('mahasiswa.login');
});

// ─── AUTH MAHASISWA ───────────────────────────────────────
Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('login', [MahasiswaLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [MahasiswaLoginController::class, 'login']);
    Route::post('logout', [MahasiswaLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:mahasiswa')->group(function () {
        Route::get('dashboard', function () {
            return view('mahasiswa.dashboard');
        })->name('dashboard');

        Route::get('tracer', [MahasiswaTracerController::class, 'form'])->name('tracer.form');
        Route::post('tracer', [MahasiswaTracerController::class, 'store'])->name('tracer.store');
        Route::get('tracer/edit', [MahasiswaTracerController::class, 'form'])->name('tracer.edit');
        Route::put('tracer/edit', [MahasiswaTracerController::class, 'store'])->name('tracer.update');
    });
});

// ─── AUTH ADMIN (Breeze) ──────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        $total = \App\Models\Mahasiswa::count();
        $sudahIsi = \App\Models\TracerStudy::count();
        $belumIsi = $total - $sudahIsi;
        $responseRate = $total > 0 ? round(($sudahIsi / $total) * 100) : 0;
        return view('admin.dashboard', compact('total', 'sudahIsi', 'belumIsi', 'responseRate'));
    })->name('dashboard');

        // Kelola Mahasiswa
        Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
        Route::get('mahasiswa/import', [MahasiswaController::class, 'importForm'])->name('mahasiswa.import');
        Route::post('mahasiswa/import', [MahasiswaController::class, 'import'])->name('mahasiswa.import.post');
        Route::delete('mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

        // Data Tracer Study
        Route::get('tracer', [AdminTracerController::class, 'index'])->name('tracer.index');
        Route::get('tracer/{id}', [AdminTracerController::class, 'show'])->name('tracer.show');

        // Visualisasi Data
        Route::get('visualisasi', [\App\Http\Controllers\Admin\VisualisasiController::class, 'index'])->name('visualisasi.index');
        Route::post('ai-analysis', [\App\Http\Controllers\Admin\AIAnalysisController::class, 'analyze'])->name('ai.analysis');
    });
});

require __DIR__.'/auth.php';