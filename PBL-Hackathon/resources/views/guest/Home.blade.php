@extends('layouts.main')

@section('Main')

<!-- Javascript home -->
@vite(['resources/js/home.js'])

<div class="relative w-full">
    <img class="h-auto w-full max-h-[700px] object-cover" src="{{ asset('image/12.webp') }}" alt="Background Main">
    <div class="absolute left-4 sm:left-16 top-36 sm:top-1/2 transform -translate-y-1/2 text-white p-2 rounded w-1/2">
        <h2 class=" text-xl sm:text-4xl lg:text-5xl font-bold whitespace-normal">
            Membentuk Keterampilan, Menggerakkan Industri!
        </h2>
        @guest
        <a href="/Daftar" class="mt-4 sm:mt-10 text-sm sm:text-base inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            Daftar Sekarang
        </a>
        @endguest
    </div>
</div>

<section>
    <!-- Row 1: Satu kolom -->
    <div class="sm:my-5 my-3">
        <div class="bg-gwhite text-center p-6">
            <button type="button" class="px-5 py-2.5 text-sm sm:text-lg font-medium text-white bg-CalmBlue rounded-lg">Temukan Apa yang Kami Sediakan</button>
            <div class="px-2">
                <h2 class="mt-5 mb-2 font-bold text-xl sm:text-3xl text-slate-950">Platform Lengkap untuk Penguasaan Pengelasan dan Fabrikasi</h2>
                <p class="text-xs sm:text-sm sm:px-5 text-slate-800 text-justify sm:text-center">
                    Bergabunglah dengan platform utama kami yang menghubungkan Anda dengan mentor berperingkat teratas di bidang pengelasan dan fabrikasi. Lacak kemajuan Anda secara real-time dan terima wawasan yang dipersonalisasi yang disesuaikan dengan kebutuhan pembelajaran Anda. Dengan teknologi AI yang canggih, platform kami menawarkan rekomendasi khusus untuk membantu Anda mempertajam keterampilan Anda secara efektif. Baik Anda seorang pemula atau ingin meningkatkan keahlian Anda, Anda akan mendapatkan manfaat dari pelatihan terstruktur dan umpan balik yang berharga untuk unggul dalam industri fabrikasi. Semua ini dapat diakses dalam satu platform ramah pengguna yang dirancang untuk kesuksesan Anda.
                </p>
            </div>
        </div>
    </div>

    <!-- Row 2: Empat kolom -->
    <div class="sm:grid sm:grid-cols-4 sm:px-4">
        <!-- Peningkatan Keterampilan -->
        <div class="bg-white text-center px-8 py-6 sm:p-3 lg:p-6">
            <div class="relative inline-flex mb-3 items-center justify-center w-12 h-12 bg-CalmBlue rounded-lg cursor-pointer">
                <i class="fas fa-envelope text-white text-2xl"></i>
            </div>
            <h3 class=" text-xl lg:text-2xl py-2 sm:h-20 font-semibold text-slate-950">Peningkatan Keterampilan</h3>
            <p class="text-xs sm:text-sm text-slate-800">Buka potensi Anda dengan pembelajaran langsung dan bimbingan ahli untuk terus meningkatkan keahlian Anda</p>
        </div>

        <!-- Melacak Kemajuan -->
        <div class="bg-white text-center px-8 py-6 sm:p-3 lg:p-6">
            <div class=" relative inline-flex mb-3 items-center justify-center w-12 h-12 bg-CalmBlue rounded-lg cursor-pointer">
                <i class="fa-solid fa-chart-line text-white text-2xl"></i>
            </div>
            <h3 class="text-xl lg:text-2xl py-2 sm:h-20 font-semibold text-slate-950">Melacak Kemajuan Anda</h3>
            <p class="text-xs sm:text-sm text-slate-800">Pantau pencapaian Anda secara real-time dengan alat intuitif kami yang membantu Anda tetap mencapai tujuan Anda</p>
        </div>

        <!-- Mentor dengan nilai tertinggi -->
        <div class="bg-white text-center px-8 py-6 sm:p-3 lg:p-6">
            <div class=" relative inline-flex mb-3 items-center justify-center w-12 h-12 bg-CalmBlue rounded-lg cursor-pointer">
                <i class="fa-solid fa-user-tie text-white text-2xl"></i>
            </div>
            <h3 class="text-xl lg:text-2xl py-2 sm:h-20 font-semibold text-slate-950">Mentor dengan Nilai Tertinggi</h3>
            <p class="text-xs sm:text-sm text-slate-800">Belajar dari yang terbaik di bidangnya, dengan akses ke mentor yang dinilai tinggi oleh siswa atas keahlian dan pengajaran mereka</p>
        </div>

        <!-- Mentor dengan nilai tertinggi -->
        <div class="bg-white text-center px-8 py-6 sm:p-3 lg:p-6">
            <div class=" relative inline-flex mb-3 items-center justify-center w-12 h-12 bg-CalmBlue rounded-lg cursor-pointer">
                <i class="fa-solid fa-braille text-white text-2xl"></i>
            </div>
            <h3 class="text-xl lg:text-2xl pt-2 sm:h-20 font-semibold text-slate-950">Saran saya</h3>
            <p class="text-xs sm:text-sm text-slate-800">Dapatkan rekomendasi yang dipersonalisasi dan didukung oleh AI untuk mengoptimalkan perjalanan pembelajaran Anda dan meningkatkan kinerja</p>
        </div>
    </div>
