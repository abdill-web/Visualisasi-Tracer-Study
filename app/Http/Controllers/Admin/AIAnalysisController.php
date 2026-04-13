<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TracerStudy;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Http;

class AIAnalysisController extends Controller
{
    public function analyze()
    {
        $total = Mahasiswa::count();
        $totalIsi = TracerStudy::count();

        $statusData = TracerStudy::selectRaw('status_saat_ini, count(*) as total')
            ->whereNotNull('status_saat_ini')
            ->groupBy('status_saat_ini')
            ->pluck('total', 'status_saat_ini');

        $bidangData = TracerStudy::selectRaw('bidang_perusahaan, count(*) as total')
            ->whereNotNull('bidang_perusahaan')
            ->groupBy('bidang_perusahaan')
            ->orderByDesc('total')
            ->pluck('total', 'bidang_perusahaan');

        $relevansiData = TracerStudy::selectRaw('kesesuaian_bidang, count(*) as total')
            ->whereNotNull('kesesuaian_bidang')
            ->groupBy('kesesuaian_bidang')
            ->pluck('total', 'kesesuaian_bidang');

        $summary = [
            'total_alumni'     => $total,
            'total_responden'  => $totalIsi,
            'response_rate'    => $total > 0 ? round(($totalIsi / $total) * 100) . '%' : '0%',
            'status'           => $statusData,
            'bidang_pekerjaan' => $bidangData,
            'relevansi'        => $relevansiData,
        ];

        $prompt = "Analisis data tracer study berikut dalam Bahasa Indonesia secara singkat:\n\n"
            . "Total alumni: {$total}, Responden: {$totalIsi}\n"
            . "Status: " . json_encode($statusData) . "\n"
            . "Bidang kerja: " . json_encode($bidangData) . "\n\n"
            . "Berikan: 1) Ringkasan 2) 3 temuan utama 3) 2 rekomendasi";

        try {
$response = Http::timeout(30)->withHeaders([
    'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
    'Content-Type'  => 'application/json',
])->post('https://api.groq.com/openai/v1/chat/completions', [
    'model'    => 'llama-3.3-70b-versatile',
    'messages' => [
        [
            'role'    => 'user',
            'content' => $prompt
        ]
    ],
    'max_tokens' => 1000,
]);

            $data = $response->json();

            \Log::info('OpenRouter Response:', $data ?? []);

            if (isset($data['error'])) {
                return response()->json([
                    'result' => '⚠️ Error dari OpenRouter: ' . $data['error']['message']
                ]);
            }

            if (!isset($data['choices'][0]['message']['content'])) {
                return response()->json([
                    'result' => '⚠️ Response tidak valid: ' . json_encode($data)
                ]);
            }

            $text = $data['choices'][0]['message']['content'];
            return response()->json(['result' => $text]);

        } catch (\Exception $e) {
            \Log::error('OpenRouter Error: ' . $e->getMessage());
            return response()->json([
                'result' => '⚠️ Exception: ' . $e->getMessage()
            ]);
        }
    }
}