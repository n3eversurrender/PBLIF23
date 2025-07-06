from flask import Flask, request, jsonify
from sqlalchemy import create_engine
from sentence_transformers import SentenceTransformer, util
from transformers import AutoTokenizer, AutoModelForSequenceClassification
import pandas as pd
import numpy as np
import torch

app = Flask(__name__)

# ========================== DB CONFIG ==========================
DB_USERNAME = 'root'
DB_PASSWORD = ''
DB_HOST = '127.0.0.1'
DB_PORT = '3306'
DB_DATABASE = 'pbl_hackathon'
engine = create_engine(f"mysql+pymysql://{DB_USERNAME}:{DB_PASSWORD}@{DB_HOST}:{DB_PORT}/{DB_DATABASE}")

# ========================== DEVICE ==========================
device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')
print(f"Running on device: {device}")

# ========================== LAZY LOAD MODEL ==========================
loaded_models = {}

def load_model(model_type):
    if model_type == 'sentimen':
        print("🔹 Loading Sentimen Model...")
        tokenizer = AutoTokenizer.from_pretrained("zainiridha/indobert-sentimen-finegrained")
        model = AutoModelForSequenceClassification.from_pretrained("zainiridha/indobert-sentimen-finegrained")
        return {'type': 'huggingface', 'tokenizer': tokenizer, 'model': model.to(device)}

    elif model_type == 'tema':
        print("🔹 Loading Tema Model...")
        tokenizer = AutoTokenizer.from_pretrained("zainiridha/indobert-sentimen-finegrained-v2")
        model = AutoModelForSequenceClassification.from_pretrained("zainiridha/indobert-sentimen-finegrained-v2")
        return {'type': 'huggingface', 'tokenizer': tokenizer, 'model': model.to(device)}

    elif model_type == 'skillmatching':
        print("🔹 Loading Recommendation Model...")
        model = SentenceTransformer('paraphrase-multilingual-MiniLM-L12-v2')
        return {'type': 'sentence-transformer', 'model': model.to(device)}

    return None

def predict_model(texts, model_type):
    if model_type not in loaded_models:
        model_data = load_model(model_type)
        if model_data is None:
            raise Exception(f"Model type '{model_type}' tidak dikenali.")
        loaded_models[model_type] = model_data
    else:
        model_data = loaded_models[model_type]

    if model_data['type'] == 'sentence-transformer':
        model = model_data['model']
        embeddings = model.encode(texts, convert_to_tensor=True)
        return embeddings

    elif model_data['type'] == 'huggingface':
        tokenizer = model_data['tokenizer']
        model = model_data['model']

        tokens = tokenizer(texts, return_tensors="pt", padding=True, truncation=True, max_length=128)
        tokens = {key: val.to(device) for key, val in tokens.items()}

        with torch.no_grad():
            outputs = model(**tokens)

        pred = torch.argmax(outputs.logits, dim=1).tolist()
        labels = [model.config.id2label[i] for i in pred]
        return labels

    else:
        raise Exception(f"Tipe model '{model_data['type']}' tidak dikenali.")

# ========================== DSS LOGIC ==========================
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

# ========================== ROUTES ==========================
@app.route('/')
def index():
    return "Selamat datang di API PBL Hackathon Gabungan!"

# DSS API
@app.route('/rekomendasi', methods=['POST'])
def rekomendasi():
    data = request.json

    try:
        harga_maks = float(data['harga_maks'])
        rating_min = float(data['rating_min'])
        rating_perusahaan_min = float(data.get('rating_perusahaan_min', 4.0))
        tingkat_kesulitan = str(data['tingkat_kesulitan'])
        lokasi = str(data['lokasi'])
    except (ValueError, KeyError, TypeError):
        return jsonify({'message': 'Input data tidak valid'}), 400

    weights = np.array([30, 25, 25, 10, 10]) / 100

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

    df.fillna({
        'harga': 0,
        'avg_rating': 0,
        'avg_rating_perusahaan': 0,
        'tingkat_kesulitan': 'Pemula',
        'lokasi': ''
    }, inplace=True)

    df['Skor_Total'] = df.apply(hitung_nilai_total, weights=weights, axis=1).round(2)

    skor_input = (
        nilai_harga(harga_maks) * weights[0] +
        nilai_rating(rating_min) * weights[1] +
        nilai_rating_perusahaan(rating_perusahaan_min) * weights[2] +
        nilai_tingkat_kesulitan(tingkat_kesulitan) * weights[3] +
        nilai_lokasi(lokasi) * weights[4]
    )

    df['Selisih_Skor'] = (df['Skor_Total'] - skor_input).abs().round(2)

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

