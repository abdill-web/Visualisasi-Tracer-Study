from flask import Flask, request, jsonify
import pandas as pd
import numpy as np
import joblib
import os

app = Flask(__name__)

# Load model dan scaler
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
model = joblib.load(os.path.join(BASE_DIR, 'KMeans_Model_A_K4_UMB.pkl'))
scaler = joblib.load(os.path.join(BASE_DIR, 'Scaler_Model_A_UMB.pkl'))
df_dataset = pd.read_csv(os.path.join(BASE_DIR, 'Dataset_Klasifikasi_Final_UMB_V4.csv'))

# Mapping klaster
KLASTER_MAP = {
    1: {'nama': 'Karir Linear',       'warna': '#10b981', 'deskripsi': 'Karir sesuai bidang studi, stabil dan terarah'},
    0: {'nama': 'Karir Lintas Jalur', 'warna': '#3b82f6', 'deskripsi': 'Karir di luar bidang studi, adaptif dan fleksibel'},
    3: {'nama': 'Karir Elit',         'warna': '#8b5cf6', 'deskripsi': 'Karir dengan posisi/pendapatan tinggi, kompetitif'},
    2: {'nama': 'Karir Tertunda',     'warna': '#f59e0b', 'deskripsi': 'Masih dalam proses, butuh dukungan lebih lanjut'},
}

FEATURE_COLS = [
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

@app.route('/health', methods=['GET'])
def health():
    return jsonify({'status': 'ok', 'message': 'Flask API running'})

@app.route('/predict', methods=['POST'])
def predict():
    try:
        data = request.json
        
        # Build feature vector
        features = []
        for col in FEATURE_COLS:
            val = data.get(col, 0)
            try:
                val = float(val) if val not in [None, '', 'Pilihan'] else 0.0
            except:
                val = 0.0
            features.append(val)
        
        X = np.array(features).reshape(1, -1)
        X_scaled = scaler.transform(X)
        klaster = int(model.predict(X_scaled)[0])
        
        info = KLASTER_MAP.get(klaster, {'nama': 'Tidak Diketahui', 'warna': '#6b7280', 'deskripsi': '-'})
        
        return jsonify({
            'success': True,
            'klaster': klaster,
            'nama_pola': info['nama'],
            'warna': info['warna'],
            'deskripsi': info['deskripsi'],
        })
    except Exception as e:
        return jsonify({'success': False, 'error': str(e)}), 500

@app.route('/statistik', methods=['GET'])
def statistik():
    try:
        # Distribusi klaster
        dist = df_dataset['Nama_Pola_Karir'].value_counts().to_dict()
        
        # Per program studi
        per_prodi = df_dataset.groupby(['S04. Program Studi', 'Nama_Pola_Karir']).size().reset_index(name='total')
        per_prodi_dict = {}
        for _, row in per_prodi.iterrows():
            prodi = row['S04. Program Studi']
            if prodi not in per_prodi_dict:
                per_prodi_dict[prodi] = {}
            per_prodi_dict[prodi][row['Nama_Pola_Karir']] = int(row['total'])
        
        # Rata-rata skor per klaster
        skor_per_klaster = df_dataset.groupby('Nama_Pola_Karir')[
            ['Skor_Inisiatif_Mencari_Kerja', 'Skor_Rata2_MetodeBelajar', 'Skor_Rata2_Kompetensi']
        ].mean().round(2).to_dict()
        
        return jsonify({
            'success': True,
            'total': len(df_dataset),
            'distribusi': dist,
            'per_prodi': per_prodi_dict,
            'skor_per_klaster': skor_per_klaster,
        })
    except Exception as e:
        return jsonify({'success': False, 'error': str(e)}), 500

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)