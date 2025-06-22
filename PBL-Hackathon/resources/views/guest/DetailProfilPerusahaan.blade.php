@extends('layouts.main')

@vite(['resources/js/home.js'])
@section('Main')

<main class="mt-16 mx-10">
    <section class="pt-8">
        <h1 class="font-bold text-2xl text-center mb-10 uppercase">{{ $user->nama ?? '-' }}</h1>
        <div class="sm:grid lg:grid-cols-4 sm:grid-cols-3 gap-4">
            <div class=" sm:col-span-1">
                <img
                    src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) 
                            : asset('image/Thumnnail.jpg') }}"
                    class="rounded-full aspect-square object-cover" />
            </div>
            <div class="lg:col-span-3 sm:col-span-2 px-2 lg:px-6 mt-5 sm:mt-0 text-sm sm:text-base">
                <div class="mb-3">
                    <label class="font-bold text-gray-900 uppercase">Deskripsi:</label>
                    <p class="text-gray-700">
                        {{ $perusahaan->deskripsi ?? '-' }}
                    </p>
                </div>

                <div class="mb-3">
                    <label class="font-bold text-gray-900">SERVICES:</label>
                    <ul class="text-gray-700">
                        <li>{{ $perusahaan->layanan ?? '-' }} </li>
                    </ul>
                </div>

                <div class="mb-3">
                    <label class="font-bold text-gray-900">VISION</label>
                    <p class="text-gray-700">{{ $perusahaan->visi ?? '-' }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-bold text-gray-900">MISION</label>
                    <p class="text-gray-700">{{ $perusahaan->misi ?? '-' }}</p>
                </div>

                <div>
                    <p class="font-semibold">Email : <span class="font-normal text-gray-700">{{ $user->email ?? '-' }}</span></p>
                    <p class="font-semibold">No Telepon : <span class="font-normal text-gray-700">{{ $user->no_telepon ?? '-' }}</span></p>
                    <p class="font-semibold">Alamat : <span class="font-normal text-gray-700">{{ $user->alamat ?? '-' }}</span></p>
                </div>
            </div>
        </div>
    </section>
    <!-- Informasi Tambahan -->
    <section class="my-5 px-10">
        <div class="bg-white rounded-xl shadow-md p-6 mt-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">📄 Informasi Legal</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="border-t pt-2">
                    <p class="text-sm text-gray-500 font-semibold">NPWP</p>
                    <p class="text-lg text-gray-800">{{ $perusahaan->npwp ?? '-' }}</p>
                </div>
                <div class="border-t pt-2">
                    <p class="text-sm text-gray-500 font-semibold">Akta Pendirian</p>
                    <p class="text-lg text-gray-800">{{ $perusahaan->akta_pendirian ?? '-' }}</p>
                </div>
                <div class="border-t pt-2">
                    <p class="text-sm text-gray-500 font-semibold">Izin Operasional</p>
                    <p class="text-lg text-gray-800">{{ $perusahaan->izin_operasional ?? '-' }}</p>
                </div>
                <div class="border-t pt-2">
                    <p class="text-sm text-gray-500 font-semibold">Sertifikasi BNSP</p>
                    <p class="text-lg text-gray-800">{{ $perusahaan->sertifikasi_bnsp ?? '-' }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="p-3">
        <div class="sm:mb-0 my-3">
            <div class="bg-gwhite text-center py-4">
                <div class="px-3 sm:px-10 pt-5 pb-20">
                    <div class="text-left ps-2 sm:ps-5">
                        <h2 class="my-2 font-bold text-xl sm:text-3xl text-slate-950">Rekomendasi Kursus</h2>
                        <p class="mb-5 text-gray-700">Tingkatkan kemampuan dengan kursus yang sesuai bidangmu.</p>
                    </div>
                    <!-- Grid Container -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($kursus as $k)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                            <div class="relative cursor-default">
                                <img class="w-full h-44 sm:h-36 lg:h-44 object-cover"
                                    src="{{ $k->foto_kursus ? asset('storage/' . $k->foto_kursus) : asset('image/Thumnnail.jpg') }}"
                                    alt="Thumbnail {{ $k->judul }}">
                                <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                    {{ ucfirst($k->tingkat_kesulitan) ?? 'Umum' }}
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2 cursor-default">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        {{ $k->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                    </span>
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <span class="text-gray-700 text-sm font-medium ml-1">
                                            {{ number_format($k->average_rating ?? 0, 1) }}
                                        </span>
                                        <span class="text-gray-400 text-sm ml-1">
                                            ({{ $k->rating_kursus_count ?? 0 }})
                                        </span>
                                    </div>
                                </div>

                                <div class="w-full text-left">
                                    <a href="{{ route('DetailKursus', $k->kursus_id) }}"
                                        class="lg:text-lg text-md font-bold text-gray-800 mb-1 line-clamp-2 text-left hover:text-HoverGlow active:text-ButtonBase">
                                        {{ $k->judul }}
                                    </a>
                                    <p class="text-gray-500 text-xs mb-4 line-clamp-2 text-left cursor-default">
                                        {{ Str::limit(strip_tags($k->deskripsi), 60) }}
                                    </p>
                                </div>

                                <div class="flex items-center justify-between cursor-default">
                                    <div class="flex items-center">
                                        <img class="w-8 h-8 rounded-full"
                                            src="{{ $k->foto_pengajar ? asset('storage/' . $k->foto_pengajar) : asset('image/Thumnnail.jpg') }}"
                                            alt="Instruktur">
                                        <div class="ml-2">
                                            <p class="lg:text-sm text-xs font-medium text-gray-700">{{ $k->pengguna->nama ?? 'Instruktur' }}</p>
                                            <p class="text-[6px] sm:text-[10px] lg:text-[11px] text-gray-500">Instruktur</p>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-ButtonBase font-bold text-base lg:text-lg">
                                            Rp. {{ number_format($k->harga, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="py-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Galeri Perusahaan</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($galeri as $foto)
            <div class="gallery-item group relative overflow-hidden rounded-xl shadow-md hover:shadow-lg transition duration-300 cursor-pointer">
                <img src="{{ asset('storage/' . $foto->file_path) }}" alt="Foto Perusahaan"
                    class="w-full h-64 object-cover transition duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                    <div>
                        <h3 class="text-white font-semibold text-lg">Foto Perusahaan</h3>
                        <p class="text-gray-200 text-sm mt-1">{{ $foto->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="absolute top-4 right-4 bg-white/90 rounded-full p-2 opacity-0 group-hover:opacity-100 transition duration-300">
                    <i class="fas fa-expand text-gray-800"></i>
                </div>
            </div>
            @empty
            <p class="col-span-full text-center text-gray-500">Belum ada foto perusahaan.</p>
            @endforelse
        </div>

        <div class="mt-12 flex justify-center">
            <nav class="flex items-center space-x-2">
                @if ($galeri->onFirstPage())
                <button disabled class="px-4 py-2 border border-gray-300 rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                    <i class="fas fa-chevron-left"></i>
                </button>
                @else
                <a href="{{ $galeri->previousPageUrl() }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-chevron-left"></i>
                </a>
                @endif

                @for ($i = 1; $i <= $galeri->lastPage(); $i++)
                    @if ($i == $galeri->currentPage())
                    <span class="px-4 py-2 border border-blue-600 rounded-md text-white bg-blue-600">{{ $i }}</span>
                    @else
                    <a href="{{ $galeri->url($i) }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">{{ $i }}</a>
                    @endif
                    @endfor

                    @if ($galeri->hasMorePages())
                    <a href="{{ $galeri->nextPageUrl() }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    @else
                    <button disabled class="px-4 py-2 border border-gray-300 rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    @endif
            </nav>
        </div>
        <!-- Modal -->
        <div class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center" id="imageModal">
            <div class="close-btn" id="closeModal">
                <i class="fas fa-times"></i>
            </div>
            <div class="relative max-w-4xl w-full p-4">
                <img src="" alt="" class="w-full max-h-[80vh] object-contain" id="modalImage">
                <div class="mt-4 text-white text-center">
                    <h3 class="text-xl font-semibold" id="modalTitle"></h3>
                    <p class="text-gray-300 mt-1" id="modalDate"></p>
                </div>
            </div>
        </div>
    </section>


    <section class="max-w-2xl mx-auto px-4">
        <!-- Scenario 3: Formulir inputan ulasan -->
        <section>
            <div class="py-10">
                <!-- Header -->
                <div class="md:mb-8 mb-2">
                    <h1 class="text-xl md:text-3xl font-bold text-primary mb-2">Beri Ulasan</h1>
                    <p class="text-gray-600 text-xs md:text-sm">Bagikan pengalaman Anda untuk perushaan ini</p>
                </div>

                <!-- Review Form -->
                <div class="shadow-sm">
                    <!-- Course Info -->
                    <div class="flex items-start mb-2 p-4 bg-gray-50 rounded-lg">
                        <img src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) 
                            : asset('image/Thumnnail.jpg') }}" alt="Thumbnail Kursus" class="md:w-20 md:h-20 w-10 h-10 rounded-full object-cover mr-4">
                        <div>
                            <h3 class="font-bold text-base md:text-lg">{{ $user->nama ?? '-' }}</h3>
                            <div class="mt-1 flex items-center text-amber-400">
                                @php
                                $avg = number_format($perusahaan->average_rating ?? 0, 1);
                                $count = $perusahaan->rating_perusahaan_count ?? 0;
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($perusahaan->average_rating >= $i)
                                    <i class="fas fa-star"></i>
                                    @elseif ($perusahaan->average_rating >= $i - 0.5)
                                    <i class="fas fa-star-half-alt"></i>
                                    @else
                                    <i class="far fa-star"></i>
                                    @endif
                                    @endfor

                                    <span class="text-gray-600 ml-2 text-xs md:text-sm">
                                        {{ $avg }} ({{ $count }} ulasan)
                                    </span>
                            </div>
                        </div>
                    </div>

                    @if(!$hasReviewed)
                    <form action="{{ route('ratingPerusahaan.store', $perusahaan->perusahaan_id) }}" method="POST">
                        @csrf
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
                            <p class="text-right text-xs md:text-sm text-gray-500 mt-1">
                                <span id="char-count">0</span>/500 karakter
                            </p>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full text-xs md:text-sm py-3 bg-primary hover:bg-primary/90 text-white bg-ButtonBase font-medium rounded-lg transition duration-200">
                            Kirim Ulasan
                        </button>
                    </form>
                    @else
                    <div class="text-green-600 font-semibold text-center mt-4">
                        Anda sudah memberikan ulasan untuk perusahaan ini. Terima kasih! 🙏
                    </div>
                    @endif
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
        </section>
    </section>

    <section class="pb-10">
        <div class="mb-4 text-sm text-gray-600">
            Menampilkan {{ $ratingPerusahaan->count() }} ulasan dari total {{ $perusahaan->rating_perusahaan_count }} ulasan
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse ($ratingPerusahaan as $r)
            <div class="bg-gray-50 md:p-4 p-2 rounded-lg text-xs md:text-sm text-center">
                <div class="flex flex-col items-center text-amber-400 mb-2">
                    <div class="flex space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($r->rating >= $i)
                            <i class="fas fa-star"></i>
                            @elseif ($r->rating >= $i - 0.5)
                            <i class="fas fa-star-half-alt"></i>
                            @else
                            <i class="far fa-star"></i>
                            @endif
                            @endfor
                    </div>
                    <span class="text-gray-700 mt-1">{{ number_format($r->rating, 1) }}/5</span>
                </div>
                <p class="font-medium italic">"{{ $r->komentar }}"</p>
                <p class="text-sm text-gray-500 mt-1">
                    Ulasan dari {{ $r->pemberi->nama ?? 'Anonim' }} pada {{ $r->created_at->format('d M Y') }}
                </p>
            </div>
            @empty
            <div class="col-span-4 text-center text-gray-500">Belum ada ulasan untuk perusahaan ini.</div>
            @endforelse
        </div>
    </section>


</main>

<script>
    // Script untuk modal galeri
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDate = document.getElementById('modalDate');
    const closeModal = document.getElementById('closeModal');

    // Buka modal saat gambar diklik
    document.querySelectorAll('.gallery-item').forEach(item => {
        item.addEventListener('click', function() {
            const imgSrc = this.querySelector('img').src;
            const title = this.querySelector('h3').textContent;
            const date = this.querySelector('p').textContent;

            modalImage.src = imgSrc;
            modalTitle.textContent = title;
            modalDate.textContent = date;
            imageModal.classList.remove('hidden');
            imageModal.classList.add('flex');
            document.body.style.overflow = 'hidden'; // Mencegah scrolling latar belakang
        });
    });

    // Tutup modal saat tombol X diklik
    closeModal.addEventListener('click', function() {
        closeGalleryModal();
    });

    // Tutup modal saat mengklik di luar gambar
    imageModal.addEventListener('click', function(e) {
        if (e.target === imageModal) {
            closeGalleryModal();
        }
    });

    // Tutup modal dengan tombol ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !imageModal.classList.contains('hidden')) {
            closeGalleryModal();
        }
    });

    // Fungsi untuk menutup modal
    function closeGalleryModal() {
        imageModal.classList.remove('flex');
        imageModal.classList.add('hidden');
        document.body.style.overflow = 'auto'; // Mengembalikan scrolling
    }

    // Dynamic Star Rating
    const ratingContainer = document.getElementById('rating-stars');
    const ratingInput = document.getElementById('rating-value');

    for (let i = 1; i <= 5; i++) {
        const star = document.createElement('div');
        star.className = 'text-3xl cursor-pointer text-gray-300 hover:text-amber-400';
        star.innerHTML = `<i class="far fa-star" data-value="${i}"></i>`;
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
@endsection