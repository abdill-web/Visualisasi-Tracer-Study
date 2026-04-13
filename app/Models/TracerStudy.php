<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TracerStudy extends Model
{
    protected $table = 'tracer_study';

    protected $fillable = [
        'mahasiswa_id',
        'tahun_lulus',
        'no_telepon',
        'email',
        'npwp',
        'instagram',
        'linkedin',
        'sertifikasi',
        'sumber_dana',
        'metode_pembelajaran',
        'mulai_cari_kerja',
        'jml_lamar',
        'jml_respon',
        'jml_wawancara',
        'aktif_cari_kerja',
        'aktif_cari_kerja_lainnya',
        'status_saat_ini',
        'dapat_kerja_6bulan',
        'bulan_dapat_kerja',
        'posisi_jabatan',
        'job_title',
        'pendapatan',
        'provinsi_kerja',
        'kota_kerja',
        'jenis_perusahaan',
        'nama_perusahaan',
        'tingkat_perusahaan',
        'bidang_perusahaan',
        'nama_atasan',
        'jabatan_atasan',
        'email_atasan',
        'kesesuaian_bidang',
        'tingkat_pendidikan_sesuai',
        'alasan_tidak_sesuai',
        'alasan_tidak_sesuai_lainnya',
        'posisi_wirausaha',
        'jenis_usaha',
        'bulan_mulai_wirausaha',
        'tingkat_usaha',
        'sosmed_usaha',
        'omzet',
        'pendapatan_wirausaha',
        'jumlah_rekan_kerja',
        'legalitas_usaha',
        'legalitas_usaha_lainnya',
        'motivasi_wirausaha',
        'motivasi_wirausaha_lainnya',
        'nama_partner',
        'jabatan_partner',
        'email_partner',
        'lokasi_studi_lanjut',
        'alasan_studi_lanjut',
        'biaya_studi_lanjut',
        'nama_kampus_lanjut',
        'kota_kampus_lanjut',
        'negara_kampus_lanjut',
        'prodi_lanjut',
        'tanggal_masuk_lanjut',
        'alasan_tidak_bekerja',
        'alasan_tidak_bekerja_lainnya',
        'kompetensi_saat_lulus',
        'kompetensi_saat_ini',
        'saran_kuesioner',
        'saran_umb',
        'persetujuan',
    ];

    protected $casts = [
        'metode_pembelajaran'   => 'array',
        'alasan_tidak_sesuai'   => 'array',
        'legalitas_usaha'       => 'array',
        'motivasi_wirausaha'    => 'array',
        'kompetensi_saat_lulus' => 'array',
        'kompetensi_saat_ini'   => 'array',
        'persetujuan'           => 'boolean',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}