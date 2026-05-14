<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\TracerStudy;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('mahasiswa.chatbot');
    }

    public function chat(Request $request)
    {
        $request->validate(['message' => 'required|string|max:500']);

        $mahasiswa = Auth::guard('mahasiswa')->user();
        $tracerUser = TracerStudy::where('mahasiswa_id', $mahasiswa->id)->first();

        // ── Statistik lengkap ──────────────────────────────
        $total    = Mahasiswa::count();
        $totalIsi = TracerStudy::count();
        $responseRate = $total > 0 ? round(($totalIsi / $total) * 100) : 0;

        $statusData = TracerStudy::selectRaw('status_saat_ini, count(*) as total')
            ->whereNotNull('status_saat_ini')
            ->groupBy('status_saat_ini')
            ->pluck('total', 'status_saat_ini')->toArray();

        $bidangData = TracerStudy::selectRaw('bidang_perusahaan, count(*) as total')
            ->whereNotNull('bidang_perusahaan')
            ->groupBy('bidang_perusahaan')
            ->orderByDesc('total')
            ->pluck('total', 'bidang_perusahaan')->toArray();

        $provinsiData = TracerStudy::selectRaw('provinsi_kerja, count(*) as total')
            ->whereNotNull('provinsi_kerja')
            ->groupBy('provinsi_kerja')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'provinsi_kerja')->toArray();

        $avgPendapatan = TracerStudy::whereNotNull('pendapatan')->where('pendapatan', '>', 0)->avg('pendapatan');
        $maxPendapatan = TracerStudy::whereNotNull('pendapatan')->where('pendapatan', '>', 0)->max('pendapatan');
        $minPendapatan = TracerStudy::whereNotNull('pendapatan')->where('pendapatan', '>', 0)->min('pendapatan');

        $relevansiData = TracerStudy::selectRaw('kesesuaian_bidang, count(*) as total')
            ->whereNotNull('kesesuaian_bidang')
            ->groupBy('kesesuaian_bidang')
            ->pluck('total', 'kesesuaian_bidang')->toArray();

        $statusMap = [
            'bekerja'       => 'Bekerja',
            'wirausaha'     => 'Wirausaha',
            'studi_lanjut'  => 'Studi Lanjut',
            'tidak_bekerja' => 'Tidak Bekerja',
            'belum_bekerja' => 'Belum Bekerja',
        ];

        // Format data statistik lebih readable
        $statusFormatted = [];
        foreach ($statusData as $key => $val) {
            $statusFormatted[$statusMap[$key] ?? $key] = $val . ' alumni';
        }

        $bidangFormatted = [];
        foreach ($bidangData as $key => $val) {
            $bidangFormatted[$key] = $val . ' alumni';
        }

        // ── Data mahasiswa yang chat ──────────────────────
        $userContext = "Mahasiswa: {$mahasiswa->nama} | Prodi: {$mahasiswa->program_studi}\n";
        if ($tracerUser) {
            $userContext .= "Status: " . ($statusMap[$tracerUser->status_saat_ini] ?? '-') . "\n";
            if ($tracerUser->bidang_perusahaan) $userContext .= "Bidang kerja: {$tracerUser->bidang_perusahaan}\n";
            if ($tracerUser->posisi_jabatan) $userContext .= "Posisi: {$tracerUser->posisi_jabatan}\n";
            if ($tracerUser->pendapatan) $userContext .= "Pendapatan: Rp " . number_format($tracerUser->pendapatan, 0, ',', '.') . "/bulan\n";
            $userContext .= "Sudah mengisi tracer study: Ya\n";
        } else {
            $userContext .= "Belum mengisi tracer study\n";
        }

        // ── Link lowongan kerja per bidang ────────────────
        $jobLinks = [
            'Teknologi Informasi' => [
                'LinkedIn'   => 'https://www.linkedin.com/jobs/search/?keywords=IT+Technology',
                'Glints'     => 'https://glints.com/id/opportunities/jobs/explore?keyword=teknologi+informasi',
                'Jobstreet'  => 'https://www.jobstreet.co.id/en/jobs/in-information-technology',
                'Kalibrr'    => 'https://www.kalibrr.com/id-ID/job-board/search?q=teknologi+informasi',
            ],
            'Perbankan & Keuangan' => [
                'LinkedIn'   => 'https://www.linkedin.com/jobs/search/?keywords=Banking+Finance',
                'Glints'     => 'https://glints.com/id/opportunities/jobs/explore?keyword=perbankan',
                'Jobstreet'  => 'https://www.jobstreet.co.id/en/jobs/in-banking-financial-services',
                'Kalibrr'    => 'https://www.kalibrr.com/id-ID/job-board/search?q=perbankan',
            ],
            'Pendidikan' => [
                'LinkedIn'   => 'https://www.linkedin.com/jobs/search/?keywords=Education',
                'Glints'     => 'https://glints.com/id/opportunities/jobs/explore?keyword=pendidikan',
                'Jobstreet'  => 'https://www.jobstreet.co.id/en/jobs/in-education-training',
            ],
            'Kesehatan' => [
                'LinkedIn'   => 'https://www.linkedin.com/jobs/search/?keywords=Healthcare',
                'Glints'     => 'https://glints.com/id/opportunities/jobs/explore?keyword=kesehatan',
                'Jobstreet'  => 'https://www.jobstreet.co.id/en/jobs/in-healthcare',
            ],
            'Media & Komunikasi' => [
                'LinkedIn'   => 'https://www.linkedin.com/jobs/search/?keywords=Media+Communication',
                'Glints'     => 'https://glints.com/id/opportunities/jobs/explore?keyword=media',
                'Jobstreet'  => 'https://www.jobstreet.co.id/en/jobs/in-advertising-media',
            ],
            'default' => [
                'LinkedIn'   => 'https://www.linkedin.com/jobs/search/?location=Indonesia',
                'Glints'     => 'https://glints.com/id/opportunities/jobs/explore',
                'Jobstreet'  => 'https://www.jobstreet.co.id',
                'Kalibrr'    => 'https://www.kalibrr.com/id-ID/job-board',
                'Indeed'     => 'https://id.indeed.com',
            ],
        ];
        
        // Deteksi bidang dari prodi mahasiswa
        $userBidang = $tracerUser->bidang_perusahaan ?? 'default';
        $relevantLinks = $jobLinks[$userBidang] ?? $jobLinks['default'];

        $linksFormatted = "";
        foreach ($relevantLinks as $platform => $url) {
            $linksFormatted .= "- {$platform}: {$url}\n";
        }

        // ── System prompt ─────────────────────────────────
        $systemPrompt = <<<PROMPT
