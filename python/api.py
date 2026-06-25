from flask import Flask, request, jsonify
import pandas as pd
import numpy as np
import joblib
import pickle
import traceback
import os

app = Flask(__name__)

# ─────────────────────────────────────────────
# Path & Loading Model
# ─────────────────────────────────────────────
BASE_DIR = os.path.dirname(os.path.abspath(__file__))

# ── KMeans (existing) ──
model_kmeans  = joblib.load(os.path.join(BASE_DIR, 'KMeans_Model_A_K4_UMB.pkl'))
scaler_kmeans = joblib.load(os.path.join(BASE_DIR, 'Scaler_Model_A_UMB.pkl'))
df_dataset    = pd.read_csv(os.path.join(BASE_DIR, 'Dataset_Klasifikasi_Final_UMB_V4.csv'))

# ── ML Prediksi Keberhasilan ──
with open(os.path.join(BASE_DIR, 'model_rf_terbaik.pkl'), 'rb') as f:
    model_rf = pickle.load(f)

with open(os.path.join(BASE_DIR, 'model_xgboost_terbaik.pkl'), 'rb') as f:
    model_xgb = pickle.load(f)

with open(os.path.join(BASE_DIR, 'scaler_data (1).pkl'), 'rb') as f:
    scaler_pred = pickle.load(f)

with open(os.path.join(BASE_DIR, 'kolom_fitur.pkl'), 'rb') as f:
    KOLOM_FITUR = pickle.load(f)  # 87 kolom (34 numerik underscore + 53 one-hot prodi)

# ─────────────────────────────────────────────
# Konstanta
# ─────────────────────────────────────────────

KLASTER_MAP = {
    1: {'nama': 'Karir Linear',       'warna': '#10b981', 'deskripsi': 'Karir sesuai bidang studi, stabil dan terarah'},
    0: {'nama': 'Karir Lintas Jalur', 'warna': '#3b82f6', 'deskripsi': 'Karir di luar bidang studi, adaptif dan fleksibel'},
    3: {'nama': 'Karir Elit',         'warna': '#8b5cf6', 'deskripsi': 'Karir dengan posisi/pendapatan tinggi, kompetitif'},
    2: {'nama': 'Karir Tertunda',     'warna': '#f59e0b', 'deskripsi': 'Masih dalam proses, butuh dukungan lebih lanjut'},
}

LABEL_KEBERHASILAN = {
    0: {
        'label':       'Kurang Berhasil',
        'warna':       '#ef4444',
        'deskripsi':   'Alumni belum mencapai keberhasilan optimal. Perlu peningkatan kompetensi dan strategi karir.',
        'rekomendasi': [
            'Ikuti pelatihan atau sertifikasi untuk meningkatkan kompetensi',
            'Perluas jaringan profesional melalui komunitas alumni',
            'Manfaatkan layanan career center universitas',
        ],
    },
    1: {
        'label':       'Cukup Berhasil',
        'warna':       '#f59e0b',
        'deskripsi':   'Alumni menunjukkan perkembangan karir yang cukup baik namun masih ada ruang untuk berkembang.',
        'rekomendasi': [
            'Tingkatkan kemampuan bahasa Inggris dan teknologi informasi',
            'Aktif mengikuti bursa kerja dan pameran karir',
            'Pertimbangkan studi lanjut atau pelatihan profesional',
        ],
    },
    2: {
        'label':       'Berhasil',
        'warna':       '#3b82f6',
        'deskripsi':   'Alumni telah berhasil membangun karir yang baik dan menunjukkan kompetensi yang solid.',
        'rekomendasi': [
            'Terus kembangkan kompetensi kepemimpinan',
            'Berkontribusi sebagai mentor bagi alumni junior',
            'Explore peluang pengembangan karir ke level lebih tinggi',
        ],
    },
    3: {
        'label':       'Sangat Berhasil',
        'warna':       '#10b981',
        'deskripsi':   'Alumni mencapai keberhasilan karir yang sangat baik dengan kompetensi dan pencapaian tinggi.',
        'rekomendasi': [
            'Bagikan pengalaman sebagai narasumber atau mentor',
            'Pertimbangkan kontribusi pada pengembangan kurikulum universitas',
            'Explore peluang kewirausahaan atau posisi strategis',
        ],
    },
}

