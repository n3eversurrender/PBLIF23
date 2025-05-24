@extends('layouts.main')

@section('Main')

<main>
    <section class="p-3 sm:px-10 lg:px-10 mt-20">
        <h2 class="my-2 font-bold text-xl sm:text-3xl text-slate-950">Riwayat Kursus Saya</h2>

        <!-- Kursus Selesai -->
        <div class="mb-16 mt-8 space-y-4">
            <!-- Card start -->
            <!-- Card 1 -->
            <div class="ticket-card bg-white rounded-lg shadow-sm p-6 border-l-4 border-secondary border-ButtonBase">
                <div class="grid grid-cols-1 md:grid-cols-6 md:items-start md:justify-between">
                    <div class=" col-span-5">
                        <div class="flex items-start">
                            <img src="https://images.unsplash.com/photo-1542626991-cbc4e32524cc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" alt="Course" class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                            <div class="ml-4">
                                <div class="flex items-center flex-wrap">
                                    <h3 class="font-bold text-dark mr-2">Workshop React Mastery</h3>
                                    <span class="bg-secondary text-sky-500 text-xs px-2 py-0.5 rounded">Anda belum memberikan ulasan</span>
                                </div>
                                <div class="mt-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <p class="text-xs text-gray-800">Tanggal Pembelian</p>
                                        <p class="text-sm font-medium">15 Agustus 2023</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-800">Tanggal Selesai</p>
                                        <p class="text-sm font-medium">-</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-800">Lokasi</p>
                                        <p class="text-sm font-medium line-clamp-2">Gedung Serbaguna Jakarta Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam, saepe!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 flex flex-col md:items-end space-y-2">
                        <p class="text-lg font-bold text-dark">Rp 750.000</p>
                        <div class="flex space-x-2">
                            <a href="/DetailRiwayat" class="bg-primary text-white bg-ButtonBase hover:bg-HoverGlow px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="ticket-card bg-white rounded-lg shadow-sm p-6 border-l-4 border-secondary border-ButtonBase">
                <div class="grid grid-cols-1 md:grid-cols-6 md:items-start md:justify-between">
                    <div class=" col-span-5">
                        <div class="flex items-start">
                            <img src="https://images.unsplash.com/photo-1542626991-cbc4e32524cc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" alt="Course" class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                            <div class="ml-4">
                                <div class="flex items-center flex-wrap">
                                    <h3 class="font-bold text-dark mr-2">Workshop React Mastery</h3>
                                    <span class="bg-secondary text-green-100 bg-green-600  text-xs px-2 py-0.5 rounded">Sudah memberikan Ulasan</span>
                                </div>
                                <div class="mt-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <p class="text-xs text-gray-800">Tanggal Pembelian</p>
                                        <p class="text-sm font-medium">15 Agustus 2023</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-800">Tanggal Selesai</p>
                                        <p class="text-sm font-medium">30 September 2023</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-800">Lokasi</p>
                                        <p class="text-sm font-medium line-clamp-2">Gedung Serbaguna Jakarta Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam, saepe!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 flex flex-col md:items-end space-y-2">
                        <p class="text-lg font-bold text-dark">Rp 750.000</p>
                        <div class="flex space-x-2">
                            <a href="/DetailRiwayat" class="bg-primary text-white bg-ButtonBase hover:bg-HoverGlow px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






</main>

@endsection