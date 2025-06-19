@extends('layouts.main')

@section('Main')
<section class="bg-white mt-14">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Hasil Rekomendasi</h2>

        @if(isset($data['rekomendasi']) && count($data['rekomendasi']) > 0)
        <div class="grid gap-3 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
            @foreach ($data['rekomendasi'] as $kursus)
            <div class="relative bg-white rounded-lg shadow-lg overflow-hidden transition duration-300 hover:shadow-2xl hover:border-blue-400 hover:border hover:-translate-y-1">
                <!-- Gambar dengan hover zoom -->
                <div class="relative">
                    <img class="w-full h-28 object-cover transition-transform duration-300 hover:scale-105"
                        src="{{ $kursus['foto_kursus'] ? asset('storage/' . $kursus['foto_kursus']) : asset('image/Thumnnail.jpg') }}"
                        alt="{{ $kursus['judul'] }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>

                    <!-- Badge level -->
                    <div class="absolute top-2 left-2">
                        <p class="text-xs font-semibold text-white px-2 py-0.5 rounded-full
                            @if($kursus['tingkat_kesulitan'] == 'Pemula') bg-green-600
                            @elseif($kursus['tingkat_kesulitan'] == 'Menengah') bg-yellow-500
                            @elseif($kursus['tingkat_kesulitan'] == 'Lanjutan') bg-red-600
                            @else bg-gray-500
                            @endif">
                            {{ $kursus['tingkat_kesulitan'] }}
                        </p>
                    </div>

                    <!-- Badge rekomendasi -->
                    <div class="absolute top-2 right-2 bg-emerald-600 text-white text-xs font-bold px-2 py-0.5 rounded">
                        Rekomendasi
                    </div>
                </div>

                <!-- Konten -->
                <div class="p-3">
                    <a href="/CoursePage/{{ $kursus['kursus_id'] }}"
                        class="hover:text-HoverGlow active:text-ButtonBase text-sm sm:text-md font-bold text-gray-800 mb-1 line-clamp-2 text-left">
                        {{ $kursus['judul'] }}
                    </a>

                    <p class="text-xs text-gray-500 line-clamp-2 mb-2">{{ $kursus['deskripsi'] ?? '-' }}</p>

                    <div class="flex justify-between items-center mb-1">
                        <!-- Bintang rating -->
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= round($kursus['avg_rating']) ? 'text-yellow-400' : 'text-gray-300' }} text-xs"></i>
                                @endfor
                                <span class="ml-1 text-xs text-gray-700">{{ number_format($kursus['avg_rating'],1) }}/5</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-1">
                        <!-- Lokasi -->
                        <div class="flex items-center text-xs text-gray-700">
                            <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>
                            {{ $kursus['lokasi'] }}
                        </div>

                        <!-- Harga -->
                        <div class="text-right">
                            @if(isset($kursus['harga_asli']) && $kursus['harga_asli'] > $kursus['harga'])
                            <p class="text-[10px] text-gray-400 line-through">Rp{{ number_format($kursus['harga_asli'],0,',','.') }}</p>
                            @endif
                            <p class="bg-green-100 text-green-800 text-xs font-bold px-2 py-0.5 rounded">
                                Rp{{ number_format($kursus['harga'],0,',','.') }}
                            </p>
                        </div>
                    </div>
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