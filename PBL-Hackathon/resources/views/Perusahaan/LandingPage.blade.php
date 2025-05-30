<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skillbridge™</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <!-- Script modal -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="min-h-screen bg-gray-50 text-gray-800">
  <!-- Navbar -->
  <nav class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-blue-600">SkillBridge</h1>
    <div class="flex items-center gap-4">
      <span class="font-medium">PT. SkillMaju</span>
      <img src="https://i.pravatar.cc/40" alt="Profile" class="w-10 h-10 rounded-full cursor-pointer">
    </div>
  </nav>

  <!-- Container -->
  <div class="max-w-6xl mx-auto p-6">
    <!-- Welcome -->
    <div class="mb-6">
      <h2 class="text-2xl font-semibold">Selamat Datang, PT. SkillMaju 👋</h2>
      <p class="text-gray-600 mt-1">Kelola kursus Anda dan pantau progres peserta.</p>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold">Total Kursus</h3>
        <p class="text-3xl font-bold text-blue-600 mt-2">5</p>
      </div>
      <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold">Total Peserta</h3>
        <p class="text-3xl font-bold text-green-600 mt-2">120</p>
      </div>
      <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold">Rating Rata-rata</h3>
        <p class="text-3xl font-bold text-yellow-500 mt-2">4.6⭐</p>
      </div>
    </div>

    <!-- Aksi Cepat -->
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-xl font-semibold">Kursus Terbaru</h3>
      <div class="flex gap-2">
        <a href="/perusahaan/dashboard/kursus" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Kelola Kursus</a>
        <a href="/perusahaan/dashboard/tambah-kursus" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Tambah Kursus</a>
      </div>
    </div>

    <!-- Daftar Kursus -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
        <h4 class="text-lg font-bold">Dasar Welding</h4>
        <p class="text-sm text-gray-600 mt-1">Peserta: 80 | Rating: ⭐4.5</p>
      </div>
      <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
        <h4 class="text-lg font-bold">Fitting Pipa Lanjutan</h4>
        <p class="text-sm text-gray-600 mt-1">Peserta: 40 | Rating: ⭐4.8</p>
      </div>
      <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition">
        <h4 class="text-lg font-bold">Painting Industri</h4>
        <p class="text-sm text-gray-600 mt-1">Peserta: 20 | Rating: ⭐4.2</p>
      </div>
    </div>

    <!-- Optional: Review -->
    <div class="mt-10">
      <h3 class="text-xl font-semibold mb-4">Review Terbaru</h3>
      <div class="bg-white p-4 rounded-xl shadow">
        <p class="italic">"Materinya sangat lengkap dan instruktur sangat komunikatif!"</p>
        <p class="text-sm text-gray-500 mt-2">— Budi, peserta kursus Welding Dasar</p>
      </div>
    </div>
  </div>
</div>
