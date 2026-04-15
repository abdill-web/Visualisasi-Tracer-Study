<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilClustering extends Model
{
    protected $table = 'hasil_clustering';

    protected $fillable = [
        'program_studi', 'sertifikasi',
        'metode_perkuliahan', 'metode_demonstrasi', 'metode_riset',
        'metode_magang', 'metode_praktikum', 'metode_kerja_lapangan', 'metode_diskusi',
        'jml_lamar', 'jml_respon', 'jml_wawancara',
        'kompetensi_etika', 'kompetensi_keahlian', 'kompetensi_bahasa_inggris',
        'kompetensi_teknologi', 'kompetensi_komunikasi', 'kompetensi_kerjasama',
        'kompetensi_pengembangan_diri', 'kompetensi_etos_kerja', 'kompetensi_kolaborasi',
        'kompetensi_fleksibilitas', 'kompetensi_literasi', 'kompetensi_inisiatif',
        'kompetensi_kepemimpinan', 'kompetensi_wirausaha', 'kompetensi_lifelong_learning',
        'label_cluster',
    ];
}