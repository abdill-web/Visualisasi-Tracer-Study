<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;

class Mahasiswa extends Authenticatable
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'email',
        'tanggal_lahir',
        'program_studi',
        'fakultas',
        'tahun_masuk',
        'tahun_lulus',
    ];

    protected $hidden = [
        'tanggal_lahir',
    ];

    // Override: tidak pakai bcrypt, langsung bandingkan plain text
    public function getAuthPassword()
    {
        return $this->tanggal_lahir;
    }

    public function getAuthPasswordName()
    {
        return 'tanggal_lahir';
    }

    public function tracerStudy()
    {
        return $this->hasOne(TracerStudy::class, 'mahasiswa_id');
    }
}