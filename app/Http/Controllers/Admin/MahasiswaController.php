<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::withCount('tracerStudy')->paginate(15);
        $total = Mahasiswa::count();
        $sudahIsi = Mahasiswa::whereHas('tracerStudy')->count();
        $belumIsi = $total - $sudahIsi;
        $responseRate = $total > 0 ? round(($sudahIsi / $total) * 100) : 0;

        return view('admin.mahasiswa.index', compact(
            'mahasiswa', 'total', 'sudahIsi', 'belumIsi', 'responseRate'
        ));
    }

    public function importForm()
    {
        return view('admin.mahasiswa.import');
    }

public function import(Request $request)
{
    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt',
    ]);

    $file = $request->file('csv_file');
    $handle = fopen($file->getPathname(), 'r');

    $header = fgetcsv($handle, 0, ',');
    $header[0] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $header[0]);
    $headerMap = array_flip(array_map('trim', $header));

    $imported = 0;
    $skipped = 0;

    // Map bulan Indonesia ke angka
    $bulanMap = [
        'Jan' => '01', 'Feb' => '02', 'Mar' => '03', 'Apr' => '04',
        'Mei' => '05', 'Jun' => '06', 'Jul' => '07', 'Agt' => '08',
        'Ago' => '08', 'Sep' => '09', 'Okt' => '10', 'Nov' => '11',
        'Des' => '12',
    ];

while (($row = fgetcsv($handle, 0, ',')) !== false) {
    if (count($row) < 2) continue;

    $nim           = trim($row[$headerMap['NIM']] ?? '');
    $nama          = trim($row[$headerMap['MHSNAMA']] ?? '');
    $tgl_lahir_raw = trim($row[$headerMap['TGL LAHIR']] ?? '');
    $jurusan       = trim($row[$headerMap['JURUSAN']] ?? '');

    // Ambil tahun lulus dari SEMESTER LULUS atau TGL YUDISIUM
    $tahun_lulus = null;
    $semesterLulus = trim($row[$headerMap['SEMESTER LULUS']] ?? '');
    $tglYudisium   = trim($row[$headerMap['TGL YUDISIUM']] ?? '');

    if (!empty($tglYudisium)) {
        // Extract tahun dari "28 Februari 2025" → 2025
        preg_match('/\d{4}/', $tglYudisium, $matches);
        $tahun_lulus = $matches[0] ?? null;
    } elseif (!empty($semesterLulus)) {
        // Extract tahun dari "GANJIL TA 2024/2025" → 2025
        preg_match('/\d{4}/', $semesterLulus, $matches);
        $tahun_lulus = $matches[0] ?? null;
    }

    if (empty($nim)) continue;

    // Convert tanggal lahir
    $tgl_lahir = null;
    if (!empty($tgl_lahir_raw)) {
        $parts = explode('-', $tgl_lahir_raw);
        if (count($parts) === 3) {
            $day   = str_pad($parts[0], 2, '0', STR_PAD_LEFT);
            $month = $bulanMap[$parts[1]] ?? '01';
            $year  = $parts[2];
            if (strlen($year) === 2) {
                $year = ($year > 30) ? '19' . $year : '20' . $year;
            }
            $tgl_lahir = "{$year}-{$month}-{$day}";
        }
    }

    if (Mahasiswa::where('nim', $nim)->exists()) {
        $skipped++;
        continue;
    }

    Mahasiswa::create([
        'nim'           => $nim,
        'nama'          => $nama,
        'tanggal_lahir' => $tgl_lahir,
        'program_studi' => $jurusan,
        'fakultas'      => null,
        'tahun_masuk'   => null,
        'tahun_lulus'   => $tahun_lulus,
    ]);
    $imported++;
}

    fclose($handle);

    return redirect()->route('admin.mahasiswa.index')
        ->with('success', "Berhasil import {$imported} mahasiswa. {$skipped} data dilewati (NIM duplikat).");
}
}