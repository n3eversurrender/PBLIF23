from flask import Flask, request, jsonify
from sqlalchemy import create_engine
import pandas as pd
import numpy as np

app = Flask(__name__)

# Konfigurasi Database MySQL
DB_USERNAME = 'root'
DB_PASSWORD = ''
DB_HOST = '127.0.0.1'
DB_PORT = '3306'
DB_DATABASE = 'pbl_hackathon'

# Koneksi ke database
engine = create_engine(f"mysql+pymysql://{DB_USERNAME}:{DB_PASSWORD}@{DB_HOST}:{DB_PORT}/{DB_DATABASE}")

# Fungsi Normalisasi
def nilai_harga(harga):
    if harga <= 3_000_000:
        return 1
    elif harga <= 5_000_000:
        return 0.75
    elif harga <= 7_000_000:
        return 0.50
    else:
        return 0.25

def nilai_rating(rating):
    if rating >= 9:
        return 1
    elif rating >= 7:
        return 0.75
    elif rating >= 5:
        return 0.50
    else:
        return 0.25

def nilai_pengalaman(pengalaman):
    if pengalaman > 10:
        return 1
    elif pengalaman >= 5:
        return 0.75
    else:
        return 0.50

def nilai_tingkat_kesulitan(tingkat):
    if tingkat == 'Pemula':
        return 1
    elif tingkat == 'Menengah':
        return 0.75
    else:
        return 0.50

def nilai_lokasi(lokasi):
    nilai_lokasi_map = {
        'Batam Center': 1,
        'Batu Aji': 0.805,
        'Batu Ampar': 0.537,
        'Belakang Padang': 0.537,
        'Bengkong': 0.537,
        'Bulang': 0.537,
        'Galang': 0.537,
        'Lubuk Baja': 0.537,
        'Nongsa': 0.537,
        'Segulung': 0.537,
        'Sei Beduk': 0.537,
        'Sekupang': 0.537
    }
    return nilai_lokasi_map.get(lokasi, 0.289)

def hitung_nilai_total(row, weights):
    return (
        nilai_harga(row['harga']) * weights[0] +
        nilai_rating(row['avg_rating']) * weights[1] +
        nilai_pengalaman(row['pengalaman_total_pelatih']) * weights[2] +
        nilai_tingkat_kesulitan(row['tingkat_kesulitan']) * weights[3] +
        nilai_lokasi(row['lokasi']) * weights[4]
    )

@app.route('/')
def index():
    return "Selamat datang di API Rekomendasi!"

@app.route('/rekomendasi', methods=['POST'])
def rekomendasi():
    # Ambil input dari request
    data = request.json

    # Validasi dan konversi tipe data
    try:
        harga_maks = float(data['harga_maks'])
        rating_min = float(data['rating_min'])
        pengalaman_min = int(data['pengalaman_min'])
        tingkat_kesulitan = str(data['tingkat_kesulitan'])
        lokasi = str(data['lokasi'])
    except (ValueError, KeyError, TypeError):
        return jsonify({'message': 'Input data tidak valid'}), 400

    # Bobot Kriteria
    weights = np.array([30, 20, 25, 10, 15]) / 100

    # Query untuk mendapatkan data kursus
    query = """
    SELECT kursus.*, 
           COALESCE(AVG(rating_kursus.rating), 0) AS avg_rating,
           pelatih.tahun_pengalaman AS pelatih_tahun_pengalaman,
           pelatih.bulan_pengalaman AS pelatih_bulan_pengalaman,
           (pelatih.tahun_pengalaman + pelatih.bulan_pengalaman / 12) AS pengalaman_total_pelatih
    FROM kursus
    LEFT JOIN rating_kursus ON kursus.kursus_id = rating_kursus.kursus_id
    LEFT JOIN pelatih ON kursus.pengguna_id = pelatih.pengguna_id
    GROUP BY kursus.kursus_id
    """
    df = pd.read_sql(query, engine)

    # Pastikan kolom memiliki tipe data yang benar
    df['harga'] = pd.to_numeric(df['harga'], errors='coerce')
    df['avg_rating'] = pd.to_numeric(df['avg_rating'], errors='coerce')
    df['pengalaman_total_pelatih'] = pd.to_numeric(df['pengalaman_total_pelatih'], errors='coerce')

    # Isi nilai NaN atau NaT dengan nilai default
    df.fillna({
        'harga': 0,
        'avg_rating': 0,
        'pengalaman_total_pelatih': 0,
        'tingkat_kesulitan': 'Pemula',
        'lokasi': ''
    }, inplace=True)

    datetime_columns = df.select_dtypes(include=['datetime']).columns
    df[datetime_columns] = df[datetime_columns].fillna("").astype(str)


    # Hitung skor total untuk kursus
    df['Skor_Total'] = df.apply(hitung_nilai_total, weights=weights, axis=1).round(2)

    # Hitung skor input pengguna
    skor_input = (
        nilai_harga(harga_maks) * weights[0] +
        nilai_rating(rating_min) * weights[1] +
        nilai_pengalaman(pengalaman_min) * weights[2] +
        nilai_tingkat_kesulitan(tingkat_kesulitan) * weights[3] +
        nilai_lokasi(lokasi) * weights[4]
    )

    # Hitung selisih skor
    df['Selisih_Skor'] = (df['Skor_Total'] - skor_input).abs().round(2)

    # Urutkan berdasarkan selisih skor
    df_sorted = df.sort_values(by='Selisih_Skor')
    rekomendasi = df_sorted.head(5).round({'avg_rating': 1, 'pengalaman_total_pelatih': 1, 'harga': 0, 'Skor_Total': 2, 'Selisih_Skor': 2}).to_dict(orient='records')

    return jsonify({
        'message': 'Berikut adalah kursus dengan skor total terdekat berdasarkan input Anda:',
        'skor_input': round(skor_input, 2),
        'rekomendasi': rekomendasi
    })

if __name__ == '__main__':
    app.run(debug=True, port=9999)
