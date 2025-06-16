@extends('layouts.main')

@section('Main')

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- Javascript home -->
@vite(['resources/js/home.js'])

<!-- <div class="relative w-full cursor-default">
    <img class="w-full lg:h-screen max-h-[700px] object-cover brightness-50" src="{{ asset('image/12.webp') }}" alt="Background Main">
    <div class="absolute left-4 sm:left-16 top-36 sm:top-1/2 transform -translate-y-1/2 text-white p-2 rounded w-1/2">
        <h2 class=" text-xl sm:text-4xl lg:text-5xl font-bold whitespace-normal">
            Membentuk Keterampilan, Menggerakkan Industri!
        </h2>
        <p class="mt-5 text-lg">Tingkatkan keterampilan Anda dengan program kursus berkualitas tinggi yang dirancang khusus untuk kebutuhan masyarakat Batam.</p>
        <p class="bg-ButtonBase text-white py-3 ps-10 rounded-full font-semibold text-lg shadow-lg mt-5 w-1/2">
            Mulai Belajar Sekarang
        </p>
    </div>
</div> -->

<div
    x-data="{
  slide: 1,
  total: 2,
  init() {
    setInterval(() => {
      this.slide = this.slide === this.total ? 1 : this.slide + 1;
    }, 10000); // 10000 ms = 10 detik
  }
}"
    x-init="init()"
    class="relative w-full overflow-hidden min-h-screen">
    <!-- SLIDES CONTAINER -->
    <div
        class="flex transition-transform duration-700 ease-in-out"
        :style="'transform: translateX(-' + (slide - 1) * 100 + '%)'">
        <!-- Slide 1 -->
        <div class="w-full flex-shrink-0 relative min-h-screen">
            <img
                class="w-full h-full lg:h-screen max-h-[700px] object-cover object-center brightness-50"
                src="{{ asset('image/12.webp') }}"
                alt="Background Main" />
            <div
                class="absolute left-4 sm:left-16 top-36 sm:top-1/2 transform -translate-y-1/2 text-white p-2 rounded w-11/12 sm:w-1/2 z-10">
                <h2 class="text-xl sm:text-4xl lg:text-5xl font-bold whitespace-normal">
                    Membentuk Keterampilan, Menggerakkan Industri!
                </h2>
                <p class="mt-5 text-lg">
                    Tingkatkan keterampilan Anda dengan program kursus berkualitas tinggi yang dirancang khusus untuk kebutuhan masyarakat Batam.
                </p>
                <p
                    class="bg-ButtonBase text-white py-3 px-6 rounded-full font-semibold text-lg shadow-lg mt-5 inline-block">
                    Mulai Belajar Sekarang
                </p>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="w-full flex-shrink-0 relative min-h-screen">
            <img
                class="w-full h-full lg:h-screen max-h-[700px] object-cover object-center brightness-50"
                src="{{ asset('image/12.webp') }}"
                alt="Slide 2 Background" />
            <div
                class="absolute left-4 sm:left-16 top-36 sm:top-1/2 transform -translate-y-1/2 text-white p-2 rounded w-11/12 sm:w-1/2 z-10">
                <h2 class="text-xl sm:text-4xl lg:text-5xl font-bold whitespace-normal">
                    Daftarkan Perusahaan Anda Sekarang
                </h2>
                <p class="mt-5 text-lg">
                    Bantu kembangkan industri Batam dengan bergabung sebagai mitra pelatihan kami.
                </p>
                <a
                    href="https://forms.gle/MBhRLnamd2QiWCkw5"
                    target="_blank"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold text-lg py-3 px-6 rounded-full mt-5 shadow-lg">
                    Isi Formulir Pendaftaran
                </a>
            </div>
        </div>
    </div>

    <!-- SLIDE INDICATORS -->
    <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-3 z-20">
        <button
            @click="slide = 1"
            :class="slide === 1 ? 'bg-white' : 'bg-gray-400'"
            class="w-4 h-4 rounded-full transition-colors duration-300"></button>
        <button
            @click="slide = 2"
            :class="slide === 2 ? 'bg-white' : 'bg-gray-400'"
            class="w-4 h-4 rounded-full transition-colors duration-300"></button>
    </div>