Kamu adalah AI Career Assistant untuk Tracer Study Universitas Mercu Buana (UMB). Jawab dengan SPESIFIK menggunakan DATA NYATA yang diberikan, bukan jawaban generik.

=== DATA TRACER STUDY UMB (REAL) ===
Total alumni terdaftar: {$total} orang
Alumni sudah mengisi kuesioner: {$totalIsi} orang
Response rate: {$responseRate}%

DISTRIBUSI STATUS ALUMNI:
{$this->formatArray($statusFormatted)}

TOP BIDANG PEKERJAAN ALUMNI:
{$this->formatArray($bidangFormatted)}

DATA PENDAPATAN ALUMNI:
- Rata-rata: Rp {$this->formatRupiah($avgPendapatan)}/bulan
- Tertinggi: Rp {$this->formatRupiah($maxPendapatan)}/bulan
- Terendah: Rp {$this->formatRupiah($minPendapatan)}/bulan

TOP PROVINSI TEMPAT KERJA:
{$this->formatArray($provinsiData)}

RELEVANSI BIDANG STUDI:
{$this->formatArray($relevansiData)}

=== DATA MAHASISWA YANG CHAT ===
{$userContext}

=== LINK LOWONGAN KERJA (gunakan jika ditanya lowongan) ===
{$linksFormatted}

=== INSTRUKSI ===
1. Selalu gunakan data nyata di atas saat menjawab pertanyaan statistik
2. Jika ditanya lowongan kerja, berikan link platform di atas dengan format markdown: [Nama Platform](URL)
3. Jawab dengan bahasa Indonesia yang ramah dan natural, bukan template
4. Maksimal 4 paragraf, to the point
5. Jika data tidak tersedia, katakan dengan jujur
6. Personalisasi jawaban berdasarkan prodi dan status mahasiswa yang chat
PROMPT;


        $history = $request->input('history', []);
        $messages = [['role' => 'system', 'content' => $systemPrompt]];

        foreach (array_slice($history, -8) as $h) {
            $messages[] = ['role' => $h['role'], 'content' => $h['content']];
        }
       // Deteksi request rekomendasi karir personal
$userMessage = $request->message;
if ($userMessage === 'REKOMENDASI_KARIR_PERSONAL') {
    $userMessage = $this->buildCareerRecommendationPrompt($mahasiswa, $tracerUser);
}

