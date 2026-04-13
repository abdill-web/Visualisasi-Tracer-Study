<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TracerStudy;
use App\Models\Mahasiswa;

class VisualisasiController extends Controller
{
    public function index()
    {
        $total = Mahasiswa::count();
        $totalIsi = TracerStudy::count();

        // Distribusi status
        $statusData = TracerStudy::selectRaw('status_saat_ini, count(*) as total')
            ->whereNotNull('status_saat_ini')
            ->groupBy('status_saat_ini')
            ->pluck('total', 'status_saat_ini');

        // Distribusi bidang perusahaan
        $bidangData = TracerStudy::selectRaw('bidang_perusahaan, count(*) as total')
            ->whereNotNull('bidang_perusahaan')
            ->groupBy('bidang_perusahaan')
            ->orderByDesc('total')
            ->pluck('total', 'bidang_perusahaan');

        // Relevansi bidang studi
        $relevansiData = TracerStudy::selectRaw('kesesuaian_bidang, count(*) as total')
            ->whereNotNull('kesesuaian_bidang')
            ->groupBy('kesesuaian_bidang')
            ->pluck('total', 'kesesuaian_bidang');

        // Tren per tahun lulus
        $trenData = TracerStudy::selectRaw('tahun_lulus, status_saat_ini, count(*) as total')
            ->whereNotNull('tahun_lulus')
            ->whereNotNull('status_saat_ini')
            ->groupBy('tahun_lulus', 'status_saat_ini')
            ->orderBy('tahun_lulus')
            ->get();

        // Top provinsi kerja
        $provinsiData = TracerStudy::selectRaw('provinsi_kerja, count(*) as total')
            ->whereNotNull('provinsi_kerja')
            ->groupBy('provinsi_kerja')
            ->orderByDesc('total')
            ->limit(8)
            ->pluck('total', 'provinsi_kerja');

        // Rata-rata pendapatan per prodi
        $pendapatanData = TracerStudy::join('mahasiswa', 'tracer_study.mahasiswa_id', '=', 'mahasiswa.id')
            ->selectRaw('mahasiswa.program_studi, AVG(tracer_study.pendapatan) as avg_pendapatan')
            ->whereNotNull('tracer_study.pendapatan')
            ->where('tracer_study.pendapatan', '>', 0)
            ->groupBy('mahasiswa.program_studi')
            ->orderByDesc('avg_pendapatan')
            ->limit(8)
            ->pluck('avg_pendapatan', 'program_studi');

        return view('admin.visualisasi', compact(
            'total', 'totalIsi',
            'statusData', 'bidangData', 'relevansiData',
            'trenData', 'provinsiData', 'pendapatanData'
        ));
    }
}