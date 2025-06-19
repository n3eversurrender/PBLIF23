@extends('layouts.main')

@section('Main')

<!-- search start -->
<div class="flex justify-end mt-24 mx-10">
    <form class="w-full max-w-lg">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-full px-4 py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari" required />
        </div>
    </form>
</div>

<!-- Perusahaan -->
<div class="mt-10 mx-10">
    <h1 class="text-2xl font-bold">Perusahaan Penyedia Jasa</h1>
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 mt-8 mx-4 justify-items-center text-center">
        @foreach($perusahaan as $p)
        <a href="/detailProfil/{{ $p->pengguna_id }}" class="mt-2 hover:opacity-75 transition duration-500">
            <div class="flex flex-col items-center">
                <img src="{{ $p->foto_profil ? asset('storage/' . $p->foto_profil) : asset('image/thumnnail.jpg') }}"
                    alt="Foto {{ $p->nama }}" class="h-20 w-20 rounded-full" />
                <span class="font-semibold mt-2">{{ $p->nama }}</span>
            </div>
        </a>
        @endforeach
    </div>



    <div class="flex flex-col items-center mt-5">
        <div class="inline-flex mt-2 xs:mt-0">
            <!-- Buttons -->
            <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
                Prev
            </button>
            <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Next
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </button>
        </div>
    </div>
</div>

