from flask import Flask, request, jsonify
from transformers import AutoTokenizer, AutoModelForSequenceClassification, pipeline
from bertopic import BERTopic
from sklearn.feature_extraction.text import CountVectorizer

app = Flask(__name__)

# Load model sekali saja saat server start
sent_tokenizer = AutoTokenizer.from_pretrained("zainiridha/indobert-sentimen-finegrained")
sent_model = AutoModelForSequenceClassification.from_pretrained("zainiridha/indobert-sentimen-finegrained")
sent_pipeline = pipeline("text-classification", model=sent_model, tokenizer=sent_tokenizer)

tema_tokenizer = AutoTokenizer.from_pretrained("zainiridha/indobert-sentimen-finegrained-v2")
tema_model = AutoModelForSequenceClassification.from_pretrained("zainiridha/indobert-sentimen-finegrained-v2")
tema_pipeline = pipeline("text-classification", model=tema_model, tokenizer=tema_tokenizer)

@app.route("/analyze", methods=["POST"])
def analyze():
    data = request.get_json()
    komentar_list = data.get("komentar", [])
    
    if not komentar_list:
        return jsonify({"error": "Tidak ada komentar dikirim"}), 400
    
    import pandas as pd
    df = pd.DataFrame({"komentar": komentar_list})

    # Prediksi
    df['sentimen'] = df['komentar'].apply(lambda x: sent_pipeline(x)[0]['label'])
    df['tema_v2'] = df['komentar'].apply(lambda x: tema_pipeline(x)[0]['label'])

    # BERTopic
    vectorizer_model = CountVectorizer(stop_words=[
        "yang","dan","di","ke","dari","untuk","dengan","pada","adalah","itu","ini",
        "sebagai","oleh","atau","sudah","akan","karena","juga"])
    topic_model = BERTopic(vectorizer_model=vectorizer_model, nr_topics=20, min_topic_size=5)
    
    topics, _ = topic_model.fit_transform(df['komentar'])
    df['topic_bertopic'] = topics
    df['tema_bertopic_auto'] = df['topic_bertopic'].apply(lambda x: 
        "Outlier / Tidak Terklasifikasi" if x == -1 else 
        ", ".join([w for w, _ in topic_model.get_topic(x)][:3])
    )

    return jsonify(df.to_dict(orient="records"))

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000)
