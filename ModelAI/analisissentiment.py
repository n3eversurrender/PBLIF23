from flask import Flask, request, jsonify
import pandas as pd
from transformers import AutoTokenizer, AutoModelForSequenceClassification, pipeline
from sqlalchemy import create_engine

app = Flask(__name__)

# DB config
DB_USERNAME = 'root'
DB_PASSWORD = ''
DB_HOST = '127.0.0.1'
DB_PORT = '3306'
DB_DATABASE = 'pbl_hackathon'

engine = create_engine(
    f"mysql+pymysql://{DB_USERNAME}:{DB_PASSWORD}@{DB_HOST}:{DB_PORT}/{DB_DATABASE}"
)

# Load models sekali saat startup
print("🔹 Loading Sentimen Model...")
sent_tokenizer = AutoTokenizer.from_pretrained("zainiridha/indobert-sentimen-finegrained")
sent_model = AutoModelForSequenceClassification.from_pretrained("zainiridha/indobert-sentimen-finegrained")
sent_pipeline = pipeline("text-classification", model=sent_model, tokenizer=sent_tokenizer)

print("🔹 Loading Tema Model...")
tema_tokenizer = AutoTokenizer.from_pretrained("zainiridha/indobert-sentimen-finegrained-v2")
tema_model = AutoModelForSequenceClassification.from_pretrained("zainiridha/indobert-sentimen-finegrained-v2")
tema_pipeline = pipeline("text-classification", model=tema_model, tokenizer=tema_tokenizer)

def predict_sentimen_tema(df):
    df['sentimen'] = df['komentar'].apply(lambda x: sent_pipeline(x)[0]['label'])
    df['tema_v2'] = df['komentar'].apply(lambda x: tema_pipeline(x)[0]['label'])
    return df

@app.route("/proses-ulasan-realtime", methods=["POST"])
def proses_ulasan_realtime():
    try:
        if not request.is_json:
            return jsonify({"error": "Request harus dalam format JSON"}), 400

        data = request.get_json()
        pengguna_id = data.get('pengguna_id')
        if not pengguna_id:
            return jsonify({"error": "pengguna_id wajib dikirim"}), 400

        # Ambil komentar kursus + perusahaan
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
                "message": "Tidak ada komentar untuk dianalisis.",
                "distribusi": {},
                "jumlah_prediksi": {},
                "labels": [],
                "tema_v2": []
            }), 200

        # Prediksi
        print(f"🔹 Mulai prediksi {len(df)} komentar...")
        df['sentimen'] = df['komentar'].apply(lambda x: sent_pipeline(x)[0]['label'])
        df['tema_v2'] = df['komentar'].apply(lambda x: tema_pipeline(x)[0]['label'])

        # Distribusi total
        distribusi = df['sentimen'].value_counts(normalize=True).mul(100).round(0).to_dict()
        jumlah = df['sentimen'].value_counts().to_dict()

        # Distribusi per tema + sentimen
        tema_sentimen_count = {}
        grouped = df.groupby(['tema_v2', 'sentimen']).size().unstack(fill_value=0)
        for tema, row in grouped.iterrows():
            tema_sentimen_count[tema] = row.to_dict()

        return jsonify({
            "message": f"{len(df)} komentar berhasil dianalisis.",
            "distribusi": distribusi,
            "jumlah_prediksi": jumlah,
            "tema_sentimen_count": tema_sentimen_count
        })

    except Exception as e:
        print(f"❌ ERROR: {e}")
        return jsonify({"error": str(e)}), 500

if __name__ == "__main__":
    app.run(host="127.0.0.1", port=9999, debug=True)