# 34 kolom scaler (format kurung kotak) — urutan sesuai scaler.feature_names_in_
SCALER_COLS = list(scaler_pred.feature_names_in_)

# 53 kolom one-hot prodi dari kolom_fitur.pkl
PRODI_COLS = [col for col in KOLOM_FITUR if col.startswith('S04.')]
PRODI_LIST = [col.replace('S04. Program Studi_', '') for col in PRODI_COLS]

# Mapping key pendek → nama kolom scaler (format kurung kotak)
KEY_TO_SCALER = {
    'C03':   'C03. Berapa jumlah perusahaan/ instansi/ institusi yang sudah Anda lamar (lewat surat/ e-mail) sebelum Anda memperoleh pekerjaan pertama?',
    'C04':   'C04. Berapa jumlah perusahaan / instansi / institusi yang merespon lamaran Anda?',
    'C05':   'C05. Berapa jumlah perusahaan/ instansi/ institusi yang mengundang Anda untuk wawancara?',
    'G01_1': '[G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?] G01_1. Etika',
    'G01_2': '[G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?] G01_2. Keahlian berdasarkan bidang ilmu\n',
    'G01_3': '[G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?] G01_3. Bahasa Inggris',
    'G01_4': '[G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?] G01_4. Penggunaan Teknologi Informasi',
    'G01_5': '[G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?] G01_5. Komunikasi',
    'G01_6': '[G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?] G01_6. Kerja sama tim',
    'G01_7': '[G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?] G01_7. Pengembangan Diri',
    'B01_1': '[B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?] B01_1. Perkuliahan',
    'B01_2': '[B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?] B01_2. Demonstrasi (Peragaan /Gaya Pembelajaran)',
    'B01_3': '[B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?] B01_3. Partisipasi dalam proyek riset',
    'B01_4': '[B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?] B01_4. Magang',
    'B01_5': '[B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?] B01_5. Praktikum',
    'B01_6': '[B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?] B01_6. Kerja Lapangan',
    'B01_7': '[B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?] B01_7. Diskusi',
    'C02_1':  '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_1. Melalui iklan di koran/majalah, brosur',
    'C02_2':  '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_2. Melamar ke perusahaan tanpa mengetahui lowongan yang ada',
    'C02_3':  '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_3. Pergi ke bursa/pameran kerja',
    'C02_4':  '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_4. Mencari lewat internet/iklan online/milis',
    'C02_5':  '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_5. Dihubungi oleh perusahaan',
    'C02_6':  '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_6. Menghubungi Kemenakertrans',
    'C02_7':  '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_7. Menghubungi agen tenaga kerja komersial/swasta',
    'C02_8':  '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_8. Memperoleh informasi dari pusat/kantor pengembangan karir fakultas/universitas',
    'C02_9':  '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_9. Menghubungi kantor kemahasiswaan/hubungan alumni',
    'C02_10': '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_10. Membangun jejaring (network) sejak masih kuliah',
    'C02_11': '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_11. Melalui relasi (misalnya dosen, orang tua, saudara, teman, dll.)',
    'C02_12': '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_12. Membangun bisnis sendiri',
    'C02_13': '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_13. Melalui penempatan kerja atau magang',
    'C02_14': '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_14. Bekerja di tempat yang sama dengan tempat kerja semasa kuliah',
    'Skor_Inisiatif_Mencari_Kerja': 'Skor_Inisiatif_Mencari_Kerja',
    'Skor_Rata2_MetodeBelajar':     'Skor_Rata2_MetodeBelajar',
    'Skor_Rata2_Kompetensi':        'Skor_Rata2_Kompetensi',
}

