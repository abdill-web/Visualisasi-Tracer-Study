<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\TracerStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TracerStudyController extends Controller
{
    public function form()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();
        $tracer = TracerStudy::where('mahasiswa_id', $mahasiswa->id)->first();
        return view('mahasiswa.tracer', compact('mahasiswa', 'tracer'));
    }

    public function store(Request $request)
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();

        $data = $request->except(['_token', '_method']);

        // Handle JSON fields
        $jsonFields = [
            'metode_pembelajaran', 'alasan_tidak_sesuai',
            'legalitas_usaha', 'motivasi_wirausaha',
            'kompetensi_saat_lulus', 'kompetensi_saat_ini'
        ];

        foreach ($jsonFields as $field) {
            if (isset($data[$field]) && is_array($data[$field])) {
                $data[$field] = json_encode($data[$field]);
            } else {
                $data[$field] = null;
            }
        }

        $data['mahasiswa_id'] = $mahasiswa->id;
        $data['persetujuan'] = isset($data['persetujuan']) ? true : false;

        TracerStudy::updateOrCreate(
            ['mahasiswa_id' => $mahasiswa->id],
            $data
        );

        return redirect()->route('mahasiswa.dashboard')
            ->with('success', 'Form Tracer Study berhasil disimpan! Terima kasih.');
    }
}