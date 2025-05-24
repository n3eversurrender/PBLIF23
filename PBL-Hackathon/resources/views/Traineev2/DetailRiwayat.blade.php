@extends('layouts.main')

@section('Main')

<main>
    <section class="bg-gray-50 text-gray-800 font-sans mt-20">
        <div class="container mx-auto px-4 py-8 max-w-4xl">
            <!-- Header Section -->
            <div class="border-b border-gray-200 pb-6 mb-8">
                <h1 class="text-3xl md:text-4xl font-bold">Workshop React Mastery</h1>
                <span class="inline-block mt-3 px-4 py-1 rounded-full bg-indigo-100 text-indigo-800 text-sm font-medium">
                    <i class="fas fa-spinner fa-spin mr-1"></i> Sedang Diambil
                </span>
            </div>

            <!-- Registration Info Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex items-center mb-5">
                    <i class="fas fa-receipt text-indigo-500 text-xl mr-3"></i>
                    <h2 class="text-xl font-semibold">Informasi Pendaftaran</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <p class="text-gray-500 text-sm">Tanggal Pembelian</p>
                        <p class="font-medium">06 Agustus 2023</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Kode Pendaftaran</p>
                        <p class="font-medium">SB-REACT-0823-001</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Metode Pembayaran</p>
                        <p class="font-medium">Transfer Bank (BCA)</p>
                    </div>
                </div>
            </div>

            <!-- Course Details Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex items-center mb-5">
                    <i class="fas fa-book-open text-indigo-500 text-xl mr-3"></i>
                    <h2 class="text-xl font-semibold">Detail Kursus</h2>
                </div>
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <div class="mb-5">
                            <p class="text-gray-500 text-sm mb-2">Deskripsi</p>
                            <p class="text-gray-700">
                                Workshop intensif selama 1 hari untuk menguasai React JS dari dasar hingga konsep intermediate.
                                Anda akan belajar membangun aplikasi React modern dengan hooks, context API, dan integrasi dengan backend.
                            </p>
                        </div>
                        <table class="w-full">
                            <thead class="bg-gray-200 rounded-lg">
                                <tr>
                                    <th class="py-3 px-4 text-left font-semibold text-primary">Sesi</th>
                                    <th class="py-3 px-4 text-left font-semibold text-primary">Tanggal</th>
                                    <th class="py-3 px-4 text-left font-semibold text-primary">Waktu</th>
                                    <th class="py-3 px-4 text-left font-semibold text-primary">Lokasi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <!-- Sesi 1 -->
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-4 px-4 font-medium">Sesi 1</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <i class="far fa-calendar mr-2 text-primary"></i>
                                            15 Agustus 2023
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <i class="far fa-clock mr-2 text-primary"></i>
                                            09:00 - 12:00 WIB
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2 text-primary"></i>
                                            Gedung A, Lantai 3
                                        </div>
                                    </td>

                                </tr>

                                <!-- Sesi 2 -->
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-4 px-4 font-medium">Sesi 2</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <i class="far fa-calendar mr-2 text-primary"></i>
                                            17 Agustus 2023
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <i class="far fa-clock mr-2 text-primary"></i>
                                            13:00 - 16:00 WIB
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2 text-primary"></i>
                                            Gedung A, Lantai 3
                                        </div>
                                    </td>

                                </tr>


                            </tbody>
                        </table>
                    </div>
                    <!-- Additional Info -->
                    <div class="mt-6 bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-semibold text-lg mb-3 flex items-center">
                            <i class="fas fa-exclamation-circle text-primary mr-2"></i>
                            Informasi Penting
                        </h3>
                        <ul class="list-disc pl-5 space-y-2 text-gray-700">
                            <li>Setiap sesi memiliki materi yang berbeda</li>
                            <li>Lokasi mungkin berubah - cek email konfirmasi 1 hari sebelum sesi</li>
                        </ul>
                    </div>
                </div>

                <!-- Action Card -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <div class="flex items-center mb-5">
                        <i class="fas fa-bolt text-indigo-500 text-xl mr-3"></i>
                        <h2 class="text-xl font-semibold">Aksi</h2>
                    </div>

                    <!-- Scenario 1: Ongoing Course -->
                    <button class="w-full md:w-auto px-6 py-3 mb-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition duration-200">
                        <i class="fas fa-flag-checkered mr-2"></i> Tandai Kursus Selesai
                    </button>

                    <!-- Scenario 2: Completed but not reviewed -->
                    <button class="w-full md:w-auto px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg transition duration-200">
                        <i class="fas fa-star mr-2"></i> Beri Ulasan Kursus
                    </button>

                    <!-- Scenario 3: Formulir inputan ulasan -->
                    <section>
                        <div class="py-10">
                            <!-- Header -->
                            <div class="mb-8">
                                <h1 class="text-3xl font-bold text-primary mb-2">Beri Ulasan</h1>
                                <p class="text-gray-600">Bagikan pengalaman Anda mengikuti</p>
                                <p class="font-semibold">Workshop React Mastery</p>
                            </div>

                            <!-- Review Form -->
                            <div class="shadow-sm">
                                <!-- Course Info -->
                                <div class="flex items-start mb-2 p-4 bg-gray-50 rounded-lg">
                                    <img src="{{ asset('image/SKILLB.png') }}" alt="Thumbnail Kursus" class="w-20 h-20 rounded-full object-cover mr-4">
                                    <div>
                                        <h3 class="font-bold text-lg">Workshop React Mastery</h3>
                                        <div class="mt-1 flex items-center text-amber-400">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <span class="text-gray-600 ml-2 text-sm">4.3 (128 ulasan)</span>
                                        </div>
                                    </div>
                                </div>

                                <form>
                                    <!-- Rating Section -->
                                    <div class="mb-6">
                                        <label class="block text-gray-700 font-medium mb-3">
                                            Bagaimana penilaian Anda secara keseluruhan?
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="flex justify-center space-x-2 mb-3" id="rating-stars">
                                            <!-- Stars will be inserted here by JavaScript -->
                                        </div>
                                        <div class="flex justify-between text-sm text-gray-500 px-2">
                                            <span>Tidak Puas</span>
                                            <span>Sangat Puas</span>
                                        </div>
                                        <input type="hidden" name="rating" id="rating-value" required>
                                    </div>

                                    <!-- Review Text -->
                                    <div class="mb-6">
                                        <label for="review" class="block text-gray-700 font-medium mb-3">
                                            Ulasan Anda
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <textarea
                                            id="review"
                                            name="review"
                                            rows="5"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                            placeholder="Ceritakan pengalaman Anda (minimal 50 karakter)..."
                                            required></textarea>
                                        <p class="text-right text-sm text-gray-500 mt-1"><span id="char-count">0</span>/500 karakter</p>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="w-full py-3 bg-primary hover:bg-primary/90 text-white bg-ButtonBase font-medium rounded-lg transition duration-200">
                                        Kirim Ulasan
                                    </button>
                                </form>
                            </div>

                            <!-- Review Guidelines -->
                            <div class="mt-6 bg-white rounded-xl shadow-sm p-6">
                                <h3 class="font-semibold text-lg mb-3 flex items-center">
                                    <i class="fas fa-info-circle text-primary mr-2"></i>
                                    Pedoman Ulasan
                                </h3>
                                <ul class="list-disc pl-5 space-y-2 text-gray-700 text-sm">
                                    <li>Berikan feedback yang jujur dan konstruktif</li>
                                    <li>Hindari konten bersifat pribadi atau SARA</li>
                                    <li>Ulasan tidak dapat diubah setelah dikirim</li>
                                </ul>
                            </div>
                        </div>

                        <script>
                            // Dynamic Star Rating
                            const ratingContainer = document.getElementById('rating-stars');
                            const ratingInput = document.getElementById('rating-value');

                            for (let i = 1; i <= 5; i++) {
                                const star = document.createElement('div');
                                star.className = 'text-3xl cursor-pointer text-gray-300 hover:text-amber-400';
                                star.innerHTML = '<i class="far fa-star" data-value="' + i + '"></i>';
                                star.addEventListener('click', function() {
                                    const value = this.querySelector('i').getAttribute('data-value');
                                    ratingInput.value = value;

                                    // Update stars display
                                    const stars = ratingContainer.querySelectorAll('i');
                                    stars.forEach((s, index) => {
                                        if (index < value) {
                                            s.className = 'fas fa-star text-amber-400';
                                        } else {
                                            s.className = 'far fa-star text-gray-300';
                                        }
                                    });
                                });
                                ratingContainer.appendChild(star);
                            }

                            // Character Counter
                            const reviewTextarea = document.getElementById('review');
                            const charCount = document.getElementById('char-count');

                            reviewTextarea.addEventListener('input', function() {
                                charCount.textContent = this.value.length;
                            });
                        </script>


                    </section>

                    <!-- Scenario 4: Already reviewed -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center text-amber-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="text-gray-700 ml-2">4.5/5</span>
                        </div>
                        <p class="font-medium italic">"Materinya bagus dan instruktur sangat komunikatif."</p>
                        <p class="text-sm text-gray-500 mt-1">Ulasan diberikan pada 30 Agustus 2023</p>
                    </div>
                </div>
    </section>
</main>

@endsection