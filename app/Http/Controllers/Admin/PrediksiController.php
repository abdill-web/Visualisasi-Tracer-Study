<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PrediksiController extends Controller
{
    private function flaskUrl(): string
    {
        return env('FLASK_API_URL', 'http://localhost:5000');
    }

    public function index()
    {
        $flaskOnline = false;

        try {
            $response = Http::timeout(5)->withoutVerifying()
                ->get($this->flaskUrl() . '/health');

            if ($response->successful()) {
                $flaskOnline = true;
            }
        } catch (\Exception $e) {}

        // Daftar program studi dari info-model
        $prodiList = [];
        try {
            $res = Http::timeout(5)->withoutVerifying()
                ->get($this->flaskUrl() . '/info-model');
            if ($res->successful()) {
                $prodiList = $res->json()['prodi_tersedia'] ?? [];
            }
        } catch (\Exception $e) {}

        return view('admin.prediksi.index', compact('flaskOnline', 'prodiList'));
    }

    public function predict(Request $request)
    {
        $request->validate([
            'model'          => 'required|in:rf,xgboost,ensemble',
            'program_studi'  => 'required|string',
            'C03'            => 'required|numeric|min:0',
            'C04'            => 'required|numeric|min:0',
            'C05'            => 'required|numeric|min:0',
        ]);

        // Hitung skor agregat dari input
        $b01Fields = ['B01_1','B01_2','B01_3','B01_4','B01_5','B01_6','B01_7'];
        $g01Fields = ['G01_1','G01_2','G01_3','G01_4','G01_5','G01_6','G01_7'];
        $c02Fields = ['C02_1','C02_2','C02_3','C02_4','C02_5','C02_6','C02_7',
                      'C02_8','C02_9','C02_10','C02_11','C02_12','C02_13','C02_14'];

        $b01Vals = array_map(fn($k) => (float)($request->input($k, 0)), $b01Fields);
        $g01Vals = array_map(fn($k) => (float)($request->input($k, 0)), $g01Fields);
        $c02Vals = array_map(fn($k) => (float)($request->input($k, 0)), $c02Fields);

        $skorMetodeBelajar  = count($b01Vals) > 0 ? array_sum($b01Vals) / count($b01Vals) : 0;
        $skorKompetensi     = count($g01Vals) > 0 ? array_sum($g01Vals) / count($g01Vals) : 0;
        $skorInisiatif      = array_sum($c02Vals);

        // Bangun payload ke Flask
        $payload = [
            'model'          => $request->model,
            'program_studi'  => $request->program_studi,
            'C03'            => (float)$request->C03,
            'C04'            => (float)$request->C04,
            'C05'            => (float)$request->C05,
            'Skor_Inisiatif_Mencari_Kerja' => $skorInisiatif,
            'Skor_Rata2_MetodeBelajar'     => $skorMetodeBelajar,
            'Skor_Rata2_Kompetensi'        => $skorKompetensi,
        ];

        // Tambahkan semua field B01, G01, C02
        foreach (array_merge($b01Fields, $g01Fields, $c02Fields) as $field) {
            $payload[$field] = (float)($request->input($field, 0));
        }

        try {
            $response = Http::timeout(10)->withoutVerifying()
                ->post($this->flaskUrl() . '/predict-keberhasilan', $payload);

            if ($response->successful()) {
                $result = $response->json();
                return response()->json(['success' => true, 'data' => $result]);
            }

            return response()->json([
                'success' => false,
                'error'   => 'Flask API error: ' . $response->status(),
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => 'Flask API tidak dapat dijangkau: ' . $e->getMessage(),
            ], 500);
        }
    }
}