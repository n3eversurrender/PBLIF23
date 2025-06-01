@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')

<main>
    <!-- Stats Grid -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Stat Card 1 -->
        <div class="bg-white rounded-xl shadow-xl p-6 border-t-4 border-blue-500 card-hover">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Kursus Aktif</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">24</h3>
                </div>
                <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                    <i class="fas fa-book-open text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white rounded-xl shadow-xl p-6 border-t-4 border-blue-500 card-hover">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Peserta</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">1,842</h3>
                </div>
                <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white rounded-xl shadow-xl p-6 border-t-4 border-blue-500 card-hover">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Rating Rata-rata</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">4.7</h3>
                </div>
                <div class="p-3 rounded-lg bg-amber-50 text-amber-600">
                    <i class="fas fa-star text-xl"></i>
                </div>
            </div>
        </div>
    </section>
    <!-- Pendapatan Bulan Ini -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center gap-4">
            <div class="bg-blue-100 p-2 rounded-full text-blue-600">
                <i class="fas fa-wallet text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Pendapatan Bulan Ini</p>
                <h3 class="text-2xl font-bold mt-1">Rp 28,5jt</h3>
            </div>
        </div>
    </div>

    <section class="mt-4">
        <h1 class="text-xl font-semibold mb-4">Kursus Terbaru</h1>
        <!-- courses start -->
        <div class="bg-white shadow-lg flex items-center space-x-6 p-2">
            <!-- Course Image -->
            <div class="relative flex-shrink-0 w-48 h-36 cursor-default rounded-lg overflow-hidden">
                <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1542626991-cbc4e32524cc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Course thumbnail">
                <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                    Lanjutan
                </div>
            </div>
            <!-- Course Content -->
            <div class="flex flex-col justify-between flex-grow h-full">
                <div>
                    <div class="flex justify-between items-start mb-2 cursor-default">
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Pengelasan</span>
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                            <span class="text-gray-700 text-sm font-medium ml-1">4.9</span>
                            <span class="text-gray-400 text-sm ml-1">(128)</span>
                        </div>
                    </div>

                    <a href="#" class="text-lg font-bold text-gray-800 mb-1 line-clamp-2 hover:text-HoverGlow active:text-ButtonBase">
                        Advanced React Patterns and Modern JavaScript Techniques
                    </a>
                    <p class="text-gray-500 text-xs mb-4 line-clamp-2 cursor-default">
                        Master React hooks, context API, and advanced state management to
                    </p>
                </div>

                <div class="flex items-center justify-between cursor-default">
                    <div class="flex items-center">
                        <img class="w-8 h-8 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Instructor">
                        <div class="ml-2">
                            <p class="text-sm font-medium text-gray-700">Sarah Johnson</p>
                            <p class="text-xs text-gray-500">Senior Developer</p>
                        </div>
                    </div>

                    <p class="text-ButtonBase font-bold text-base">Rp. 6.000.000</p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-lg flex items-center space-x-6 p-2">
            <!-- Course Image -->
            <div class="relative flex-shrink-0 w-48 h-36 cursor-default rounded-lg overflow-hidden">
                <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1542626991-cbc4e32524cc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Course thumbnail">
                <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                    Lanjutan
                </div>
            </div>
            <!-- Course Content -->
            <div class="flex flex-col justify-between flex-grow h-full">
                <div>
                    <div class="flex justify-between items-start mb-2 cursor-default">
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Pengelasan</span>
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                            <span class="text-gray-700 text-sm font-medium ml-1">4.9</span>
                            <span class="text-gray-400 text-sm ml-1">(128)</span>
                        </div>
                    </div>

                    <a href="#" class="text-lg font-bold text-gray-800 mb-1 line-clamp-2 hover:text-HoverGlow active:text-ButtonBase">
                        Advanced React Patterns and Modern JavaScript Techniques
                    </a>
                    <p class="text-gray-500 text-xs mb-4 line-clamp-2 cursor-default">
                        Master React hooks, context API, and advanced state management to
                    </p>
                </div>

                <div class="flex items-center justify-between cursor-default">
                    <div class="flex items-center">
                        <img class="w-8 h-8 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Instructor">
                        <div class="ml-2">
                            <p class="text-sm font-medium text-gray-700">Sarah Johnson</p>
                            <p class="text-xs text-gray-500">Senior Developer</p>
                        </div>
                    </div>

                    <p class="text-ButtonBase font-bold text-base">Rp. 6.000.000</p>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 text-center">
            <a href="#" class="text-primary hover:underline font-medium">Lihat Semua Kursus</a>
        </div>
    </section>

    <section class="mt-7">
        <!-- Recent Transactions and Notifications -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Riwayat Transaksi Terkini -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Transaksi Terakhir</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-lg mr-4">
                                    <i class="fas fa-check-circle text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Web Development Mastery</p>
                                    <p class="text-sm text-gray-500">ID: TRX-20230615</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-green-600">Rp 499,000</p>
                                <p class="text-xs text-gray-500">15 Jun 2023 • 10:45</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-lg mr-4">
                                    <i class="fas fa-check-circle text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Data Science Fundamentals</p>
                                    <p class="text-sm text-gray-500">ID: TRX-20230614</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-green-600">Rp 799,000</p>
                                <p class="text-xs text-gray-500">14 Jun 2023 • 14:20</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="bg-yellow-100 p-2 rounded-lg mr-4">
                                    <i class="fas fa-exclamation-circle text-yellow-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Mobile App Development</p>
                                    <p class="text-sm text-gray-500">ID: TRX-20230613</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-gray-600">Rp 599,000</p>
                                <p class="text-xs text-gray-500">13 Jun 2023 • 09:15</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 text-center">
                    <a href="#" class="text-primary hover:underline font-medium">Lihat Semua Transaksi</a>
                </div>
            </div>

            <!-- Notifikasi Terbaru -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Notifikasi Terbaru</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex items-start">
                            <div class="bg-blue-100 p-2 rounded-lg mr-4">
                                <i class="fas fa-user-plus text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Pendaftaran Baru</p>
                                <p class="text-sm text-gray-500">Budi Santoso mendaftar kursus Web Development</p>
                                <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex items-start">
                            <div class="bg-yellow-100 p-2 rounded-lg mr-4">
                                <i class="fas fa-star text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Ulasan Baru</p>
                                <p class="text-sm text-gray-500">Ani Wijaya memberikan rating 5 untuk kursus Data Science</p>
                                <p class="text-xs text-gray-400 mt-1">5 jam yang lalu</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex items-start">
                            <div class="bg-red-100 p-2 rounded-lg mr-4">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Pembayaran Gagal</p>
                                <p class="text-sm text-gray-500">Pembayaran untuk TRX-20230612 gagal diproses</p>
                                <p class="text-xs text-gray-400 mt-1">1 hari yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 text-center">
                    <a href="#" class="text-primary hover:underline font-medium">Lihat Semua Notifikasi</a>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection