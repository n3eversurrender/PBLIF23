@extends('layouts.main')

@vite(['resources/js/home.js'])
@section('Main')
@vite(['resources/css/app.css','resources/js/app.js'])
@vite(['resources/js/Waktu.js'])
<!-- Quill CSS -->
<!-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script> -->


<!-- Javascript home -->
@if (session('success'))
<script>
    // {{ session('success') }}
    document.addEventListener('DOMContentLoaded', (event) => {
        Swal.fire({
            icon: 'success',
            title: "{{ session('success') }}",
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'my-swal-button'
            }
        });
    });
</script>
@endif

@if (session('error'))
<script>
    // {{ session('error') }}
    document.addEventListener('DOMContentLoaded', (event) => {
        Swal.fire({
            icon: 'error',
            title: "{{ session('error') }}",
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'my-swal-button'
            }
        });
    });
</script>
@endif


<main class="bg-gray-100">
    <section class="mt-14 mb-15 px-6 lg:px-16">
        <div class="pt-10">
            <h1 class=" text-3xl font-bold">
                Selamat Datang, <span class="font-semibold text-gray-700 text-2xl">{{ Auth::user()->nama }}</span>👋
            </h1>
            <p id="datetime" class="sm:text-sm ps-4 text-xs font-normal text-TeksSecond pt-5  sm:pt-3 lg:py-1"></p>
        </div>
    </section>
    <!-- Rekomendasi kursus -->
    <section class="p-3 sm:px-10 lg:px-16 bg-gray-100">
        <div class="sm:mb-0 my-3">
            <div class="bg-gwhite text-center py-4">
                <div class="px-3 sm:px-10 pt-5 pb-20 rounded-lg shadow-lg bg-white">
                    <div class="text-left ps-2 sm:ps-5">
                        <h2 class="my-2 font-bold text-xl sm:text-3xl text-slate-950">Rekomendasi Kursus</h2>
                        <p class="mb-5 text-gray-700">Tingkatkan kemampuan dengan kursus yang sesuai bidangmu.</p>
                    </div>
                    <!-- Grid Container -->
                    @if($skills->isEmpty())
                    <div class="text-center text-gray-600 py-10">
                        <p class="text-lg font-semibold">Belum ada rekomendasi 😔</p>
                        <p class="text-sm mt-2">Silakan lengkapi form pengalaman di profil untuk mendapatkan rekomendasi kursus!</p>
                    </div>
                    @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($skills as $item)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                            <!-- Course Image -->
                            <div class="relative cursor-default">
                                <img class="w-full h-44 sm:h-36 lg:h-44 object-cover" src="{{ asset('storage/' . $item->kursus->foto_kursus) }}" alt="{{ $item->kursus->judul }}">
                                <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                    {{ $item->kursus->tingkat_kesulitan }}
                                </div>
                            </div>

                            <!-- Course Content -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2 cursor-default">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $item->kursus->kategori->nama_kategori }}</span>
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <span class="text-gray-700 text-sm font-medium ml-1">{{ $item->kursus->rating }}</span>
                                        <span class="text-gray-400 text-sm ml-1">(128)</span>
                                    </div>
                                </div>

                                <div class="w-full text-left">
                                    <a href="#" class="lg:text-lg text-md font-bold text-gray-800 mb-1 line-clamp-2 text-left hover:text-HoverGlow active:text-ButtonBase">
                                        {{ $item->kursus->judul }}
                                    </a>
                                    <p class="text-gray-500 text-xs mb-4 line-clamp-2 text-left cursor-default">
                                        {{ $item->kursus->deskripsi }}
                                    </p>
                                </div>

                                <div class="flex items-center justify-between cursor-default">
                                    <div class="flex items-center">
                                        <img class="w-8 h-8 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Instructor">
                                        <div class="ml-2">
                                            <p class="lg:text-sm text-xs font-medium text-gray-700">Sarah Johnson</p>
                                            <p class="text-xs text-gray-500">Senior Developer</p>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-ButtonBase font-bold text-base lg:text-lg">Rp. {{ number_format($item->kursus->harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kursus Terpopuler -->
    <section class="py-3 px-8 pb-20 bg-gray-100">
        <div class="sm:mb-0 my-3">
            <div class="bg-gwhite text-center py-4">
                <div class="p-4">
                    <h2 class="my-2 font-bold text-xl sm:text-3xl text-slate-950">Kursus Terpopuler</h2>
                    <p class="mb-5 text-gray-700">Inilah kursus favorit dengan rating tinggi dan peminat terbanyak</p>
                    <!-- Grid Container -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($kursus->take(4) as $item)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                            <!-- Course Image -->
                            <div class="relative cursor-default">
                                <img class="w-full h-36 object-cover" src="{{ asset('storage/' . $item->foto_kursus) }}" alt="{{ $item->judul }}">

                                <div class="absolute top-3 left-3 text-white text-xs font-semibold px-2 py-1 rounded-full
                                @if($item->tingkat_kesulitan == 'Pemula') bg-green-500
                                @elseif($item->tingkat_kesulitan == 'Menengah') bg-yellow-500
                                @elseif($item->tingkat_kesulitan == 'Lanjutan') bg-red-500
                                @else bg-gray-400
                                @endif">
                                    {{ $item->tingkat_kesulitan ?? 'Umum' }}
                                </div>
                            </div>

                            <!-- Course Content -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2 cursor-default">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        {{ $item->kategori->nama_kategori ?? 'Kategori' }}
                                    </span>
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <span class="text-gray-700 text-xs font-medium ml-1">
                                            {{ number_format($item->average_rating, 1) ?? '0.0' }}
                                        </span>
                                        <span class="text-gray-400 text-xs ml-1">
                                            ({{ $item->ratingKursus->count() }})
                                        </span>
                                    </div>
                                </div>

                                <div class="w-full text-left">
                                    <a href="/CoursePage/{{ $item->kursus_id }}" class="hover:text-HoverGlow active:text-ButtonBase text-sm sm:text-md font-bold text-gray-800 mb-1 line-clamp-2 text-left">
                                        {{ $item->judul }}
                                    </a>
                                    <p class="cursor-default text-gray-500 text-xs mb-4 line-clamp-2 text-left">
                                        {{ Str::limit($item->deskripsi, 80) }}
                                    </p>
                                </div>

                                <div class="flex items-center justify-between cursor-default">
                                    <div class="flex items-center">
                                        <img class="w-8 h-8 rounded-full"
                                            src="{{ $item->pengajar->foto ?? 'https://randomuser.me/api/portraits/women/44.jpg' }}"
                                            alt="Instructor">
                                        <div class="ml-2">
                                            <p class="text-xs font-medium text-gray-700">
                                                {{ $item->pengajar->nama ?? 'Instruktur' }}
                                            </p>
                                            <p class="text-[11px] text-gray-500">
                                                {{ $item->pengajar->jabatan ?? 'Pengajar' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-ButtonBase font-bold text-sm">
                                            Rp. {{ number_format($item->harga, 0, ',', '.') }}
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
        </div>
    </section>


    <!-- Umpan Balik -->
    <section class="bg-cover mb-20 px-8"
        style="background-image: url('https://alroys.com/wp-content/uploads/2023/02/Shutterstock_1822872494-scaled.jpg')">>
        <div class="lg:w-2/5 lg:mx-6 py-4">
            <div
                class="w-full p-6 mx-auto overflow-hidden bg-white shadow-2xl rounded-xl dark:bg-gray-900 lg:max-w-xl">
                <h1 class="cursor-default text-base lg:text-lg font-medium text-gray-700 dark:text-gray-200">Umpan Balik</h1>
                <p class="cursor-default mt-2 text-xs lg:text-sm text-gray-500 dark:text-gray-400">
                    Kami sangat menghargai masukan Anda! Jika Anda memiliki waktu, kami akan sangat berterima kasih jika Anda dapat memberikan ulasan tentang pengalaman Anda menggunakan aplikasi ini. Ulasan Anda akan membantu kami untuk terus meningkatkan kualitas aplikasi.
                </p>
                <form method="POST" action="{{ route('umpan_balik.store') }}" class="mt-6 text-sm sm:text-base">
                    @csrf
                    <div class="flex-1">
                        <label for="nama_komentar" class="block  text-sm text-gray-600 dark:text-gray-200">Nama</label>
                        <input id="nama_komentar" name="nama_komentar" type="text" placeholder="John Doe"
                            class="block w-full px-5 py-3 mt-2 text-sm placeholder:text-sm text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" />
                        @error('nama_komentar')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex-1 mt-6">
                        <label for="komentar" class="block mt-2 text-sm text-gray-600 dark:text-gray-200">Komentar</label>
                        <textarea id="komentar" name="komentar" placeholder="Ulasan kamu..."
                            class="block w-full px-5 py-3 mt-2 text-gray-700 text-sm placeholder:text-sm bg-white border border-gray-200 rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"></textarea>
                        @error('komentar')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full px-6 py-3 mt-8 text-sm font-semibold tracking-wide text-white capitalize transition-colors duration-700 transform bg-[#2563EB] rounded-md hover:bg-[#161D6F] focus:outline-none focus:ring focus:ring-blue-400 focus:ring-opacity-50">
                        Kirim
                    </button>
                </form>
            </div>
        </div>
    </section>
</main>


@endsection