</div>


<section class=" cursor-default">
    <!-- Row 1: Satu kolom -->
    <div class="sm:my-5 my-3">
        <div class="bg-gwhite text-center p-6">
            <button type="button" class=" cursor-default px-5 py-2.5 text-sm sm:text-lg font-medium text-white bg-CalmBlue rounded-lg">Temukan Apa yang Kami Sediakan</button>
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
        <div class="bg-white hover:bg-gray-100 rounded-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 text-center px-8 py-6 sm:p-3 lg:p-6">
            <div class="relative inline-flex mb-3 items-center justify-center w-12 h-12 bg-CalmBlue rounded-lg cursor-pointer">
                <i class="fas fa-envelope text-white text-2xl"></i>
            </div>
            <h3 class=" text-xl lg:text-2xl py-2 sm:h-20 font-semibold text-slate-950">Peningkatan Keterampilan</h3>
            <p class="text-xs sm:text-sm text-slate-800">Buka potensi Anda dengan pembelajaran langsung dan bimbingan ahli untuk terus meningkatkan keahlian Anda</p>
        </div>

        <!-- Melacak Kemajuan -->
        <div class="bg-white hover:bg-gray-100 rounded-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 text-center px-8 py-6 sm:p-3 lg:p-6">
            <div class=" relative inline-flex mb-3 items-center justify-center w-12 h-12 bg-CalmBlue rounded-lg cursor-pointer">
                <i class="fa-solid fa-chart-line text-white text-2xl"></i>
            </div>
            <h3 class="text-xl lg:text-2xl py-2 sm:h-20 font-semibold text-slate-950">Pencocokan Keterampilan</h3>
            <p class="text-xs sm:text-sm text-slate-800">Dapatkan rekomendasi kursus didukung oleh AI yang sesuai dengan kriteria dan keahlian anda untuk mengoptimalkan perjalanan pembelajaran Anda dan meningkatkan kinerja</p>
        </div>

        <!-- Mentor dengan nilai tertinggi -->
        <div class="bg-white hover:bg-gray-100 rounded-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 text-center px-8 py-6 sm:p-3 lg:p-6">
            <div class=" relative inline-flex mb-3 items-center justify-center w-12 h-12 bg-CalmBlue rounded-lg cursor-pointer">
                <i class="fa-solid fa-user-tie text-white text-2xl"></i>
            </div>
            <h3 class="text-xl lg:text-2xl py-2 sm:h-20 font-semibold text-slate-950">Mentor dengan Nilai Tertinggi</h3>
            <p class="text-xs sm:text-sm text-slate-800">Belajar dari yang terbaik di bidangnya, dengan akses ke mentor yang dinilai tinggi oleh siswa atas keahlian dan pengajaran mereka</p>
        </div>

        <!-- Mentor dengan nilai tertinggi -->
        <div class="bg-white hover:bg-gray-100 rounded-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 text-center px-8 py-6 sm:p-3 lg:p-6">
            <div class=" relative inline-flex mb-3 items-center justify-center w-12 h-12 bg-CalmBlue rounded-lg cursor-pointer">
                <i class="fa-solid fa-braille text-white text-2xl"></i>
            </div>
            <h3 class="text-xl lg:text-2xl pt-2 sm:h-20 font-semibold text-slate-950">Saran saya</h3>
            <p class="text-xs sm:text-sm text-slate-800">Dapatkan rekomendasi yang dipersonalisasi dan didukung oleh AI untuk mengoptimalkan perjalanan pembelajaran Anda dan meningkatkan kinerja</p>
        </div>
    </div>
</section>