</section>

<section class="sm:mt-10 bg-slate-100">
    <div class="text-center mb-8 px-8">
        <h2 class="text-2xl sm:text-3xl font-bold mb-1 sm:mb-3 pt-10 text-slate-950">Belajar dari Pakar Nilai Tertinggi</h2>
        <p class="text-sm sm:text-base text-slate-800">Dapatkan pengalaman langsung dan wawasan industri dari mentor yang dipercaya dan dinilai tinggi oleh pelajar seperti Anda.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 pb-10">
        @foreach ($dataPelatih as $pelatih)
        <div class="w-64 h-96 p-2">
            <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 h-full">
                <div class="flex justify-center py-5 bg-slate-400">
                    <img class="h-28 w-28 rounded-full object-cover"
                        src="{{ $pelatih->foto_profil ? asset('storage/foto_profil/' . $pelatih->foto_profil) : asset('image/9203764.png') }}"
                        alt="{{ $pelatih->nama }}" />
                </div>
                <div class="px-4 py-4">
                    <div>
                        <h3 class="text-lg text-center sm:text-xl font-semibold tracking-tight text-gray-900 dark:text-white mb-3">
                            {{ $pelatih->nama }}
                        </h3>
                        <div class="flex justify-center mb-2">
                            <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <!--! Font Awesome Free 6.7.1 by @fontawesome -->
                                <path fill="#FFD43B" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                            </svg>
                            <p class="text-center text-sm font-semibold text-TeksSecond mb-3">
                                {{ number_format($pelatih->ratings_pelatih_avg_rating, 2) ?? 'Belum ada rating' }}
                            </p>
                        </div>
                        <p class="text-center text-sm max-h-16 overflow-hidden text-TeksSecond">
                            {{ $pelatih->alamat ?? 'Alamat tidak tersedia' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</section>

<section>
    <div class="sm:my-10 my-5 px-6 text-center">
        <h2 class=" text-2xl sm:text-3xl text-slate-950 sm:pb-2 font-bold">Pimpin Jalan sebagai Mentor</h2>
        <p class="text-sm sm:text-base text-slate-800 sm:px-5">Membantu membentuk masa depan dengan membimbing calon pelajar. Jadilah mentor, bagikan pengetahuan Anda, dan berikan inspirasi kepada generasi profesional terampil berikutnya.</p>
    </div>

    <div class="container mx-auto p-4"> <!-- Container untuk menampung semua konten -->
        <div class="flex justify-center"> <!-- Menyelaraskan konten ke tengah -->
            <div class="w-full h-96 p-2"> <!-- Card dengan lebar penuh dan tinggi 96 -->
                <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 h-full overflow-hidden"> <!-- Menambahkan overflow-hidden untuk memastikan rounding bekerja -->
                    <div class="relative h-full"> <!-- Menjaga tinggi tetap dan menempatkan gambar di dalam -->
                        <img class="w-full h-full object-cover rounded-t-lg" src="{{ asset('image/I.webp') }}" alt="product image" />
                        <div class="absolute inset-0 bg-black opacity-30 rounded-t-lg"></div> <!-- Overlay hitam transparan -->
                        <div class="absolute left-8 sm:left-24 bottom-1/2 transform translate-y-1/2"> <!-- Mengatur posisi tombol dan teks di kiri tengah -->
                            <h2 class="text-white text-3xl font-bold mb-5">Menjadi Mentor</h2> <!-- Teks di atas tombol dengan warna putih -->
                            <a href="#" class="bg-CalmBlue rounded-lg lg:text-lg text-white font-medium text-center px-4 py-2.5">Mulailah kursus hari ini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="sm:mx-12 mx-3 sm:mt-10 bg-[#F8FAFC]">
    <div class="container sm:flex justify-between mb-5">
        <div class="text-2xl sm:text-3xl px-5 sm:px-8 font-bold lg:w-1/3 sm:w-1/2 mt-10">
            <h2>Apa Kata Pelanggan Kami Tentang Kami</h2>
        </div>
    </div>

    <div class="pb-10">
        <div class="flex flex-wrap justify-center gap-3 h-auto">
            @foreach ($data as $umpan_balik)
            <div class="article-container">
                <article class=" w-80 min-h-72 px-10 py-5 mb-2 bg-slate-50 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <img class="w-10 h-10 me-4 rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium dark:text-white">
                            <h4 class="h-5 overflow-hidden">{{ $umpan_balik->nama_komentar }}</h4>
                            <p>
                                <time datetime="{{ $umpan_balik->created_at->timezone('Asia/Jakarta')->format('Y-m-d H:i:s') }}" class="block text-sm text-gray-500 dark:text-gray-400">
                                    {{ $umpan_balik->created_at->timezone('Asia/Jakarta')->format('d F Y, H:i') }}
                                </time>
                            </p>


                        </div>
                    </div>
                    <div class="relative">
                        <p class="text-content mb-3 mt-3 text-gray-500 dark:text-gray-400 text-sm sm:text-base text-justify ">
                            {{ $umpan_balik->komentar }}
                        </p>
                        <button class="toggle-text text-blue-500 dark:text-blue-400 text-sm font-medium hover:underline focus:outline-none">
                            Selengkapnya
                        </button>
                    </div>
                </article>
            </div>
            @endforeach
        </div>

        <!-- Menampilkan pagination -->
        <div class="flex flex-col items-center">
            <!-- Help text -->
            <span class="text-sm text-gray-700 dark:text-gray-400">
                Showing
                <span class="font-semibold text-gray-900 dark:text-white">{{ $data->firstItem() }}</span>
                to
                <span class="font-semibold text-gray-900 dark:text-white">{{ $data->lastItem() }}</span>
                of
                <span class="font-semibold text-gray-900 dark:text-white">{{ $data->total() }}</span>
                Entries
            </span>

            <!-- Manual navigation (Optional) -->
            <div class="inline-flex mt-2 xs:mt-0">
                <!-- Prev Button -->
                @if ($data->onFirstPage())
                <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-500 cursor-not-allowed rounded-s">
                    <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                    Prev
                </button>
                @else
                <a href="{{ $data->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900">
                    <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                    Prev
                </a>
                @endif

                <!-- Next Button -->
                @if ($data->hasMorePages())
                <a href="{{ $data->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-e hover:bg-gray-900">
                    Next
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
                @else
                <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-500 cursor-not-allowed rounded-e">
                    Next
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </button>
                @endif
            </div>
        </div>
    </div>

    @endsection