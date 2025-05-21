@extends('layouts.main')

@section('Main')
<section class="bg-white mt-8">
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">Hasil Rekomendasi</h2>

        @if(isset($data['rekomendasi']) && count($data['rekomendasi']) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($data['rekomendasi'] as $index => $kursus)
            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
                <!-- Peringkat -->
                <div class="flex justify-between items-center mb-3">
                    <h4 class="text-sm font-semibold text-gray-600">
                        Rekomendasi {{ $index + 1 }}
                    </h4>
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 @if($i <= 5 - $index) text-yellow-500 @else text-gray-300 @endif" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 .587l3.668 7.425L24 9.337l-6 5.846 1.412 8.247L12 18.896l-7.412 4.534L6 15.183 0 9.337l8.332-1.325z" />
                        </svg>
                        @endfor
                    </div>
                </div>

                <!-- Thumbnail -->
                <div class="aspect-video">
                    <img class="w-full h-full rounded-lg object-cover"
                        src="{{ $kursus['foto_kursus'] ?? asset('image/Thumnnail.jpg') }}"
                        alt="{{ $kursus['judul'] }}" />
                </div>

                <!-- Informasi Kursus -->
                <div class="mt-4">
                    <h3 class="text-base sm:text-xl font-bold leading-tight text-gray-900 mb-2">
                        {{ $kursus['judul'] }}
                    </h3>

                    <div class="space-y-2"> 
                        <!-- Rating -->
                        <div class="flex space-x-2">
                            <strong class="text-sm text-gray-900">Rating:</strong>
                            <p class="text-sm">{{ $kursus['avg_rating'] }}</p>
                        </div>

                        <!-- Pengalaman Pelatih -->
                        <div class="flex space-x-2">
                            <strong class="text-sm text-gray-900">Pengalaman Pelatih:</strong>
                            <p class="text-sm">{{ number_format($kursus['pengalaman_total_pelatih'], 1) }} tahun</p>
                        </div>

                        <!-- Level -->
                        <div class="flex space-x-2">
                            <strong class="text-sm text-gray-900">Level:</strong>
                            <p class="text-sm 
                                @if($kursus['tingkat_kesulitan'] == 'Pemula') text-green-500
                                @elseif($kursus['tingkat_kesulitan'] == 'Menengah') text-yellow-500
                                @elseif($kursus['tingkat_kesulitan'] == 'Lanjutan') text-red-500
                                @else text-gray-500
                                @endif">
                                {{ $kursus['tingkat_kesulitan'] }}
                            </p>
                        </div>

                        <!-- Lokasi -->
                        <div class="flex space-x-2">
                            <strong class="text-sm text-gray-900">Lokasi:</strong>
                            <p class="text-sm">{{ $kursus['lokasi'] }}</p>
                        </div>

                        <!-- Harga -->
                        <div class="flex space-x-2">
                            <strong class="text-lg text-gray-900">Harga:</strong>
                            <p class="text-lg font-bold text-gray-900">Rp{{ number_format($kursus['harga'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end mt-5">
                    <a href="/CoursePage/{{ $kursus['kursus_id'] }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-red-500">Tidak ada rekomendasi yang sesuai dengan kriteria Anda.</p>
        @endif
    </div>
</section>
@endsection