# Mapping key pendek → nama kolom model (format underscore, dari kolom_fitur.pkl)
KEY_TO_MODEL = {
    'C03':   'C03. Berapa jumlah perusahaan/ instansi/ institusi yang sudah Anda lamar (lewat surat/ e-mail) sebelum Anda memperoleh pekerjaan pertama?',
    'C04':   'C04. Berapa jumlah perusahaan / instansi / institusi yang merespon lamaran Anda?',
    'C05':   'C05. Berapa jumlah perusahaan/ instansi/ institusi yang mengundang Anda untuk wawancara?',
    'G01_1': '_G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?_ G01_1. Etika',
    'G01_2': '_G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?_ G01_2. Keahlian berdasarkan bidang ilmu\n',
    'G01_3': '_G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?_ G01_3. Bahasa Inggris',
    'G01_4': '_G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?_ G01_4. Penggunaan Teknologi Informasi',
    'G01_5': '_G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?_ G01_5. Komunikasi',
    'G01_6': '_G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?_ G01_6. Kerja sama tim',
    'G01_7': '_G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?_ G01_7. Pengembangan Diri',
    'B01_1': '_B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?_ B01_1. Perkuliahan',
    'B01_2': '_B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?_ B01_2. Demonstrasi (Peragaan /Gaya Pembelajaran)',
    'B01_3': '_B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?_ B01_3. Partisipasi dalam proyek riset',
    'B01_4': '_B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?_ B01_4. Magang',
    'B01_5': '_B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?_ B01_5. Praktikum',
    'B01_6': '_B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?_ B01_6. Kerja Lapangan',
    'B01_7': '_B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?_ B01_7. Diskusi',
    'C02_1':  '_C02. Bagaimana Anda mencari pekerjaan tersebut?_ C02_1. Melalui iklan di koran/majalah, brosur',
    'C02_2':  '_C02. Bagaimana Anda mencari pekerjaan tersebut?_ C02_2. Melamar ke perusahaan tanpa mengetahui lowongan yang ada',
    'C02_3':  '_C02. Bagaimana Anda mencari pekerjaan tersebut?_ C02_3. Pergi ke bursa/pameran kerja',
    'C02_4':  '_C02. Bagaimana Anda mencari pekerjaan tersebut?_ C02_4. Mencari lewat internet/iklan online/milis',
    'C02_5':  '_C02. Bagaimana Anda mencari pekerjaan tersebut?_ C02_5. Dihubungi oleh perusahaan',
    'C02_6':  '_C02. Bagaimana Anda mencari pekerjaan tersebut?_ C02_6. Menghubungi Kemenakertrans',
    'C02_7':  '_C02. Bagaimana Anda mencari pekerjaan tersebut?_ C02_7. Menghubungi agen tenaga kerja komersial/swasta',
    'C02_8':  '_C02. Bagaimana Anda mencari pekerjaan tersebut?_ C02_8. Memperoleh informasi dari pusat/kantor pengembangan karir fakultas/universitas',
    'C02_9':  '_C02. Bagaimana Anda mencari pekerjaan tersebut?_ C02_9. Menghubungi kantor kemahasiswaan/hubungan alumni',
    'C02_10': '_C02. Bagaimana Anda mencari pekerjaan tersebut?_ C02_10. Membangun jejaring (network) sejak masih kuliah',
    'C02_11': '_C02. Bagaimana Anda mencari pekerjaan tersebut?_ C02_11. Melalui relasi (misalnya dosen, orang tua, saudara, teman, dll.)',
    'C02_12': '_C02. Bagaimana Anda mencari pekerjaan tersebut?_ C02_12. Membangun bisnis sendiri',
    'C02_13': '_C02. Bagaimana Anda mencari pekerjaan tersebut?_ C02_13. Melalui penempatan kerja atau magang',
    'C02_14': '_C02. Bagaimana Anda mencari pekerjaan tersebut?_ C02_14. Bekerja di tempat yang sama dengan tempat kerja semasa kuliah',
    'Skor_Inisiatif_Mencari_Kerja': 'Skor_Inisiatif_Mencari_Kerja',
    'Skor_Rata2_MetodeBelajar':     'Skor_Rata2_MetodeBelajar',
    'Skor_Rata2_Kompetensi':        'Skor_Rata2_Kompetensi',
}

