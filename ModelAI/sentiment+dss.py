from flask import Flask, jsonify, request
import pandas as pd
import torch
from transformers import AutoTokenizer, AutoModelForSequenceClassification
from sqlalchemy import create_engine

app = Flask(__name__)

# Load IndoBERT model
tokenizer = AutoTokenizer.from_pretrained("zainiridha/indobert-sentimen-finegrained")
model = AutoModelForSequenceClassification.from_pretrained("zainiridha/indobert-sentimen-finegrained")

# DB config
DB_USERNAME = 'root'
DB_PASSWORD = ''
DB_HOST = '127.0.0.1'
DB_PORT = '3306'
DB_DATABASE = 'pbl_hackathon'
engine = create_engine(f"mysql+pymysql://{DB_USERNAME}:{DB_PASSWORD}@{DB_HOST}:{DB_PORT}/{DB_DATABASE}")

# Predict helper
def predict_batch(texts):
    tokens = tokenizer(texts, return_tensors="pt", padding=True, truncation=True, max_length=128)
    with torch.no_grad():
        outputs = model(**tokens)
    pred_ids = torch.argmax(outputs.logits, dim=1).tolist()
    return [model.config.id2label[id] for id in pred_ids]

# Ambil historis rating_kursus
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

    labels = predict_batch(komentar_list)
    distribusi = pd.Series(labels).value_counts(normalize=True).to_dict()

    historis_negatif = get_historis_negatif()
    avg = historis_negatif.mean()
    std = historis_negatif.std()

    if std == 0 or avg == 0:
        batas_aman = 30
    else:
        batas_aman = avg + 1.5 * std

    pred_negatif = distribusi.get('negatif', 0) * 100

    if pred_negatif > batas_aman:
        rekom = "🚨 Prediksi negatif tinggi! Segera evaluasi layanan kursus."
    elif distribusi.get('positif', 0) > 0.7:
        rekom = "✅ Layanan sangat baik, pertahankan kualitas!"
    elif distribusi.get('negatif', 0) > 0.3:
        rekom = "⚠ Banyak komentar negatif, lakukan evaluasi mendalam."
    else:
        rekom = "ℹ Layanan stabil. Lanjutkan monitoring rutin."

    return jsonify({
        "distribusi": distribusi,
        "rekomendasi": rekom,
        "batas_aman": batas_aman,
        "pred_negatif": pred_negatif,
        "historis": historis_negatif.tolist(),
        "labels": labels
    })

if __name__ == "__main__":
    app.run(debug=True, port=9999)