<!-- Kursus Terpopuler -->
<section class="py-10 px-8">
    <div class="sm:mb-0 my-3">
        <div class="bg-gwhite text-center py-4">
            <div class="p-4">
                <h2 class="my-2 font-bold text-xl sm:text-3xl text-slate-950 cursor-default">Kursus Terpopuler</h2>
                <p class="mb-5 text-gray-700 cursor-default">Inilah kursus favorit dengan rating tinggi dan peminat terbanyak</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($kursus as $k)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                        <div class="relative cursor-default">
                            <img class="w-full h-36 object-cover"
                                src="{{ $k->foto_kursus && file_exists(public_path('storage/' . $k->foto_kursus)) 
                                    ? asset('storage/' . $k->foto_kursus) 
                                    : asset('image/Thumnnail.jpg') }}"
                                alt="Course thumbnail">

                            <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                {{ $k->tingkat_kesulitan }}
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2 cursor-default">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                    {{ $k->kategori->nama_kategori ?? 'Kategori' }}
                                </span>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                                    <span class="text-gray-700 text-xs font-medium ml-1">
                                        {{ number_format($k->rating_kursus_avg_rating ?? 0, 1) }}
                                    </span>
                                </div>
                            </div>

                            <div class="w-full text-left">
                                <a href="#"
                                    class="hover:text-HoverGlow active:text-ButtonBase text-md font-bold text-gray-800 mb-1 line-clamp-2 text-left">
                                    {{ $k->judul }}
                                </a>
                                <p class="cursor-default text-gray-500 text-xs mb-4 line-clamp-2 text-left">
                                    {{ Str::limit($k->deskripsi, 50) }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between cursor-default">
                                <div class="flex items-center">
                                    <img class="w-8 h-8 rounded-full"
                                        src="{{ $k->pengguna && $k->pengguna->foto_profil && file_exists(public_path('storage/' . $k->pengguna->foto_profil)) 
                                                ? asset('storage/' . $k->pengguna->foto_profil) 
                                                : asset('image/Thumnnail.jpg') }}"
                                        alt="Instructor">

                                    <div class="ml-2">
                                        <p class="text-xs font-medium text-gray-700">{{ $k->pengguna->nama ?? '-' }}</p>
                                        <p class="text-[11px] text-gray-500">Instruktur</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-ButtonBase font-bold text-sm">Rp. {{ number_format($k->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($kursus->isEmpty())
                <p class="text-gray-500 mt-4">Belum ada kursus terpopuler.</p>
                @endif
            </div>
        </div>
    </div>
</section>




<!-- Pimpin jalan sebagai mentor -->
<section>
    <div class="sm:mt-10 mt-5 px-6 text-center cursor-default">
        <h2 class=" text-2xl sm:text-3xl text-slate-950 sm:pb-2 font-bold">Daftarkan Perusahaan Anda</h2>
        <p class="text-sm sm:text-base text-slate-800 sm:px-5">"Daftarkan perusahaan Anda dan hadirkan kursus-kursus berkualitas bersama mentor terbaik. Bersama, kita ciptakan masa depan yang lebih terampil dan profesional.</p>
    </div>

    <div class="container mx-auto p-4">
        <div class="flex justify-center">
            <div class="w-full h-96 p-2">
                <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 h-full overflow-hidden">
                    <div class="relative h-full">
                        <img class="w-full h-full object-cover rounded-t-lg" src="{{ asset('image/I.webp') }}" alt="product image" />
                        <div class="absolute inset-0 bg-black opacity-30 rounded-t-lg"></div>
                        <div class="absolute left-8 sm:left-24 bottom-1/2 transform translate-y-1/2">
                            <h2 class="text-white text-3xl font-bold mb-5 cursor-default">Daftar Perusahaan</h2>
                            <a href="https://forms.gle/MBhRLnamd2QiWCkw5" target="_blank" class="bg-CalmBlue transition duration-700 hover:bg-HoverGlow rounded-lg lg:text-base text-white font-medium text-center px-4 py-2.5">Daftarkan perusahaan Anda sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection