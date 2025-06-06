@extends('layouts.main')

@section('Main')

<main>
    <section class="bg-gray-50 text-gray-800 font-sans mt-12 md:mt-18">
        <div class="container mx-auto px-4 py-8 max-w-4xl">
            <!-- Header Section -->
            <div class="border-b border-gray-200 pb-6 lg:mb-8 mx-2 cursor-default">
                <h1 class="text-3xl md:text-4xl font-bold">{{ $pendaftaran->kursus->judul }}</h1>
                <span class="inline-block mt-3 px-4 py-1 rounded-full bg-blue-100 text-ButtonBase text-sm font-medium">
                    <i class="fas fa-spinner fa-spin mr-1"></i> {{ $pendaftaran->status_pendaftaran ?? 'Status Tidak Tersedia' }}
                </span>
            </div>

            <!-- Registration Info Card -->
            <div class="bg-white rounded-xl shadow-sm p-4 sm:p-8 lg:p-6 mb-6 cursor-default">
                <div class="flex items-center mb-5">
                    <i class="fas fa-receipt text-ButtonBase text-xl mr-3"></i>
                    <h2 class="text-xl font-semibold">Informasi Pendaftaran</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <p class="text-gray-500 text-sm">Tanggal Pembelian</p>
                        <p class="font-medium">{{ \Carbon\Carbon::parse($pendaftaran->tgl_pendaftaran)->translatedFormat('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Kode Pendaftaran</p>
                        <p class="font-medium">PEN-{{ $pendaftaran->pendaftaran_id }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Metode Pembayaran</p>
                        <p class="font-medium">{{ $pendaftaran->pembayaran->first()->metode_pembayaran ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Course Details Card -->
            <div class="bg-white rounded-xl shadow-sm p-4 sm:p-8 lg:p-6 mb-6">
                <div class="flex items-center mb-5 cursor-default">
                    <i class="fas fa-book-open text-ButtonBase text-xl mr-3"></i>
                    <h2 class="text-xl font-semibold">Detail Kursus</h2>
                </div>
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <div class="mb-5 cursor-default">
                            <p class="text-gray-500 text-sm mb-2">Deskripsi</p>
                            <p class="text-gray-700">
                                {{ $pendaftaran->kursus->deskripsi }}
                            </p>
                        </div>
                        <table class="w-full cursor-default">
                            <thead class="bg-gray-200 rounded-lg text-xs sm:text-sm">
                                <tr>
                                    <th class="py-3 px-4 text-left font-semibold text-primary">Tanggal Mulai</th>
                                    <th class="py-3 px-4 text-left font-semibold text-primary">Tanggal Selesai</th>
                                    <th class="py-3 px-4 text-left font-semibold text-primary">Lokasi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-[10px] sm:text-sm">
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-4 px-4">{{ \Carbon\Carbon::parse($pendaftaran->kursus->tgl_mulai)->translatedFormat('d F Y') }}</td>
                                    <td class="py-4 px-4">{{ \Carbon\Carbon::parse($pendaftaran->kursus->tgl_selesai)->translatedFormat('d F Y') }}</td>
                                    <td class="py-4 px-4">{{ $pendaftaran->kursus->lokasi }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Additional Info -->
                    <div class="my-6 bg-white rounded-xl shadow-sm md:p-6 p-2">
                        <h3 class="font-semibold text-base md:text-lg mb-3 flex items-center">
                            <i class="fas fa-exclamation-circle text-primary mr-2"></i>
                            Informasi Penting
                        </h3>
                        <ul class="list-disc text-xs md:text-sm pl-5 space-y-2 text-gray-700">
                            <li>Pastikan hadir tepat waktu.</li>
                            <li>Periksa email secara berkala untuk update kursus.</li>
                        </ul>
                    </div>
                </div>

                <!-- Action Card -->
                <div class="bg-white rounded-xl shadow-sm p-2 md:p-6 mb-6">
                    <div class="flex items-center mb-5">
                        <i class="fas fa-bolt text-ButtonBase text-xl mr-3"></i>
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
                            <div class="md:mb-8 mb-2">
                                <h1 class="text-xl md:text-3xl font-bold text-primary mb-2">Beri Ulasan</h1>
                                <p class="text-gray-600 text-xs md:text-sm">Bagikan pengalaman Anda mengikuti</p>
                                <p class="font-semibold text-xs md:text-sm">{{ $pendaftaran->kursus->judul }}</p>
                            </div>

                            <!-- Review Form -->
                            <div class="shadow-sm">
                                <!-- Course Info -->
                                <div class="flex items-start mb-2 p-4 bg-gray-50 rounded-lg">
                                    <img src="{{ asset('image/SKILLB.png') }}" alt="Thumbnail Kursus" class="md:w-20 md:h-20 w-10 h-10 rounded-full object-cover mr-4">
                                    <div>
                                        <h3 class="font-bold text-base md:text-lg">{{ $pendaftaran->kursus->judul }}</h3>
                                        <div class="mt-1 flex items-center text-amber-400">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <span class="text-gray-600 ml-2 text-xs md:text-sm">
                                                {{ number_format($averageRating, 1) }} ({{ $totalReview }} ulasan)
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <form>
                                    <!-- Rating Section -->
                                    <div class="mb-6">
                                        <label class="block text-gray-700 font-medium mb-3 text-sm md:text-xs">
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
                                        <label for="review" class="block text-xs md:text-sm text-gray-700 font-medium mb-3">
                                            Ulasan Anda
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <textarea
                                            id="review"
                                            name="review"
                                            rows="5"
                                            class="w-full px-4 py-3 border border-gray-300 placeholder:text-xs md:placeholder:text-sm rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                            placeholder="Ceritakan pengalaman Anda ..."
                                            required></textarea>
                                        <p class="text-right text-xs md:text-sm text-gray-500 mt-1"><span id="char-count">0</span>/500 karakter</p>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="w-full text-xs md:text-sm py-3 bg-primary hover:bg-primary/90 text-white bg-ButtonBase font-medium rounded-lg transition duration-200">
                                        Kirim Ulasan
                                    </button>
                                </form>
                            </div>

                            <!-- Review Guidelines -->
                            <div class="mt-6 bg-white rounded-xl shadow-sm p-2 md:p-6">
                                <h3 class="font-semibold text-base md:text-lg mb-3 flex items-center">
                                    <i class="fas fa-info-circle text-primary mr-2"></i>
                                    Pedoman Ulasan
                                </h3>
                                <ul class="list-disc pl-5 space-y-2 text-gray-700 text-xs md:text-sm">
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
                    <div class="bg-gray-50 md:p-4 p-2 rounded-lg text-xs md:text-sm">
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