# KMeans feature cols (format kurung kotak, 35 fitur)
FEATURE_COLS_KMEANS = [
    'C03. Berapa jumlah perusahaan/ instansi/ institusi yang sudah Anda lamar (lewat surat/ e-mail) sebelum Anda memperoleh pekerjaan pertama?',
    'C05. Berapa jumlah perusahaan/ instansi/ institusi yang mengundang Anda untuk wawancara?',
    '[G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?] G01_4. Penggunaan Teknologi Informasi',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_11. Melalui relasi (misalnya dosen, orang tua, saudara, teman, dll.)',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_5. Dihubungi oleh perusahaan',
    '[B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?] B01_2. Demonstrasi (Peragaan /Gaya Pembelajaran)',
    '[G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?] G01_3. Bahasa Inggris',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_7. Menghubungi agen tenaga kerja komersial/swasta',
    '[G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?] G01_1. Etika',
    '[B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?] B01_1. Perkuliahan',
    '[B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?] B01_7. Diskusi',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_12. Membangun bisnis sendiri',
    '[B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?] B01_4. Magang',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_1. Melalui iklan di koran/majalah, brosur',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_6. Menghubungi Kemenakertrans',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_3. Pergi ke bursa/pameran kerja',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_14. Bekerja di tempat yang sama dengan tempat kerja semasa kuliah',
    'C04. Berapa jumlah perusahaan / instansi / institusi yang merespon lamaran Anda?',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_2. Melamar ke perusahaan tanpa mengetahui lowongan yang ada',
    '[G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?] G01_5. Komunikasi',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_15. Lainnya : (Tulis jawaban pada pertanyaan berikutnya)',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_9. Menghubungi kantor kemahasiswaan/hubungan alumni',
    '[B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?] B01_6. Kerja Lapangan',
    '[B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?] B01_3. Partisipasi dalam proyek riset',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_4. Mencari lewat internet/iklan online/milis',
    '[G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?] G01_2. Keahlian berdasarkan bidang ilmu\n',
    '[G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?] G01_7. Pengembangan Diri',
    '[B01. Menurut Anda seberapa besar metode pembelajaran berikut ini dilaksanakan di program studi Anda?] B01_5. Praktikum',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_8. Memperoleh informasi dari pusat/kantor pengembangan karir fakultas/universitas',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_10. Membangun jejaring (network) sejak masih kuliah',
    '[C02. Bagaimana Anda mencari pekerjaan tersebut?] C02_13. Melalui penempatan kerja atau magang',
    '[G01. Perbandingan Kompetensi A : PADA SAAT LULUS, pada tingkat mana kompetensi di bawah ini Anda kuasai?] G01_6. Kerja sama tim',
    'Skor_Inisiatif_Mencari_Kerja',
    'Skor_Rata2_MetodeBelajar',
    'Skor_Rata2_Kompetensi',
]


# ─────────────────────────────────────────────
# Helper
# ─────────────────────────────────────────────

def safe_float(val):
    try:
        return float(val) if val not in [None, '', 'Pilihan'] else 0.0
    except (TypeError, ValueError):
        return 0.0


