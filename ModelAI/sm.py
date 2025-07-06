from flask import Flask, request, jsonify
from sqlalchemy import create_engine
from sentence_transformers import SentenceTransformer, util
import torch
import pandas as pd

app = Flask(__name__)

# ========================== DB CONFIG ==========================
DB_USERNAME = 'root'
DB_PASSWORD = ''
DB_HOST = '127.0.0.1'
DB_PORT = '3306'
DB_DATABASE = 'pbl_hackathon'
engine = create_engine(f"mysql+pymysql://{DB_USERNAME}:{DB_PASSWORD}@{DB_HOST}:{DB_PORT}/{DB_DATABASE}")

# ========================== LOAD MODEL ==========================
model = SentenceTransformer('paraphrase-multilingual-MiniLM-L12-v2')
device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')
model = model.to(device)

@app.route('/rekomendasi-kursus', methods=['POST'])
def rekomendasi_kursus():
    try:
        data = request.json
        pengguna_id = data.get('pengguna_id')
        if not pengguna_id:
            return jsonify({'message': 'pengguna_id wajib dikirim'}), 400

        # ========================== Ambil Data Trainee ==========================
        query_trainee = """
            SELECT * FROM peserta WHERE pengguna_id = %(pengguna_id)s
        """
        trainee_df = pd.read_sql(query_trainee, engine, params={"pengguna_id": pengguna_id})

        if trainee_df.empty:
            return jsonify({'message': 'Data trainee tidak ditemukan.'}), 404

        trainee_profile = trainee_df.iloc[0].to_dict()

        # ========================== Gabungkan Profil ==========================
        input_text = (
            f"Saya adalah seorang {trainee_profile['status']} dengan latar belakang "
            f"{trainee_profile['pendidikan']}. Saya memiliki minat dalam bidang "
            f"{trainee_profile['minat_bidang']} dan fokus pada {trainee_profile['bidang_saat_ini']}. "
            f"Saya pernah {trainee_profile.get('pengalaman', 'belum memiliki pengalaman')}, dan saat ini "
            f"{trainee_profile.get('nama_keahlian', 'belum memiliki keahlian khusus')}. "
            f"Saya lebih memilih kursus dengan tingkat {trainee_profile.get('preferensi_level', 'menengah')}."
        )

        # ========================== Ambil Data Kursus ==========================
        kursus_df = pd.read_sql("SELECT * FROM kursus", engine)

        if kursus_df.empty:
            return jsonify({'message': 'Data kursus tidak ditemukan.'}), 404

        preferensi_level = trainee_profile.get('preferensi_level', 'menengah')

        # Filter berdasarkan level
        filtered_df = kursus_df[kursus_df['level'].str.lower() == preferensi_level.lower()]

        if filtered_df.empty:
            return jsonify({'message': 'Tidak ada kursus dengan level sesuai preferensi trainee.'}), 200

        course_texts = [
            f"{title}. {desc}. Tingkat kesulitan: {level}"
            for title, desc, level in zip(filtered_df['title'], filtered_df['description'], filtered_df['level'])
        ]
        course_titles = filtered_df['title'].tolist()

        # ========================== Proses Similarity ==========================
        trainee_embedding = model.encode(input_text, convert_to_tensor=True)
        course_embeddings = model.encode(course_texts, convert_to_tensor=True)

        cosine_scores = util.pytorch_cos_sim(trainee_embedding, course_embeddings)

        top_k = min(3, len(course_titles))
        top_results = cosine_scores[0].topk(top_k)

        rekomendasi = []
        for score, idx in zip(top_results[0], top_results[1]):
            rekomendasi.append({
                'title': course_titles[idx],
                'score': round(score.item(), 4)
            })

        return jsonify({
            'message': 'Berikut adalah rekomendasi kursus terdekat:',
            'rekomendasi': rekomendasi
        })

    except Exception as e:
        print(f"❌ ERROR: {e}")
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True, port=9999)