$messages[] = ['role' => 'user', 'content' => $userMessage];

        try {
            $response = Http::timeout(30)->withoutVerifying()->withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                'Content-Type'  => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model'       => 'llama-3.3-70b-versatile',
                'messages'    => $messages,
                'max_tokens'  => 600,
                'temperature' => 0.6,
            ]);

            $data = $response->json();

            if (isset($data['error'])) {
                return response()->json(['reply' => '⚠️ ' . $data['error']['message']]);
            }

            $reply = $data['choices'][0]['message']['content'] ?? 'Maaf, tidak ada respons.';
            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            \Log::error('Chatbot Error: ' . $e->getMessage());
            return response()->json(['reply' => 'Maaf, terjadi kesalahan koneksi. Silakan coba lagi.']);
        }
    }

    private function formatArray(array $data): string
    {
        if (empty($data)) return "- (belum ada data)\n";
        $result = "";
        foreach ($data as $key => $val) {
            $result .= "- {$key}: {$val}\n";
        }
        return $result;
    }

    private function formatRupiah($number): string
    {
        return number_format($number ?? 0, 0, ',', '.');
    }

    private function buildCareerRecommendationPrompt($mahasiswa, $tracerUser): string
{
    $prodi = $mahasiswa->program_studi;

    // Data alumni dengan prodi yang sama
    $alumniSameProdi = TracerStudy::join('mahasiswa', 'tracer_study.mahasiswa_id', '=', 'mahasiswa.id')
        ->where('mahasiswa.program_studi', $prodi)
        ->selectRaw('tracer_study.status_saat_ini, tracer_study.bidang_perusahaan, tracer_study.pendapatan, tracer_study.kesesuaian_bidang')
        ->get();

    $totalSameProdi = $alumniSameProdi->count();

    $bidangSameProdi = $alumniSameProdi
        ->whereNotNull('bidang_perusahaan')
        ->groupBy('bidang_perusahaan')
        ->map(fn($g) => $g->count())
        ->sortDesc()
        ->take(5)
        ->toArray();

    $avgPendapatanProdi = $alumniSameProdi
        ->where('pendapatan', '>', 0)
        ->avg('pendapatan');

    $statusSameProdi = $alumniSameProdi
        ->whereNotNull('status_saat_ini')
        ->groupBy('status_saat_ini')
        ->map(fn($g) => $g->count())
        ->toArray();

    $statusMap = [
        'bekerja'       => 'Bekerja',
        'wirausaha'     => 'Wirausaha',
        'studi_lanjut'  => 'Studi Lanjut',
        'tidak_bekerja' => 'Tidak Bekerja',
        'belum_bekerja' => 'Belum Bekerja',
    ];

    $statusProdiFormatted = [];
    foreach ($statusSameProdi as $k => $v) {
        $statusProdiFormatted[$statusMap[$k] ?? $k] = $v;
    }

    $userStatus = $tracerUser ? ($statusMap[$tracerUser->status_saat_ini] ?? 'Belum diketahui') : 'Belum mengisi tracer study';
    $userBidang = $tracerUser->bidang_perusahaan ?? 'Belum diketahui';
    $userPendapatan = $tracerUser && $tracerUser->pendapatan > 0
        ? 'Rp ' . number_format($tracerUser->pendapatan, 0, ',', '.') . '/bulan'
        : 'Belum diketahui';

    $bidangStr = $this->formatArray($bidangSameProdi);
    $statusStr = $this->formatArray($statusProdiFormatted);
    $avgStr = $this->formatRupiah($avgPendapatanProdi);

    return <<<PROMPT
Berikan analisis rekomendasi karir PERSONAL dan SPESIFIK untuk mahasiswa ini:

PROFIL MAHASISWA:
- Nama: {$mahasiswa->nama}
- Program Studi: {$prodi}
- Status saat ini: {$userStatus}
- Bidang kerja saat ini: {$userBidang}
- Pendapatan saat ini: {$userPendapatan}

DATA ALUMNI DENGAN PRODI YANG SAMA ({$prodi}):
- Total alumni data: {$totalSameProdi} orang
- Rata-rata pendapatan: Rp {$avgStr}/bulan
- Distribusi status:
{$statusStr}
- Top bidang pekerjaan:
{$bidangStr}

Berikan rekomendasi yang mencakup:
1. **Analisis Posisi** — Bandingkan kondisi mahasiswa ini dengan alumni sesama prodi
2. **Rekomendasi Bidang Karir** — 3 bidang karir terbaik berdasarkan data alumni prodi yang sama
3. **Target Pendapatan** — Berikan gambaran target pendapatan realistis berdasarkan data
4. **Langkah Konkret** — 3 langkah spesifik yang bisa dilakukan sekarang
5. **Platform Cari Kerja** — Rekomendasikan platform dengan link: [LinkedIn](https://www.linkedin.com/jobs/search/?location=Indonesia), [Glints](https://glints.com/id/opportunities/jobs/explore), [Jobstreet](https://www.jobstreet.co.id), [Kalibrr](https://www.kalibrr.com/id-ID/job-board)

Jawab dengan personal, spesifik, dan motivatif. Gunakan data nyata di atas.
PROMPT;
}

}