<section class="flex mx-4 sm:mx-12 mt-16">
    <aside class="h-auto min-h-screen">
        <div class="h-full py-4 w-32 sm:w-48 lg:w-64 bg-white">
            <h3 class=" font-bold text-sm sm:text-2xl mb-4 sm:py-2">Semua Kursus</h3>
            <ul class="space-y-2  font-medium">
                <!-- Kategori-->
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-xs sm:text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-category" data-collapse-toggle="dropdown-category">
                        <h3 class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Kategori</h3>
                        <svg class="w-2 h-2 sm:w-3 sm:h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
                        </svg>
                    </button>
                    <hr>
                    <form method="GET" action="{{ route('daftarKursus') }}" id="kursusForm">
                        <ul id="dropdown-category" class="hidden px-4 space-y-2">
                            <li>
                                <div class="flex items-center w-full sm:p-2 py-1 pr-4 text-gray-900 transition duration-75 rounded-lg group">
                                    <input id="default-radio-1" type="radio" value="" name="kategori_id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" onchange="this.form.submit()">
                                    <label for="default-radio-1" class="ms-2 text-xs sm:text-sm font-medium text-gray-900 dark:text-gray-300">Semua Kursus</label>
                                </div>
                            </li>
                            <!-- Loop untuk menampilkan kategori dari database -->
                            @foreach($kategori as $kat)
                            <li>
                                <div class="flex items-center w-full sm:p-2 py-1 pr-4 text-gray-900 transition duration-75 rounded-lg group">
                                    <input id="kategori-radio-{{ $kat->kategori_id }}" type="radio" value="{{ $kat->kategori_id }}" name="kategori_id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" onchange="this.form.submit()">
                                    <label for="kategori-radio-{{ $kat->kategori_id }}" class="ms-2 text-xs sm:text-sm font-medium text-gray-900 dark:text-gray-300">{{ $kat->nama_kategori }}</label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </form>
                </li>

                <!-- Level -->
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-xs sm:text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-level" data-collapse-toggle="dropdown-level">
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Level</span>
                        <svg class="w-2 h-2 sm:w-3 sm:h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
                        </svg>
                    </button>
                    <hr>
                    <form method="GET" action="{{ route('daftarKursus') }}" id="kursusForm">
                        <ul id="dropdown-level" class="hidden px-4 space-y-2">
                            @foreach($uniqueTingkatKesulitan as $tingkat)
                            <li>
                                <div class="flex items-center w-full sm:p-2 py-1 pr-4 text-gray-900 transition duration-75 rounded-lg group">
                                    <input id="tingkat-radio-{{ $tingkat->tingkat_kesulitan }}" type="radio"
                                        value="{{ $tingkat->tingkat_kesulitan }}"
                                        name="tingkat_kesulitan"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                        onchange="this.form.submit()"
                                        {{ request('tingkat_kesulitan') == $tingkat->tingkat_kesulitan ? 'checked' : '' }}>
                                    <label for="tingkat-radio-{{ $tingkat->tingkat_kesulitan }}" class="ms-2 text-xs sm:text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ $tingkat->tingkat_kesulitan }}
                                    </label>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </form>
                </li>
            </ul>
        </div>
    </aside>
    <!-- sidebar end -->



    <!-- Kursus start -->
    <section class="bg-white mt-8">
        <div class="mx-auto px-2 sm:px-4 2xl:px-0">
            <!-- Heading & Filters -->
            <section class="bg-white mt-8" x-data="{ showModal: false, step: 1 }">
                <!-- Tombol Tanya -->
                <div class="mb-4 justify-end space-y-4 space-x-3 sm:flex sm:space-y-0">
                    @auth
                    <button @click="showModal = true"
                        class="block text-white bg-ButtonBase hover:bg-HoverGlow transition duration-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs sm:text-sm px-5 py-2 sm:py-2.5 text-center">
                        Tanya Saya ?
                    </button>
                    @endauth
                    @guest
                    <p class="text-gray-500 text-sm">Silakan login untuk bertanya.</p>
                    @endguest
                </div>

                <!-- Modal -->
                <div x-show="showModal" x-transition.opacity.scale.duration.300ms class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                    <div @click.away="showModal = false" class="bg-white rounded-lg shadow w-full max-w-md p-6">
                        <div class="flex justify-between items-center mb-4 border-b pb-2">
                            <h3 class="text-lg font-semibold">Cari Rekomendasi Kursus</h3>
                            <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">✕</button>
                        </div>

                        <form action="{{ route('rekomendasi') }}" method="POST" class="space-y-4">
                            @csrf

                            <!-- STEP 1 -->
                            <div x-show="step === 1" x-transition>
                                <p class="mb-2 font-medium text-sm text-gray-700">💬 Berapa harga maksimum kursus yang Anda inginkan?</p>
                                <input type="number" name="harga_maks" class="mt-1 w-full rounded border-gray-300" placeholder="Contoh: 5000000">
                                @error('harga_maks') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                <div class="flex justify-end mt-2">
                                    <button type="button" @click="step++" class="bg-indigo-600 text-white rounded px-4 py-1 hover:bg-indigo-700">Lanjut</button>
                                </div>
                            </div>

                            <!-- STEP 2 -->
                            <div x-show="step === 2" x-transition>
                                <p class="mb-2 font-medium text-sm text-gray-700">💬 Berapa rating minimum kursus yang Anda harapkan? (Skala 5)</p>
                                <input type="number" step="0.1" name="rating_min" class="mt-1 w-full rounded border-gray-300" placeholder="Contoh: 4.5">
                                @error('rating_min') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                <div class="flex justify-between mt-2">
                                    <button type="button" @click="step--" class="text-gray-500">Kembali</button>
                                    <button type="button" @click="step++" class="bg-indigo-600 text-white rounded px-4 py-1 hover:bg-indigo-700">Lanjut</button>
                                </div>
                            </div>

                            <!-- STEP 3 -->
                            <div x-show="step === 3" x-transition>
                                <p class="mb-2 font-medium text-sm text-gray-700">💬 Berapa rating minimum perusahaan yang Anda harapkan? (Skala 5)</p>
                                <input type="number" step="0.1" name="rating_perusahaan_min" class="mt-1 w-full rounded border-gray-300" placeholder="Contoh: 4.2">
                                @error('rating_perusahaan_min') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                <div class="flex justify-between mt-2">
                                    <button type="button" @click="step--" class="text-gray-500">Kembali</button>
                                    <button type="button" @click="step++" class="bg-indigo-600 text-white rounded px-4 py-1 hover:bg-indigo-700">Lanjut</button>
                                </div>
                            </div>

                            <!-- STEP 4 -->
                            <div x-show="step === 4" x-transition>
                                <p class="mb-2 font-medium text-sm text-gray-700">💬 Pilih tingkat kesulitan dan lokasi kursus:</p>
                                <select name="tingkat_kesulitan" class="mt-1 w-full rounded border-gray-300">
                                    <option value="Pemula">Pemula</option>
                                    <option value="Menengah">Menengah</option>
                                    <option value="Lanjutan">Lanjutan</option>
                                </select>
                                @error('tingkat_kesulitan') <span class="text-sm text-red-500">{{ $message }}</span> @enderror

                                <input type="text" name="lokasi" class="mt-3 w-full rounded border-gray-300" placeholder="Contoh: Batam Center">
                                @error('lokasi') <span class="text-sm text-red-500">{{ $message }}</span> @enderror

                                <div class="flex justify-between mt-4">
                                    <button type="button" @click="step--" class="text-gray-500">Kembali</button>
                                    <button type="submit" class="bg-green-600 text-white rounded px-4 py-1 hover:bg-green-700">Cari Rekomendasi</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </section>


        </div>



        <!-- card start -->
        <section class="mt-2 ms-5">
            <div class="mx-auto px-2 sm:px-4 2xl:px-0">
                <div class="mb-4 grid gap-2 lg:gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 md:mb-8 ">
                    @foreach ($kursus as $item)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                        <!-- Course Image -->
                        <div class="relative cursor-default">
                            <img class="w-full h-36 object-cover" src="{{ asset('storage/' . $item->foto_kursus) }}" alt="{{ $item->judul }}">

                            <div class="absolute top-3 left-3 text-white">
                                <p class="text-sm
                                        @if($item->tingkat_kesulitan == 'Pemula') text-green-200 bg-green-700 px-2 py-1 rounded-full text-xs
                                        @elseif($item->tingkat_kesulitan == 'Menengah') text-yellow-200 bg-yellow-500 px-2 py-1 rounded-full text-xs
                                        @elseif($item->tingkat_kesulitan == 'Lanjutan') text-red-200 bg-red-700 px-2 py-1 rounded-full text-xs
                                        @else text-gray-500
                                        @endif">
                                    {{ $item->tingkat_kesulitan }}
                                </p>
                            </div>
                            <!-- <div class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold px-2 py-1 rounded-full flex items-center">
                                    <i class="fas fa-clock text-xs mr-1 text-emerald-500"></i> 12 Hours
                                </div> -->
                        </div>

                        <!-- Course Content -->
                        <div class="py-6 px-4 sm:p-6">
                            <div class="flex justify-between items-start mb-2 cursor-default">
                                <span class="text-blue-800 text-[10px] sm:text-xs font-medium py-0.5 rounded me-2">{{ json_decode($item->kategori)->nama_kategori }}</span>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                                    <span class="text-gray-700 text-[10px] sm:text-xs font-medium ml-1"> {{ number_format($item->average_rating, 1) ?? 'Belum Ada Rating' }}</span>
                                    <span class="text-gray-400 text-[10px] sm:text-xs ml-1">({{ $item->total_ratings }})</span>
                                </div>
                            </div>

                            <div class="w-full text-left">
                                <a href="/CoursePage/{{ $item->kursus_id }}" class="hover:text-HoverGlow active:text-ButtonBase text-sm sm:text-md font-bold text-gray-800 mb-1 line-clamp-2 text-left">
                                    {{ $item->judul }}
                                </a>
                                <p class="cursor-default text-gray-500 text-[10px] sm:text-xs mb-4 line-clamp-2 text-left">{{ $item->deskripsi }} </p>
                            </div>


                            <div class="flex items-center justify-between cursor-default">
                                <div class="flex items-center">
                                    <img class="w-5 h-5 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Instructor">
                                    <div class="ml-2">
                                        <p class="text-[7px] sm:text-[11px] lg:text-xs font-medium text-gray-700">{{ $item->pengguna->nama }}</p>
                                        <p class="text-[6px] sm:text-[10px] lg:text-[11px] text-gray-500">Instruktur</p>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <p class="text-ButtonBase font-bold text-[10px] sm:text-[13px] lg:text-sm">Rp.{{ number_format($item->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                <div class="flex justify-center items-center mt-5">
                    <ul class="inline-flex -space-x-px text-sm">
                        <!-- Tombol Previous -->
                        @if($kursus->onFirstPage())
                        <li>
                            <span class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-400 bg-gray-200 border border-gray-300 rounded-s-lg cursor-not-allowed">
                                Sebelumnya
                            </span>
                        </li>
                        @else
                        <li>
                            <a href="{{ $kursus->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                Sebelumnya
                            </a>
                        </li>
                        @endif

                        <!-- Tombol Next -->
                        @if($kursus->hasMorePages())
                        <li>
                            <a href="{{ $kursus->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                Berikutnya
                            </a>
                        </li>
                        @else
                        <li>
                            <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-400 bg-gray-200 border border-gray-300 rounded-e-lg cursor-not-allowed">
                                Berikutnya
                            </span>
                        </li>
                        @endif
                    </ul>
                </div>

                <!-- Menampilkan informasi data -->
                <div class="mt-4 mb-5 text-center text-sm text-gray-600 dark:text-gray-400">
                    Menampilkan {{ $kursus->firstItem() }} sampai {{ $kursus->lastItem() }} dari {{ $kursus->total() }} entri
                </div>
            </div>
        </section>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        const inputHargaMaks = document.getElementById('harga_maks');
        const rawHargaMaks = document.getElementById('raw_harga_maks');

        inputHargaMaks.addEventListener('input', function(e) {
            // Hapus semua karakter selain angka
            let angka = e.target.value.replace(/[^,\d]/g, '');

            // Simpan nilai asli (angka tanpa format) di hidden input
            rawHargaMaks.value = angka;

            // Format angka ke dalam format Rupiah
            e.target.value = formatRupiah(angka);
        });

        function formatRupiah(angka) {
            let numberString = angka.replace(/[^,\d]/g, '').toString(),
                split = numberString.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }
    </script>

    @endsection