# ========================== API 1: PROSES ULASAN REALTIME ==========================
@app.route("/proses-ulasan-realtime", methods=["POST"])
def proses_ulasan_realtime():
    try:
        if not request.is_json:
            return jsonify({"success": False, "error": "Request harus dalam format JSON"}), 400

        data = request.get_json()
        pengguna_id = data.get('pengguna_id')
        if not pengguna_id:
            return jsonify({"success": False, "error": "pengguna_id wajib dikirim"}), 400

        query_kursus = """
            SELECT rk.komentar AS komentar
            FROM rating_kursus rk
            JOIN kursus k ON rk.kursus_id = k.kursus_id
            WHERE k.pengguna_id = %(pengguna_id)s
        """

        query_perusahaan = """
            SELECT rp.komentar AS komentar
            FROM rating_perusahaan rp
            JOIN perusahaan p ON rp.perusahaan_id = p.perusahaan_id
            WHERE p.pengguna_id = %(pengguna_id)s
        """

        df_kursus = pd.read_sql(query_kursus, engine, params={"pengguna_id": pengguna_id})
        df_perusahaan = pd.read_sql(query_perusahaan, engine, params={"pengguna_id": pengguna_id})

        df = pd.concat([df_kursus, df_perusahaan], ignore_index=True)

        if df.empty:
            return jsonify({
                "success": True,
                "message": "Tidak ada komentar untuk dianalisis.",
                "distribusi": {},
                "jumlah_prediksi": {},
                "tema_sentimen_count": {}
            }), 200

        print(f"🔹 Mulai prediksi {len(df)} komentar...")

        df['sentimen'] = predict_model(df['komentar'].tolist(), 'sentimen')
        df['tema_v2'] = predict_model(df['komentar'].tolist(), 'tema')

        distribusi = df['sentimen'].value_counts(normalize=True).mul(100).round(0).to_dict()
        jumlah = df['sentimen'].value_counts().to_dict()

        tema_sentimen_count = {}
        grouped = df.groupby(['tema_v2', 'sentimen']).size().unstack(fill_value=0)
        for tema, row in grouped.iterrows():
            tema_sentimen_count[tema] = row.to_dict()

        return jsonify({
            "success": True,
            "message": f"{len(df)} komentar berhasil dianalisis.",
            "distribusi": distribusi,
            "jumlah_prediksi": jumlah,
            "tema_sentimen_count": tema_sentimen_count
        })

    except Exception as e:
        print(f"❌ ERROR: {e}")
        return jsonify({"success": False, "error": str(e)}), 500

