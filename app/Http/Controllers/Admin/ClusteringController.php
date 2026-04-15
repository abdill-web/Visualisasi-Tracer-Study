<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilClustering;
use Illuminate\Http\Request;

class ClusteringController extends Controller
{
    public function index()
    {
        $total = HasilClustering::count();
        $cluster0 = HasilClustering::where('label_cluster', 0)->count();
        $cluster1 = HasilClustering::where('label_cluster', 1)->count();

        // Distribusi per prodi
        $perProdi = HasilClustering::selectRaw('program_studi, label_cluster, count(*) as total')
            ->groupBy('program_studi', 'label_cluster')
            ->orderBy('program_studi')
            ->get();

        // Rata-rata kompetensi per cluster
        $kompetensiCluster = HasilClustering::selectRaw('
            label_cluster,
            AVG(kompetensi_etika) as etika,
            AVG(kompetensi_keahlian) as keahlian,
            AVG(kompetensi_bahasa_inggris) as bahasa_inggris,
            AVG(kompetensi_teknologi) as teknologi,
            AVG(kompetensi_komunikasi) as komunikasi,
            AVG(kompetensi_kerjasama) as kerjasama,
            AVG(kompetensi_pengembangan_diri) as pengembangan_diri,
            AVG(kompetensi_kepemimpinan) as kepemimpinan
        ')
        ->groupBy('label_cluster')
        ->get();

        return view('admin.clustering.index', compact(
            'total', 'cluster0', 'cluster1', 'perProdi', 'kompetensiCluster'
        ));
    }

    public function importForm()
    {
        return view('admin.clustering.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getPathname(), 'r');

        // Skip header
        fgetcsv($handle);

        $imported = 0;

        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < 2) continue;

            $labelCluster = trim(end($row));
            if (!in_array($labelCluster, ['0', '1'])) continue;

            HasilClustering::create([
                'program_studi'              => trim($row[0] ?? ''),
                'sertifikasi'                => trim($row[1] ?? '') ?: null,
                'metode_perkuliahan'         => trim($row[2] ?? '') ?: null,
                'metode_demonstrasi'         => trim($row[3] ?? '') ?: null,
                'metode_riset'               => trim($row[4] ?? '') ?: null,
                'metode_magang'              => trim($row[5] ?? '') ?: null,
                'metode_praktikum'           => trim($row[6] ?? '') ?: null,
                'metode_kerja_lapangan'      => trim($row[7] ?? '') ?: null,
                'metode_diskusi'             => trim($row[8] ?? '') ?: null,
                'jml_lamar'                  => is_numeric(trim($row[9] ?? '')) ? (int)trim($row[9]) : null,
                'jml_respon'                 => is_numeric(trim($row[10] ?? '')) ? (int)trim($row[10]) : null,
                'jml_wawancara'              => is_numeric(trim($row[11] ?? '')) ? (int)trim($row[11]) : null,
                'kompetensi_etika'           => is_numeric(trim($row[12] ?? '')) ? (float)trim($row[12]) : null,
                'kompetensi_keahlian'        => is_numeric(trim($row[13] ?? '')) ? (float)trim($row[13]) : null,
                'kompetensi_bahasa_inggris'  => is_numeric(trim($row[14] ?? '')) ? (float)trim($row[14]) : null,
                'kompetensi_teknologi'       => is_numeric(trim($row[15] ?? '')) ? (float)trim($row[15]) : null,
                'kompetensi_komunikasi'      => is_numeric(trim($row[16] ?? '')) ? (float)trim($row[16]) : null,
                'kompetensi_kerjasama'       => is_numeric(trim($row[17] ?? '')) ? (float)trim($row[17]) : null,
                'kompetensi_pengembangan_diri' => is_numeric(trim($row[18] ?? '')) ? (float)trim($row[18]) : null,
                'kompetensi_etos_kerja'      => is_numeric(trim($row[19] ?? '')) ? (float)trim($row[19]) : null,
                'kompetensi_kolaborasi'      => is_numeric(trim($row[20] ?? '')) ? (float)trim($row[20]) : null,
                'kompetensi_fleksibilitas'   => is_numeric(trim($row[21] ?? '')) ? (float)trim($row[21]) : null,
                'kompetensi_literasi'        => is_numeric(trim($row[22] ?? '')) ? (float)trim($row[22]) : null,
                'kompetensi_inisiatif'       => is_numeric(trim($row[23] ?? '')) ? (float)trim($row[23]) : null,
                'kompetensi_kepemimpinan'    => is_numeric(trim($row[24] ?? '')) ? (float)trim($row[24]) : null,
                'kompetensi_wirausaha'       => is_numeric(trim($row[25] ?? '')) ? (float)trim($row[25]) : null,
                'kompetensi_lifelong_learning' => is_numeric(trim($row[26] ?? '')) ? (float)trim($row[26]) : null,
                'label_cluster'              => (int)$labelCluster,
            ]);
            $imported++;
        }

        fclose($handle);

        return redirect()->route('admin.clustering.index')
            ->with('success', "Berhasil import {$imported} data clustering.");
    }
}