def build_prediksi_features(data: dict) -> np.ndarray:
    """
    Alur yang benar:
    1. Bangun DataFrame 34 fitur (format kurung kotak) → scale dengan scaler_pred
    2. Bangun array 53 one-hot prodi
    3. Gabung scaled_numerik + onehot_prodi → 87 fitur → masuk model RF/XGBoost
    """
    # Step 1: bangun 34 fitur numerik (format kurung kotak sesuai scaler)
    scaler_dict = {col: 0.0 for col in SCALER_COLS}
    for key, val in data.items():
        if key == 'program_studi' or key == 'model':
            continue
        if key in KEY_TO_SCALER:
            col_name = KEY_TO_SCALER[key]
            if col_name in scaler_dict:
                scaler_dict[col_name] = safe_float(val)

    df_numerik = pd.DataFrame([scaler_dict], columns=SCALER_COLS)
    scaled_numerik = scaler_pred.transform(df_numerik)  # shape (1, 34)

    # Step 2: bangun 53 one-hot prodi
    prodi_input = data.get('program_studi', '')
    prodi_col   = f'S04. Program Studi_{prodi_input}'
    onehot = np.zeros((1, len(PRODI_COLS)))
    if prodi_col in PRODI_COLS:
        idx = PRODI_COLS.index(prodi_col)
        onehot[0, idx] = 1.0

    # Step 3: susun sesuai urutan KOLOM_FITUR (34 numerik underscore + 53 prodi)
    # Kolom_fitur urutan: [34 numerik underscore..., 53 prodi...]
    # Nilai numerik sudah di-scale, tinggal susun sesuai urutan kolom_fitur
    numerik_cols_model = [col for col in KOLOM_FITUR if not col.startswith('S04.')]

    # Buat dict scaled values: map dari nama scaler (kurung kotak) ke scaled value
    scaled_vals = {}
    for i, scaler_col in enumerate(SCALER_COLS):
        scaled_vals[scaler_col] = float(scaled_numerik[0, i])

    # Susun nilai numerik sesuai urutan kolom_fitur (format underscore)
    # Kita perlu mapping underscore → kurung kotak untuk lookup scaled value
    MODEL_TO_SCALER = {v: KEY_TO_SCALER[k] for k, v in KEY_TO_MODEL.items() if k in KEY_TO_SCALER}

    numerik_vector = []
    for col in numerik_cols_model:
        scaler_col = MODEL_TO_SCALER.get(col, col)
        numerik_vector.append(scaled_vals.get(scaler_col, 0.0))

    # Gabung numerik + prodi
    final_vector = np.array(numerik_vector + list(onehot[0]), dtype=float).reshape(1, -1)
    return final_vector


# ─────────────────────────────────────────────
# Endpoints
# ─────────────────────────────────────────────

@app.route('/health', methods=['GET'])
def health():
    return jsonify({
        'status':  'ok',
        'message': 'Flask API running',
        'models':  ['kmeans', 'random_forest', 'xgboost'],
    })


@app.route('/predict', methods=['POST'])
def predict():
    """KMeans clustering pola karir."""
    try:
        data = request.json
        features = []
        for col in FEATURE_COLS_KMEANS:
            val = data.get(col, 0)
            features.append(safe_float(val))

        X        = np.array(features).reshape(1, -1)
        X_scaled = scaler_kmeans.transform(X)
        klaster  = int(model_kmeans.predict(X_scaled)[0])
        info     = KLASTER_MAP.get(klaster, {'nama': 'Tidak Diketahui', 'warna': '#6b7280', 'deskripsi': '-'})

        return jsonify({
            'success':   True,
            'klaster':   klaster,
            'nama_pola': info['nama'],
            'warna':     info['warna'],
            'deskripsi': info['deskripsi'],
        })
    except Exception as e:
        traceback.print_exc()
        return jsonify({'success': False, 'error': str(e)}), 500