# ========================== API 2: SKILLMATCHING ==========================
@app.route('/skillmatching', methods=['POST'])
def skillmatching():
    try:
        data = request.json
        pengguna_id = data.get('pengguna_id')
        if not pengguna_id:
            return jsonify({'success': False, 'message': 'pengguna_id wajib dikirim'}), 400

        query_trainee = "SELECT * FROM peserta WHERE pengguna_id = %(pengguna_id)s"
        trainee_df = pd.read_sql(query_trainee, engine, params={"pengguna_id": pengguna_id})

        if trainee_df.empty:
            return jsonify({'success': False, 'message': 'Data trainee tidak ditemukan.'}), 404

        trainee_profile = trainee_df.iloc[0].to_dict()

        input_text = (
            f"Saya adalah seorang {trainee_profile['status']} dengan latar belakang "
            f"{trainee_profile['pendidikan']}. Saya memiliki minat dalam bidang "
            f"{trainee_profile['minat_bidang']} dan fokus pada {trainee_profile['bidang_saat_ini']}. "
            f"Saya pernah {trainee_profile.get('pengalaman', 'belum memiliki pengalaman')}, dan saat ini "
            f"{trainee_profile.get('nama_keahlian', 'belum memiliki keahlian khusus')}. "
            f"Saya lebih memilih kursus dengan tingkat {trainee_profile.get('preferensi_level', 'menengah')}."
        )

        kursus_df = pd.read_sql("SELECT * FROM kursus", engine)

        if kursus_df.empty:
            return jsonify({'success': False, 'message': 'Data kursus tidak ditemukan.'}), 404

        preferensi_level = trainee_profile.get('preferensi_level', 'menengah')
        filtered_df = kursus_df[kursus_df['tingkat_kesulitan'].str.lower() == preferensi_level.lower()]

        if filtered_df.empty:
            return jsonify({'success': True, 'message': 'Tidak ada kursus dengan level sesuai preferensi trainee.', 'rekomendasi': []}), 200

        course_texts = [
            f"{judul}. {deskripsi}. Tingkat kesulitan: {tingkat_kesulitan}"
            for judul, deskripsi, tingkat_kesulitan in zip(filtered_df['judul'], filtered_df['deskripsi'], filtered_df['tingkat_kesulitan'])
        ]
        course_ids = filtered_df['kursus_id'].tolist()

        # ========================== Similarity ==========================
        trainee_embedding = predict_model([input_text], 'skillmatching')
        course_embeddings = predict_model(course_texts, 'skillmatching')

        cosine_scores = util.pytorch_cos_sim(trainee_embedding, course_embeddings)
        top_k = min(3, len(course_ids))
        top_results = cosine_scores[0].topk(top_k)

        skillmatching = []
        for score, idx in zip(top_results[0], top_results[1]):
            skillmatching.append({
                'kursus_id': course_ids[idx],
                'score': round(score.item(), 4)
            })

        return jsonify({
            'success': True,
            'message': 'Berikut adalah skillmatching kursus terdekat:',
            'skillmatching': skillmatching
        })

    except Exception as e:
        print(f"❌ ERROR: {e}")
        return jsonify({'success': False, 'error': str(e)}), 500



# ========================== API 2: PREDICT ULASAN BATCH ==========================
def get_historis_negatif():
    query = """
        SELECT DATE(created_at) AS tgl,
               SUM(CASE WHEN pred_label = 'negatif' THEN 1 ELSE 0 END) / COUNT(*) * 100 AS persen_negatif
        FROM rating_kursus
        WHERE pred_label IS NOT NULL
        GROUP BY tgl
        ORDER BY tgl DESC
        LIMIT 7
    """
    df = pd.read_sql(query, engine)
    if df.empty:
        return pd.Series([0])
    return df['persen_negatif']

@app.route("/predict-ulasan", methods=["POST"])
def predict_ulasan():
    data = request.json
    komentar_list = data.get("komentar", [])

    if not komentar_list:
        return jsonify({
            "distribusi": {},
            "rekomendasi": "Tidak ada komentar untuk dianalisis.",
            "batas_aman": None,
            "pred_negatif": None,
            "historis": []
        })

    labels = predict_model(komentar_list, 'sentimen')

    count_label = pd.Series(labels).value_counts().to_dict()
    distribusi = pd.Series(labels).value_counts(normalize=True).mul(100).round(0).to_dict()

    historis_negatif = get_historis_negatif()
    avg = historis_negatif.mean()
    std = historis_negatif.std()

    if std == 0 or avg == 0:
        batas_aman = 30
    else:
        batas_aman = avg + 1.5 * std

    pred_negatif = distribusi.get('negatif', 0)

    positif_persen = distribusi.get('positif', 0)
    negatif_persen = distribusi.get('negatif', 0)
    netral_persen = distribusi.get('netral', 0)

    if positif_persen > negatif_persen and positif_persen > netral_persen:
        rekom = "✅ Layanan sangat baik, pertahankan kualitas!"
    elif negatif_persen > positif_persen and negatif_persen > netral_persen:
        rekom = "🚨 Banyak komentar negatif, segera evaluasi layanan kursus."
    elif netral_persen > positif_persen and netral_persen > negatif_persen:
        rekom = "⚠ Banyak komentar netral, pertimbangkan untuk meningkatkan daya tarik layanan."
    else:
        rekom = "ℹ Layanan stabil. Lanjutkan monitoring rutin."

    return jsonify({
        "distribusi": distribusi,
        "jumlah_prediksi": count_label,
        "rekomendasi": rekom,
        "batas_aman": batas_aman,
        "pred_negatif": pred_negatif,
        "historis": historis_negatif.tolist(),
        "labels": labels
    })

if __name__ == '__main__':
    app.run(debug=True, port=9999)