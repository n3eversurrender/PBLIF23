@extends('layouts.mainPelatih')

@section('MainPelatih')

<div class="lg:flex gap-4">
    <div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between mb-3">
            <div class="flex items-center">
                <div class="flex justify-center items-center">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Kursus Punya Kamu</h5>
                    <!-- SVG Tooltip Icon -->
                    <svg data-popover-target="chart-info" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                    </svg>
                    <!-- Tooltip Content -->
                    <div id="chart-info" role="tooltip" class="absolute z-10 hidden inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Informasi Kursus Kamu</h3>
                            <p>Bagian ini menampilkan perkembangan kursus yang kamu miliki. Dengan informasi ini, kamu bisa memantau aktivitas dan partisipasi peserta dalam kursus secara berkala.</p>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
            <div class="grid grid-cols-2 gap-3 mb-2">
                <!-- Tidak Aktif -->
                <dl class="bg-orange-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-orange-100 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $kursusTidakAktif }}
                    </dt>
                    <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Tidak Aktif</dd>
                </dl>

                <!-- Aktif -->
                <dl class="bg-teal-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-teal-100 dark:bg-gray-500 text-teal-600 dark:text-teal-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $kursusAktif->total() }}
                    </dt>
                    <dd class="text-teal-600 dark:text-teal-300 text-sm font-medium">Aktif tes</dd>
                </dl>
            </div>
        </div>
    </div>

    <!-- Total Peserta Aktif -->
    <div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between mb-3">
            <div class="flex items-center">
                <div class="flex justify-center items-center">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Total Pendaftar</h5>
                    <!-- SVG Tooltip Icon -->
                    <svg data-popover-target="participant-info" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                    </svg>
                    <!-- Tooltip Content -->
                    <div id="participant-info" role="tooltip" class="absolute z-10 hidden inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Total Peserta Aktif</h3>
                            <p>Ini adalah jumlah peserta yang telah terdaftar dalam kursus kamu dan berstatus aktif. Kamu dapat memantau partisipasi mereka dalam kursus.</p>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
            <div class="grid grid-cols-3 gap-3 mb-2">
                <!-- Status Menunggu -->
                <dl class="bg-orange-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-orange-100 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $menunggu }}
                    </dt>
                    <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Menunggu</dd>
                </dl>

                <!-- Status Aktif -->
                <dl class="bg-teal-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-teal-100 dark:bg-gray-500 text-teal-600 dark:text-teal-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $aktif }}
                    </dt>
                    <dd class="text-teal-600 dark:text-teal-300 text-sm font-medium">Aktif</dd>
                </dl>

                <!-- Status Selesai -->
                <dl class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-blue-100 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $selesai }}
                    </dt>
                    <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Selesai</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between mb-3">
            <div class="flex items-center">
                <div class="flex justify-center items-center">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Rata-rata Penilaian</h5>
                    <!-- SVG Tooltip Icon -->
                    <svg data-popover-target="chart-info" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                    </svg>
                    <!-- Tooltip Content -->
                    <div id="chart-info" role="tooltip" class="absolute z-10 hidden inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Informasi Penilaian Kamu</h3>
                            <p>Bagian ini menampilkan perkembangan kursus yang kamu miliki. Dengan informasi ini, kamu bisa memantau aktivitas dan partisipasi peserta dalam kursus secara berkala.</p>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
            <div class="grid grid-cols-2 gap-3 mb-2">
                <!-- Rating Kursus -->
                <dl class="bg-orange-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-orange-100 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $ratingKursus ? number_format($ratingKursus, 1) : '0' }} <!-- Menampilkan rata-rata rating kursus -->
                    </dt>
                    <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Rating Kursus</dd>
                </dl>

                <!-- Rating Pelatih -->
                <dl class="bg-teal-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-teal-100 dark:bg-gray-500 text-teal-600 dark:text-teal-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $ratingPelatih ? number_format($ratingPelatih, 1) : '0' }} <!-- Menampilkan rata-rata rating pelatih -->
                    </dt>
                    <dd class="text-teal-600 dark:text-teal-300 text-sm font-medium">Rating Pelatih</dd>
                </dl>
            </div>
        </div>
    </div>

</div>

<div class="mt-5">
    @foreach($kursusRandom as $kursus)
    <div class="bg-white border border-gray-200 rounded-lg shadow-md">
        <div class="sm:flex">
            <img class="sm:w-1/3 aspect-video h-auto object-cover rounded-l-lg" src="{{ $kursus->foto_kursus ? asset('storage/' . $kursus->foto_kursus) : asset('image/Thumnnail.jpg') }}" alt="Course Image" />
            <div class="p-4 flex-grow">
                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900">
                    {{ $kursus->judul }}
                </h5>
                <p class="mb-3 text-xs text-gray-700">
                    {{ $kursus->jumlah_pendaftar }} Peserta sudah mengikuti
                </p>
                <p class="mb-3 text-sm text-gray-700 flex items-center">
                    <!-- Ikon Rating -->
                    <svg class="w-5 h-5 mr-2 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path fill="#FFD43B" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                    </svg>
                    <!-- Rata-rata Rating -->
                    <span class="font-semibold">
                        {{ $kursus->rating_avg ? number_format($kursus->rating_avg, 1) : '0' }} <!-- Menampilkan rata-rata rating kursus -->
                    </span>
                </p>

                <p class="mb-2 text-sm text-gray-600">
                    {{ Str::limit($kursus->deskripsi, 100, '...') }}
                </p>
                <div class="flex items-center justify-between mb-4">
                    <p class="text-lg font-semibold">Rp. {{ number_format($kursus->harga, 0, ',', '.') }}</p>
                </div>
                <td class="px-6 py-4">
                    <a href="{{ route('pengelolaanPelatihanDetail.show', $kursus->kursus_id) }}" class="text-blue-600 dark:text-blue-500">
                        <i class="fas fa-info-circle cursor-pointer me-2"></i>More Info
                    </a>
                </td>
            </div>
        </div>
    </div>
    @endforeach
</div>


<script>
    // Tooltip Show/Hide logic
    document.querySelectorAll('[data-popover-target]').forEach(item => {
        item.addEventListener('mouseenter', function() {
            const targetId = this.getAttribute('data-popover-target');
            const tooltip = document.getElementById(targetId);
            tooltip.classList.remove('hidden');
            tooltip.classList.add('opacity-100');
        });

        item.addEventListener('mouseleave', function() {
            const targetId = this.getAttribute('data-popover-target');
            const tooltip = document.getElementById(targetId);
            tooltip.classList.remove('opacity-100');
            tooltip.classList.add('hidden');
        });
    });
</script>

@endsection