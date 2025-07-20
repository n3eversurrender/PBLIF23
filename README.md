# 🎓 SkillBridge – Aplikasi Rekomendasi Kursus Berbasis AI

SkillBridge adalah aplikasi berbasis **Laravel 11** yang dikembangkan sebagai proyek *PBL IF23*. Aplikasi ini menggunakan **Tailwind CSS** dan **Flowbite** untuk tampilan antarmuka, serta mengintegrasikan modul **AI berbasis Python** menggunakan model **IndoBERT** untuk memberikan rekomendasi kursus berdasarkan preferensi dan kemampuan pengguna.

---

## 📦 Spesifikasi Teknis

Perangkat lunak yang dibutuhkan untuk menjalankan SkillBridge:
1. Windows sebagai sistem operasi
2. XAMPP (Apache, PHP, dan MySQL)
3. Visual Studio Code
4. Google Chrome atau Microsoft Edge

---

## ⚙️ Langkah Instalasi

### 1. Menyalin Project
- Buka Terminal / CMD melalui Visual Studio Code  
- Arahkan ke folder yang diinginkan  
- Jalankan perintah berikut:
  ```bash
  git clone https://github.com/n3eversurrender/PBLIF23.git

2. Menginstal Dependency & Generate Key
Buka terminal dan arahkan ke folder project

Jalankan perintah berikut:

bash
Salin
Edit
composer install
npm install
php artisan key:generate
3. Konfigurasi File Environment (.env)
Salin file .env.example

Ubah namanya menjadi .env

4. Membuat Database
Jalankan Apache dan MySQL melalui XAMPP

Buka http://localhost/phpmyadmin di browser

Buat database baru dengan nama:

nginx
Salin
Edit
pbl_hackathon
5. Migrasi & Seeder Database
Jalankan perintah berikut di terminal:

bash
Salin
Edit
php artisan migrate --seed
6. Menjalankan Aplikasi
Buka dua terminal:

Terminal 1:

bash
Salin
Edit
php artisan serve
Terminal 2:

bash
Salin
Edit
npm run dev
🤖 Modul AI
Folder src/ berisi skrip Python yang digunakan untuk sistem rekomendasi berbasis AI. Instal dependensi menggunakan:

bash
Salin
Edit
pip install -r requirements.txt
Dependensi utama:

transformers

torch

pandas

🧪 Testing
Jalankan testing Laravel dengan perintah:

bash
Salin
Edit
php artisan test
📁 Repositori
GitHub: https://github.com/n3eversurrender/PBLIF23

nginx
Salin
Edit

Kalau mau saya tambahkan bagian lain seperti lisensi atau cara penggunaan AI, tinggal bilang ya!