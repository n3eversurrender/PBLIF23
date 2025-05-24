@extends('layouts.main')

@vite(['resources/js/home.js'])
@vite(['resources/css/berandaperusahaan.css'])
@section('Main')

<main>
    <div class="relative w-full">
        <img class="h-auto w-full max-h-[700px] object-cover" src="{{ asset('image/12.webp') }}" alt="Background Main">
        <div class="absolute left-4 sm:left-16 top-36 sm:top-1/2 transform -translate-y-1/2 text-white p-2 rounded w-1/2">
            <h2 class=" text-xl sm:text-4xl lg:text-5xl font-bold whitespace-normal">
                Membentuk Keterampilan, Menggerakkan Industri!
            </h2>
            <!-- @guest
        <a href="/Daftar" class="mt-4 sm:mt-10 text-sm sm:text-base inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            Daftar Sekarang
        </a>
        @endguest -->
        </div>
    </div>

    <div class="sm:mx-10 mx-5">
        <!-- Profil perusahaan -->
        <section class="my-5 sm:my-10">
            <div class="flex items-center space-x-4 sm:mb-8 mb-4">
                <h1 class="text-3xl font-bold uppercase">Profil Perusahaan</h1>
                <div class="flex-1 border-t border-2 border-gray-300"></div>
            </div>
            <div class="sm:grid lg:grid-cols-4 sm:grid-cols-3 gap-4">
                <div class=" sm:col-span-1">
                    <img src="{{ asset('image/12.webp') }}" class="rounded-lg aspect-square sm:aspect-9/16 object-cover" />
                </div>
                <div class="lg:col-span-3 sm:col-span-2 px-2 lg:px-6 mt-5 sm:mt-0 text-sm sm:text-base">
                    <p>
                        Established in 2004, PT. DUA UTAMA JAYA committed to deliver customer satisfaction. With our extensive experiences in related industries, we execute projects professionally based on standard and your specification.mus eget est sit amet, condimentum hendrerit erat. In porta quis odio eget mollis.
                    </p>
                    <p>
                        DUJ’s scopes are  in two business areas:
                    </p>

                    <label class="font-bold">EDUCATION:</label>
                    <ul>
                        <li>- Provision of the welding institute (TWI) Training (Courses and Certification)</li>
                        <li>- DUTC Training</li>
                    </ul>

                    <label class="font-bold">SERVICES:</label>
                    <ul>
                        <li>- Inspection and Testing (For welder qualification test) </li>
                        <li>- Manpower Supply</li>
                        <li>- Welding Works (structural & piping)</li>
                        <li>- Process WPS Procedure</li>
                        <li>- Rental Equipment</li>
                    </ul>

                    <label class="font-bold">VISION</label>
                    <p>Having contributions in developing human resources and to developing professional skillfull labor according to the Republic Indonesia Government’s program. PT. DUA UTAMA JAYA as a strategic option to works and as a bridge to reach the career successfully in the future.</p>

                    <label class="font-bold">MISION</label>
                    <p>To be the right partner in competitive business environment and to fulfill mutual benefit.</p>
                    <p>lorem50</p>
                    <p>Address: Comp. Green Town Warehouse No. 1, Jalan Yos Sudarso, Bengkong, Bengkong Laut, Kec. Bengkong, Kota Batam, Kepulauan Riau 29457</p>
                </div>
            </div>

        </section>

        <!-- Kursus tersedia -->
        <section class="my-20">
            <h1 class="text-3xl font-bold uppercase mb-6">kursus tersedia</h1>
            <!-- Grid Container -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    <!-- Course Image -->
                    <div class="relative cursor-default">
                        <img class="w-full h-36 object-cover" src="https://images.unsplash.com/photo-1542626991-cbc4e32524cc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Course thumbnail">
                        <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                            Lanjutan
                        </div>
                    </div>

                    <!-- Course Content -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2 cursor-default">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Pengelasan</span>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <span class="text-gray-700 text-xs font-medium ml-1">4.9</span>
                                <span class="text-gray-400 text-xs ml-1">(128)</span>
                            </div>
                        </div>

                        <div class="w-full text-left">
                            <a href="#" class="hover:text-HoverGlow active:text-ButtonBase text-md font-bold text-gray-800 mb-1 line-clamp-2 text-left">
                                Advanced React Patterns and Modern JavaScript Techniques
                            </a>
                            <p class="cursor-default text-gray-500 text-xs mb-4 line-clamp-2 text-left">Master React hooks, context API, and advanced state management to </p>
                        </div>


                        <div class="flex items-center justify-between cursor-default">
                            <div class="flex items-center">
                                <img class="w-8 h-8 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Instructor">
                                <div class="ml-2">
                                    <p class="text-xs font-medium text-gray-700">Sarah Johnson</p>
                                    <p class="text-[11px] text-gray-500">Senior Developer</p>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="text-ButtonBase font-bold text-sm">Rp. 6.000.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    <!-- Course Image -->
                    <div class="relative cursor-default">
                        <img class="w-full h-36 object-cover" src="https://images.unsplash.com/photo-1542626991-cbc4e32524cc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Course thumbnail">
                        <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                            Lanjutan
                        </div>
                    </div>

                    <!-- Course Content -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2 cursor-default">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Pengelasan</span>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <span class="text-gray-700 text-xs font-medium ml-1">4.9</span>
                                <span class="text-gray-400 text-xs ml-1">(128)</span>
                            </div>
                        </div>

                        <div class="w-full text-left">
                            <a href="#" class="hover:text-HoverGlow active:text-ButtonBase text-md font-bold text-gray-800 mb-1 line-clamp-2 text-left">
                                Advanced React Patterns and Modern JavaScript Techniques
                            </a>
                            <p class="cursor-default text-gray-500 text-xs mb-4 line-clamp-2 text-left">Master React hooks, context API, and advanced state management to </p>
                        </div>


                        <div class="flex items-center justify-between cursor-default">
                            <div class="flex items-center">
                                <img class="w-8 h-8 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Instructor">
                                <div class="ml-2">
                                    <p class="text-xs font-medium text-gray-700">Sarah Johnson</p>
                                    <p class="text-[11px] text-gray-500">Senior Developer</p>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="text-ButtonBase font-bold text-sm">Rp. 6.000.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    <!-- Course Image -->
                    <div class="relative cursor-default">
                        <img class="w-full h-36 object-cover" src="https://images.unsplash.com/photo-1542626991-cbc4e32524cc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Course thumbnail">
                        <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                            Lanjutan
                        </div>
                    </div>

                    <!-- Course Content -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2 cursor-default">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Pengelasan</span>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <span class="text-gray-700 text-xs font-medium ml-1">4.9</span>
                                <span class="text-gray-400 text-xs ml-1">(128)</span>
                            </div>
                        </div>

                        <div class="w-full text-left">
                            <a href="#" class="hover:text-HoverGlow active:text-ButtonBase text-md font-bold text-gray-800 mb-1 line-clamp-2 text-left">
                                Advanced React Patterns and Modern JavaScript Techniques
                            </a>
                            <p class="cursor-default text-gray-500 text-xs mb-4 line-clamp-2 text-left">Master React hooks, context API, and advanced state management to </p>
                        </div>


                        <div class="flex items-center justify-between cursor-default">
                            <div class="flex items-center">
                                <img class="w-8 h-8 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Instructor">
                                <div class="ml-2">
                                    <p class="text-xs font-medium text-gray-700">Sarah Johnson</p>
                                    <p class="text-[11px] text-gray-500">Senior Developer</p>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="text-ButtonBase font-bold text-sm">Rp. 6.000.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    <!-- Course Image -->
                    <div class="relative cursor-default">
                        <img class="w-full h-36 object-cover" src="https://images.unsplash.com/photo-1542626991-cbc4e32524cc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Course thumbnail">
                        <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                            Lanjutan
                        </div>
                    </div>

                    <!-- Course Content -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2 cursor-default">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Pengelasan</span>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <span class="text-gray-700 text-xs font-medium ml-1">4.9</span>
                                <span class="text-gray-400 text-xs ml-1">(128)</span>
                            </div>
                        </div>

                        <div class="w-full text-left">
                            <a href="#" class="hover:text-HoverGlow active:text-ButtonBase text-md font-bold text-gray-800 mb-1 line-clamp-2 text-left">
                                Advanced React Patterns and Modern JavaScript Techniques
                            </a>
                            <p class="cursor-default text-gray-500 text-xs mb-4 line-clamp-2 text-left">Master React hooks, context API, and advanced state management to </p>
                        </div>


                        <div class="flex items-center justify-between cursor-default">
                            <div class="flex items-center">
                                <img class="w-8 h-8 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Instructor">
                                <div class="ml-2">
                                    <p class="text-xs font-medium text-gray-700">Sarah Johnson</p>
                                    <p class="text-[11px] text-gray-500">Senior Developer</p>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="text-ButtonBase font-bold text-sm">Rp. 6.000.000</p>
                            </div>
                        </div>
                    </div>
                </div>
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
        </section>

        <!-- galeri perusahaan -->
        <section class="mb-20">
            <h1 class="text-3xl mb-6 font-bold uppercase">galeri perusahaan</h1>
            <!-- Grid Galeri -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Item 1 -->
                <div class="gallery-item group relative overflow-hidden rounded-xl shadow-md hover:shadow-lg transition duration-300 cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                        alt="Tim Perusahaan"
                        class="w-full h-64 object-cover transition duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                        <div>
                            <h3 class="text-white font-semibold text-lg">Kegiatan Team Building</h3>
                            <p class="text-gray-200 text-sm mt-1">15 Januari 2023</p>
                        </div>
                    </div>
                    <div class="absolute top-4 right-4 bg-white/90 rounded-full p-2 opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fas fa-expand text-gray-800"></i>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="gallery-item group relative overflow-hidden rounded-xl shadow-md hover:shadow-lg transition duration-300 cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                        alt="Kantor Perusahaan"
                        class="w-full h-64 object-cover transition duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                        <div>
                            <h3 class="text-white font-semibold text-lg">Kantor Pusat</h3>
                            <p class="text-gray-200 text-sm mt-1">Jakarta, Indonesia</p>
                        </div>
                    </div>
                    <div class="absolute top-4 right-4 bg-white/90 rounded-full p-2 opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fas fa-expand text-gray-800"></i>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="gallery-item group relative overflow-hidden rounded-xl shadow-md hover:shadow-lg transition duration-300 cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                        alt="Peluncuran Produk"
                        class="w-full h-64 object-cover transition duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                        <div>
                            <h3 class="text-white font-semibold text-lg">Peluncuran Produk Baru</h3>
                            <p class="text-gray-200 text-sm mt-1">22 Maret 2023</p>
                        </div>
                    </div>
                    <div class="absolute top-4 right-4 bg-white/90 rounded-full p-2 opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fas fa-expand text-gray-800"></i>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="gallery-item group relative overflow-hidden rounded-xl shadow-md hover:shadow-lg transition duration-300 cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                        alt="Pelatihan Karyawan"
                        class="w-full h-64 object-cover transition duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                        <div>
                            <h3 class="text-white font-semibold text-lg">Pelatihan Karyawan</h3>
                            <p class="text-gray-200 text-sm mt-1">10 Februari 2023</p>
                        </div>
                    </div>
                    <div class="absolute top-4 right-4 bg-white/90 rounded-full p-2 opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fas fa-expand text-gray-800"></i>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <button class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="px-4 py-2 border border-blue-600 rounded-md text-white bg-blue-600">1</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">2</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">3</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </nav>
            </div>
            <!-- Modal -->
            <div class="fixed inset-0 bg-black/90 z-50 flex items-center justify-center hidden" id="imageModal">
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
                    imageModal.classList.add('hidden');
                    document.body.style.overflow = 'auto'; // Mengembalikan scrolling
                }
            </script>
            <!-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mx-10">
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg" alt="">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg" alt="">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-2.jpg" alt="">
                    </div>
                </div>
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-3.jpg" alt="">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-4.jpg" alt="">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-5.jpg" alt="">
                    </div>
                </div>
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-6.jpg" alt="">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-7.jpg" alt="">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-8.jpg" alt="">
                    </div>
                </div>
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-9.jpg" alt="">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-10.jpg" alt="">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-11.jpg" alt="">
                    </div>
                </div>
            </div> -->
        </section>
    </div>
</main>

@endsection