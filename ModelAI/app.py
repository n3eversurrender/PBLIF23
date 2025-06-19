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
    if rating >= 4.5:
        return 1
    elif rating >= 4.0:
        return 0.75
    elif rating >= 3.0:
        return 0.50
    else:
        return 0.25

def nilai_rating_perusahaan(rating):
    if rating >= 4.5:
        return 1
    elif rating >= 4.0:
        return 0.75
    elif rating >= 3.0:
        return 0.50
    else:
        return 0.25

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
        nilai_rating_perusahaan(row['avg_rating_perusahaan']) * weights[2] +
        nilai_tingkat_kesulitan(row['tingkat_kesulitan']) * weights[3] +
        nilai_lokasi(row['lokasi']) * weights[4]
    )

@app.route('/')
def index():
    return "Selamat datang di API Rekomendasi Kursus!"

@app.route('/rekomendasi', methods=['POST'])
def rekomendasi():
    data = request.json

    try:
        harga_maks = float(data['harga_maks'])
        rating_min = float(data['rating_min'])
        rating_perusahaan_min = float(data.get('rating_perusahaan_min', 4.0))  # default 4.0
        tingkat_kesulitan = str(data['tingkat_kesulitan'])
        lokasi = str(data['lokasi'])
    except (ValueError, KeyError, TypeError):
        return jsonify({'message': 'Input data tidak valid'}), 400

    # Bobot kriteria
    weights = np.array([30, 25, 25, 10, 10]) / 100

    # Query data
    query = """
    SELECT 
        k.*,
        COALESCE(AVG(rk.rating), 0) AS avg_rating,
        COALESCE(rp.avg_rating_perusahaan, 0) AS avg_rating_perusahaan
    FROM kursus k
    LEFT JOIN rating_kursus rk ON k.kursus_id = rk.kursus_id
    LEFT JOIN (
        SELECT p.perusahaan_id, AVG(rpr.rating) AS avg_rating_perusahaan
        FROM perusahaan p
        LEFT JOIN rating_perusahaan rpr ON p.perusahaan_id = rpr.perusahaan_id
        GROUP BY p.perusahaan_id
    ) AS rp ON rp.perusahaan_id = (
        SELECT perusahaan.perusahaan_id 
        FROM perusahaan 
        WHERE perusahaan.pengguna_id = k.pengguna_id 
        LIMIT 1
    )
    GROUP BY k.kursus_id
    """

    df = pd.read_sql(query, engine)

    # Isi NaN
    df.fillna({
        'harga': 0,
        'avg_rating': 0,
        'avg_rating_perusahaan': 0,
        'tingkat_kesulitan': 'Pemula',
        'lokasi': ''
    }, inplace=True)

    # Hitung skor
    df['Skor_Total'] = df.apply(hitung_nilai_total, weights=weights, axis=1).round(2)

    # Skor input user
    skor_input = (
        nilai_harga(harga_maks) * weights[0] +
        nilai_rating(rating_min) * weights[1] +
        nilai_rating_perusahaan(rating_perusahaan_min) * weights[2] +
        nilai_tingkat_kesulitan(tingkat_kesulitan) * weights[3] +
        nilai_lokasi(lokasi) * weights[4]
    )

    # Selisih
    df['Selisih_Skor'] = (df['Skor_Total'] - skor_input).abs().round(2)

    # Sort dan pilih
    df_sorted = df.sort_values(by='Selisih_Skor')
    rekomendasi = df_sorted.head(5).round({
        'avg_rating': 1,
        'avg_rating_perusahaan': 1,
        'harga': 0,
        'Skor_Total': 2,
        'Selisih_Skor': 2
    }).to_dict(orient='records')

    return jsonify({
        'message': 'Berikut adalah kursus dengan skor total terdekat berdasarkan input Anda:',
        'skor_input': round(skor_input, 2),
        'rekomendasi': rekomendasi
    })

if __name__ == '__main__':
    app.run(debug=True, port=9999)

