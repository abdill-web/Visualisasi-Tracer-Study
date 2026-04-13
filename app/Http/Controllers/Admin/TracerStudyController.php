<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TracerStudy;
use App\Models\Mahasiswa;

class TracerStudyController extends Controller
{
    public function index()
    {
        $data = TracerStudy::with('mahasiswa')->latest()->paginate(15);
        $total = Mahasiswa::count();
        $sudahIsi = TracerStudy::count();
        $belumIsi = $total - $sudahIsi;
        $responseRate = $total > 0 ? round(($sudahIsi / $total) * 100) : 0;

        return view('admin.tracer.index', compact('data', 'total', 'sudahIsi', 'belumIsi', 'responseRate'));
    }

    public function show($id)
    {
        $tracer = TracerStudy::with('mahasiswa')->findOrFail($id);
        return view('admin.tracer.show', compact('tracer'));
    }
}