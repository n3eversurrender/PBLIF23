@extends('layouts.main')

@vite(['resources/js/home.js'])
@section('Main')

<main class="mt-16 mx-10">
    <section class="pt-8">
        <h1 class="font-bold text-2xl text-center mb-10 uppercase">PT. Skill Maju</h1>
        <div class="sm:grid lg:grid-cols-4 sm:grid-cols-3 gap-4">
            <div class=" sm:col-span-1">
                <img src="{{ asset('image/12.webp') }}" class="rounded-full aspect-square object-cover" />
            </div>
            <div class="lg:col-span-3 sm:col-span-2 px-2 lg:px-6 mt-5 sm:mt-0 text-sm sm:text-base">
                <div class="mb-3">
                    <label class="font-bold text-gray-900 uppercase">Deskripsi:</label>
                    <p class="text-gray-700">
                        Established in 2004, PT. DUA UTAMA JAYA committed to deliver customer satisfaction. With our extensive experiences in related industries, we execute projects professionally based on standard and your specification.mus eget est sit amet, condimentum hendrerit erat. In porta quis odio eget mollis.
                    </p>
                    <p class="text-gray-700">
                        DUJ’s scopes are  in two business areas:
                    </p>
                </div>

                <div class="mb-3">
                    <label class="font-bold text-gray-900">EDUCATION:</label>
                    <ul class="text-gray-700">
                        <li>- Provision of the welding institute (TWI) Training (Courses and Certification)</li>
                        <li>- DUTC Training</li>
                    </ul>
                </div>

                <div class="mb-3">
                    <label class="font-bold text-gray-900">SERVICES:</label>
                    <ul class="text-gray-700">
                        <li>- Inspection and Testing (For welder qualification test) </li>
                        <li>- Manpower Supply</li>
                        <li>- Welding Works (structural & piping)</li>
                        <li>- Process WPS Procedure</li>
                        <li>- Rental Equipment</li>
                    </ul>
                </div>

                <div class="mb-3">
                    <label class="font-bold text-gray-900">VISION</label>
                    <p class="text-gray-700">Having contributions in developing human resources and to developing professional skillfull labor according to the Republic Indonesia Government’s program. PT. DUA UTAMA JAYA as a strategic option to works and as a bridge to reach the career successfully in the future.</p>
                </div>

                <div class="mb-3">
                    <label class="font-bold text-gray-900">MISION</label>
                    <p class="text-gray-700">To be the right partner in competitive business environment and to fulfill mutual benefit.</p>
                </div>

                <div>
                    <p class="font-semibold">Email : <span class="font-normal text-gray-700">info@teknikmaju.co.id</span></p>
                    <p class="font-semibold">No Telepon : <span class="font-normal text-gray-700">(021) 1234-5678</span></p>
                    <p class="font-semibold">Address : <span class="font-normal text-gray-700">Comp. Green Town Warehouse No. 1, Jalan Yos Sudarso, Bengkong, Bengkong Laut, Kec. Bengkong, Kota Batam, Kepulauan Riau 29457</span></p>
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
                    <p class="text-lg text-gray-800">01.234.567.8-912.345</p>
                </div>
                <div class="border-t pt-2">
                    <p class="text-sm text-gray-500 font-semibold">Akta Pendirian</p>
                    <p class="text-lg text-gray-800">No. 123/XYZ/2010</p>
                </div>
                <div class="border-t pt-2">
                    <p class="text-sm text-gray-500 font-semibold">Izin Operasional</p>
                    <p class="text-lg text-gray-800">No. 456/DIKTI/2011</p>
                </div>
                <div class="border-t pt-2">
                    <p class="text-sm text-gray-500 font-semibold">Sertifikasi BNSP</p>
                    <p class="text-lg text-gray-800">No. 789/BNSP/2015</p>
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
                        <!-- Card 1 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                            <!-- Course Image -->
                            <div class="relative cursor-default">
                                <img class="w-full h-44 sm:h-36 lg:h-44 object-cover" src="https://images.unsplash.com/photo-1542626991-cbc4e32524cc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Course thumbnail">
                                <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                    Lanjutan
                                </div>
                                <!-- <div class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold px-2 py-1 rounded-full flex items-center">
                                    <i class="fas fa-clock text-xs mr-1 text-emerald-500"></i> 12 Hours
                                </div> -->
                            </div>

                            <!-- Course Content -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2 cursor-default">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Pengelasan</span>
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <span class="text-gray-700 text-sm font-medium ml-1">4.9</span>
                                        <span class="text-gray-400 text-sm ml-1">(128)</span>
                                    </div>
                                </div>

                                <div class="w-full text-left">
                                    <a href="#" class="lg:text-lg text-md font-bold text-gray-800 mb-1 line-clamp-2 text-left hover:text-HoverGlow active:text-ButtonBase">
                                        Advanced React Patterns and Modern JavaScript Techniques
                                    </a>
                                    <p class="text-gray-500 text-xs mb-4 line-clamp-2 text-left cursor-default">Master React hooks, context API, and advanced state management to </p>
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
                                        <p class="text-ButtonBase font-bold text-base lg:text-lg">Rp. 6.000.000</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Footer -->
                            <!-- <div class="text-right px-6 py-4 bg-gray-50 border-t border-gray-100">
                                <div class="flex space-x-2">
                                    <span class="text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-users mr-1"></i> 245 Students
                                    </span>
                                    <span class="text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-book mr-1"></i> 15 Lessons
                                    </span>
                                </div>
                                <button class="bg-ButtonBase hover:bg-HoverGlow text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-sm">
                                    Lihat Detail
                                </button>
                            </div> -->
                        </div>

                        <!-- Card 2 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                            <!-- Course Image -->
                            <div class="relative cursor-default">
                                <img class="w-full h-44 sm:h-36 lg:h-44 object-cover" src="https://images.unsplash.com/photo-1542626991-cbc4e32524cc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Course thumbnail">
                                <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                    Lanjutan
                                </div>
                                <!-- <div class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold px-2 py-1 rounded-full flex items-center">
                                    <i class="fas fa-clock text-xs mr-1 text-emerald-500"></i> 12 Hours
                                </div> -->
                            </div>

                            <!-- Course Content -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2 cursor-default">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Pengelasan</span>
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <span class="text-gray-700 text-sm font-medium ml-1">4.9</span>
                                        <span class="text-gray-400 text-sm ml-1">(128)</span>
                                    </div>
                                </div>

                                <div class="w-full text-left">
                                    <a href="#" class="lg:text-lg text-md font-bold text-gray-800 mb-1 line-clamp-2 text-left hover:text-HoverGlow active:text-ButtonBase">
                                        Advanced React Patterns and Modern JavaScript Techniques
                                    </a>
                                    <p class="text-gray-500 text-xs mb-4 line-clamp-2 text-left cursor-default">Master React hooks, context API, and advanced state management to </p>
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
                                        <p class="text-ButtonBase font-bold text-base lg:text-lg">Rp. 6.000.000</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Footer -->
                            <!-- <div class="text-right px-6 py-4 bg-gray-50 border-t border-gray-100">
                                <div class="flex space-x-2">
                                    <span class="text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-users mr-1"></i> 245 Students
                                    </span>
                                    <span class="text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-book mr-1"></i> 15 Lessons
                                    </span>
                                </div>
                                <button class="bg-ButtonBase hover:bg-HoverGlow text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-sm">
                                    Lihat Detail
                                </button>
                            </div> -->
                        </div>

                        <!-- Card 3 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                            <!-- Course Image -->
                            <div class="relative cursor-default">
                                <img class="w-full h-44 sm:h-36 lg:h-44 object-cover" src="https://images.unsplash.com/photo-1542626991-cbc4e32524cc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Course thumbnail">
                                <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                    Lanjutan
                                </div>
                                <!-- <div class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold px-2 py-1 rounded-full flex items-center">
                                    <i class="fas fa-clock text-xs mr-1 text-emerald-500"></i> 12 Hours
                                </div> -->
                            </div>

                            <!-- Course Content -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2 cursor-default">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Pengelasan</span>
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <span class="text-gray-700 text-sm font-medium ml-1">4.9</span>
                                        <span class="text-gray-400 text-sm ml-1">(128)</span>
                                    </div>
                                </div>

                                <div class="w-full text-left">
                                    <a href="#" class="lg:text-lg text-md font-bold text-gray-800 mb-1 line-clamp-2 text-left hover:text-HoverGlow active:text-ButtonBase">
                                        Advanced React Patterns and Modern JavaScript Techniques
                                    </a>
                                    <p class="text-gray-500 text-xs mb-4 line-clamp-2 text-left cursor-default">Master React hooks, context API, and advanced state management to </p>
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
                                        <p class="text-ButtonBase font-bold text-base lg:text-lg">Rp. 6.000.000</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Footer -->
                            <!-- <div class="text-right px-6 py-4 bg-gray-50 border-t border-gray-100">
                                <div class="flex space-x-2">
                                    <span class="text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-users mr-1"></i> 245 Students
                                    </span>
                                    <span class="text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-book mr-1"></i> 15 Lessons
                                    </span>
                                </div>
                                <button class="bg-ButtonBase hover:bg-HoverGlow text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-sm">
                                    Lihat Detail
                                </button>
                            </div> -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Galeri Perusahaan</h2>
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
                    <p class="text-gray-600 text-xs md:text-sm">Bagikan pengalaman Anda mengikuti</p>
                    <p class="font-semibold text-xs md:text-sm">Workshop React Mastery</p>
                </div>

                <!-- Review Form -->
                <div class="shadow-sm">
                    <!-- Course Info -->
                    <div class="flex items-start mb-2 p-4 bg-gray-50 rounded-lg">
                        <img src="{{ asset('image/SKILLB.png') }}" alt="Thumbnail Kursus" class="md:w-20 md:h-20 w-10 h-10 rounded-full object-cover mr-4">
                        <div>
                            <h3 class="font-bold text-base md:text-lg">PT. Skill Maju</h3>
                            <div class="mt-1 flex items-center text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="text-gray-600 ml-2 text-xs md:text-sm">4.3 (128 ulasan)</span>
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
        </section>
    </section>

    <section class="pb-10">
        <div class="grid grid-cols-4">
            <!-- Scenario 4: Already reviewed -->
            <div class="bg-gray-50 md:p-4 p-2 rounded-lg text-xs md:text-sm text-center">
                <div class="flex flex-col items-center text-amber-400 mb-2">
                    <div class="flex space-x-1">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="text-gray-700 mt-1">4.5/5</span>
                </div>
                <p class="font-medium italic">"Materinya bagus dan instruktur sangat komunikatif."</p>
                <p class="text-sm text-gray-500 mt-1">Ulasan diberikan pada 30 Agustus 2023</p>
            </div>
            <!-- Scenario 4: Already reviewed -->
            <div class="bg-gray-50 md:p-4 p-2 rounded-lg text-xs md:text-sm text-center">
                <div class="flex flex-col items-center text-amber-400 mb-2">
                    <div class="flex space-x-1">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="text-gray-700 mt-1">4.5/5</span>
                </div>
                <p class="font-medium italic">"Materinya bagus dan instruktur sangat komunikatif."</p>
                <p class="text-sm text-gray-500 mt-1">Ulasan diberikan pada 30 Agustus 2023</p>
            </div>
            <!-- Scenario 4: Already reviewed -->
            <div class="bg-gray-50 md:p-4 p-2 rounded-lg text-xs md:text-sm text-center">
                <div class="flex flex-col items-center text-amber-400 mb-2">
                    <div class="flex space-x-1">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="text-gray-700 mt-1">4.5/5</span>
                </div>
                <p class="font-medium italic">"Materinya bagus dan instruktur sangat komunikatif."</p>
                <p class="text-sm text-gray-500 mt-1">Ulasan diberikan pada 30 Agustus 2023</p>
            </div>
            <!-- Scenario 4: Already reviewed -->
            <div class="bg-gray-50 md:p-4 p-2 rounded-lg text-xs md:text-sm text-center">
                <div class="flex flex-col items-center text-amber-400 mb-2">
                    <div class="flex space-x-1">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="text-gray-700 mt-1">4.5/5</span>
                </div>
                <p class="font-medium italic">"Materinya bagus dan instruktur sangat komunikatif."</p>
                <p class="text-sm text-gray-500 mt-1">Ulasan diberikan pada 30 Agustus 2023</p>
            </div>
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
@endsection