@app.route('/statistik', methods=['GET'])
def statistik():
    try:
        dist = df_dataset['Nama_Pola_Karir'].value_counts().to_dict()

        per_prodi = df_dataset.groupby(['S04. Program Studi', 'Nama_Pola_Karir']).size().reset_index(name='total')
        per_prodi_dict = {}
        for _, row in per_prodi.iterrows():
            prodi = row['S04. Program Studi']
            if prodi not in per_prodi_dict:
                per_prodi_dict[prodi] = {}
            per_prodi_dict[prodi][row['Nama_Pola_Karir']] = int(row['total'])

        skor_per_klaster = df_dataset.groupby('Nama_Pola_Karir')[
            ['Skor_Inisiatif_Mencari_Kerja', 'Skor_Rata2_MetodeBelajar', 'Skor_Rata2_Kompetensi']
        ].mean().round(2).to_dict()

        return jsonify({
            'success':          True,
            'total':            len(df_dataset),
            'distribusi':       dist,
            'per_prodi':        per_prodi_dict,
            'skor_per_klaster': skor_per_klaster,
        })
    except Exception as e:
        traceback.print_exc()
        return jsonify({'success': False, 'error': str(e)}), 500


@app.route('/predict-keberhasilan', methods=['POST'])
def predict_keberhasilan():
    try:
        data       = request.json or {}
        model_type = data.get('model', 'rf').lower()

        X = build_prediksi_features(data)  # shape (1, 87)

        if model_type == 'xgboost':
            kelas     = int(model_xgb.predict(X)[0])
            proba_arr = model_xgb.predict_proba(X)[0]
            model_label = 'xgboost'

        elif model_type == 'ensemble':
            proba_rf  = model_rf.predict_proba(X)[0]
            proba_xgb = model_xgb.predict_proba(X)[0]
            proba_arr = (proba_rf + proba_xgb) / 2
            kelas     = int(np.argmax(proba_arr))
            kelas_rf  = int(model_rf.predict(X)[0])
            kelas_xgb = int(model_xgb.predict(X)[0])
            detail_ensemble = {
                'rf':      {'kelas': kelas_rf,  'label': LABEL_KEBERHASILAN[kelas_rf]['label']},
                'xgboost': {'kelas': kelas_xgb, 'label': LABEL_KEBERHASILAN[kelas_xgb]['label']},
            }
            model_label = 'ensemble'

        else:  # rf
            kelas     = int(model_rf.predict(X)[0])
            proba_arr = model_rf.predict_proba(X)[0]
            model_label = 'rf'

        info = LABEL_KEBERHASILAN.get(kelas, {
            'label': 'Tidak Diketahui', 'warna': '#6b7280',
            'deskripsi': '-', 'rekomendasi': [],
        })

        probabilitas = {str(i): round(float(p), 4) for i, p in enumerate(proba_arr)}

        response = {
            'success':      True,
            'model_used':   model_label,
            'kelas':        kelas,
            'label':        info['label'],
            'warna':        info['warna'],
            'deskripsi':    info['deskripsi'],
            'rekomendasi':  info['rekomendasi'],
            'probabilitas': probabilitas,
        }
        if model_type == 'ensemble':
            response['detail_ensemble'] = detail_ensemble

        return jsonify(response)

    except Exception as e:
        traceback.print_exc()
        return jsonify({'success': False, 'error': str(e)}), 500


@app.route('/info-model', methods=['GET'])
def info_model():
    return jsonify({
        'success': True,
        'models': {
            'kmeans':        {'endpoint': '/predict',                           'output': 'klaster 0-3'},
            'random_forest': {'endpoint': '/predict-keberhasilan',              'output': 'kelas 0-3'},
            'xgboost':       {'endpoint': '/predict-keberhasilan?model=xgboost','output': 'kelas 0-3'},
            'ensemble':      {'endpoint': '/predict-keberhasilan?model=ensemble','output': 'kelas 0-3'},
        },
        'prodi_tersedia': PRODI_LIST,
    })


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)