<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MahasiswaLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.mahasiswa-login');
    }

public function login(Request $request)
{
    $request->validate([
        'nim'           => 'required|string',
        'tanggal_lahir' => 'required|string',
    ]);

    // Cari mahasiswa berdasarkan NIM
    $mahasiswa = \App\Models\Mahasiswa::where('nim', $request->nim)->first();

    if (!$mahasiswa) {
        return back()->withErrors(['nim' => 'NIM atau tanggal lahir tidak sesuai.']);
    }

    // Convert tanggal lahir dari database ke format DDMMYYYY
    $dbTgl = \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('dmY');

    // Bandingkan dengan input
    if ($request->tanggal_lahir !== $dbTgl) {
        return back()->withErrors(['nim' => 'NIM atau tanggal lahir tidak sesuai.']);
    }

    Auth::guard('mahasiswa')->login($mahasiswa);
    $request->session()->regenerate();

    return redirect()->route('mahasiswa.dashboard');
}

    public function logout(Request $request)
    {
        Auth::guard('mahasiswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('mahasiswa.login');
    }
}