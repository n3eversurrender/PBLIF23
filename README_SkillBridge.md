
# 🎓 SkillBridge – Aplikasi Rekomendasi Kursus Berbasis AI

SkillBridge adalah aplikasi berbasis **Laravel 11** yang dibuat sebagai proyek *PBL IF23*.  
Aplikasi ini menggunakan **Tailwind CSS** dan **Flowbite** untuk tampilan, serta integrasi AI dengan model **IndoBERT** untuk rekomendasi kursus sesuai preferensi pengguna.

---

## 📦 Spesifikasi Teknis
- Sistem Operasi: Windows  
- Web Server & Database: XAMPP (Apache, PHP, MySQL)  
- Editor Kode: Visual Studio Code  
- Browser: Google Chrome / Microsoft Edge  

---

## ⚙️ Langkah Instalasi

### 1. Clone Repository  
```bash
git clone https://github.com/n3eversurrender/PBLIF23.git
```

### 2. Instal Dependency & Generate Key  
```bash
composer install
npm install
php artisan key:generate
```

### 3. Konfigurasi Environment  
- Salin file `.env.example` menjadi `.env`  
- Sesuaikan konfigurasi database dan variabel lain di `.env`  

### 4. Buat Database  
- Jalankan Apache dan MySQL lewat XAMPP  
- Buka http://localhost/phpmyadmin  
- Buat database dengan nama `pbl_hackathon`  

### 5. Migrasi dan Seed Database  
```bash
php artisan migrate --seed
```

### 6. Menjalankan Aplikasi  
Buka dua terminal:

- Terminal 1:  
```bash
php artisan serve
```

- Terminal 2:  
```bash
npm run dev
```

---

## 🤖 Modul AI  
Folder `src/` berisi skrip Python untuk sistem rekomendasi AI.

### Instal Dependensi Python  
```bash
pip install -r requirements.txt
```

### Modul utama:  
- transformers  
- torch  
- pandas  

---

## 🧪 Testing  
Jalankan testing Laravel dengan:  
```bash
php artisan test
```

---

## 📁 Repositori  
https://github.com/n3eversurrender/PBLIF23

---

Kalau butuh tambahan dokumentasi, lisensi, atau panduan penggunaan AI, tinggal minta ya!
