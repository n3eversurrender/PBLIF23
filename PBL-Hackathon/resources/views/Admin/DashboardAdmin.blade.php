@extends('layouts.mainAdmin')

@section('MainAdmin')


<div class="flex justify-between gap-2">
    <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between mb-3">
            <div class="flex items-center">
                <div class="flex justify-center items-center">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Pengguna Aplikasi</h5>
                    <svg data-popover-target="chart-info" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                    </svg>
                    <div data-popover id="chart-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <!-- Judul Popover -->
                            <h3 class="font-semibold text-gray-900 dark:text-white">Informasi Pengguna Aplikasi</h3>
                            <!-- Konten Popover -->
                            <p>Laporan ini membantu memantau pertumbuhan jumlah pengguna aplikasi. Tren pertumbuhan yang stabil atau meningkat menunjukkan keberhasilan dalam menarik lebih banyak pengguna.</p>
                            <h3 class="font-semibold text-gray-900 dark:text-white">Perhitungan</h3>
                            <p>Jumlah pengguna dihitung berdasarkan data aktivitas pengguna secara kumulatif. Setiap periode menunjukkan total pengguna hingga periode tersebut, termasuk pengguna baru yang bergabung.</p>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
            <div class="grid grid-cols-3 gap-3 mb-2">
                <!-- Total Pengguna -->
                <dl class="bg-orange-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-orange-100 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $totalPengguna }}
                    </dt>
                    <dd class="text-orange-600 dark:text-orange-300 text-xs font-medium">Total Pengguna</dd>
                </dl>

                <!-- Total Pelatih -->
                <dl class="bg-teal-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-teal-100 dark:bg-gray-500 text-teal-600 dark:text-teal-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $totalPelatih }}
                    </dt>
                    <dd class="text-teal-600 dark:text-teal-300 text-xs font-medium">Total Pelatih</dd>
                </dl>

                <!-- Total Peserta -->
                <dl class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-blue-100 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $totalPeserta }}
                    </dt>
                    <dd class="text-blue-600 dark:text-blue-300 text-xs font-medium">Total Peserta</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between mb-3">
            <div class="flex items-center">
                <div class="flex justify-center items-center">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Verifikasi Pelatih</h5>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
            <div class="grid grid-cols-3 gap-3 mb-2">
                <!-- Status Menunggu -->
                <dl class="bg-yellow-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-yellow-100 dark:bg-gray-500 text-yellow-600 dark:text-yellow-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $verifikasiMenunggu }}
                    </dt>
                    <dd class="text-yellow-600 dark:text-yellow-300 text-xs font-medium">Menunggu</dd>
                </dl>

                <!-- Status Disetujui -->
                <dl class="bg-green-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-green-100 dark:bg-gray-500 text-green-600 dark:text-green-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $verifikasiDisetujui }}
                    </dt>
                    <dd class="text-green-600 dark:text-green-300 text-xs font-medium">Disetujui</dd>
                </dl>

                <!-- Status Ditolak -->
                <dl class="bg-red-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-red-100 dark:bg-gray-500 text-red-600 dark:text-red-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $verifikasiDitolak }}
                    </dt>
                    <dd class="text-red-600 dark:text-red-300 text-xs font-medium">Ditolak</dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between mb-3">
            <div class="flex items-center">
                <div class="flex justify-between items-center">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Pelatih Aktif</h5>
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1 ml-8">Peserta Aktif</h5>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
            <div class="grid grid-cols-4 gap-3 mb-2">
                <!-- Pelatih Aktif -->
                <dl class="bg-green-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-green-100 dark:bg-gray-500 text-green-600 dark:text-green-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $totalPelatihAktif }}
                    </dt>
                    <dd class="text-green-600 dark:text-green-300 text-xs font-medium">Aktif</dd>
                </dl>

                <!-- Pelatih Tidak Aktif -->
                <dl class="bg-red-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-red-100 dark:bg-gray-500 text-red-600 dark:text-red-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $totalPelatihTidakAktif }}
                    </dt>
                    <dd class="text-red-600 dark:text-red-300 text-xs font-medium">Tidak Aktif</dd>
                </dl>

                <!-- Peserta Aktif -->
                <dl class="bg-green-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-green-100 dark:bg-gray-500 text-green-600 dark:text-green-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $totalPesertaAktif }}
                    </dt>
                    <dd class="text-green-600 dark:text-green-300 text-xs font-medium">Aktif</dd>
                </dl>

                <!-- Peserta Tidak Aktif -->
                <dl class="bg-red-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-red-100 dark:bg-gray-500 text-red-600 dark:text-red-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $totalPesertaTidakAktif }}
                    </dt>
                    <dd class="text-red-600 dark:text-red-300 text-xs font-medium">Tidak Aktif</dd>
                </dl>
            </div>
        </div>
    </div>

</div>


<div class="grid grid-cols-2 gap-4">
    <!-- Card 1: Total Pemasukan -->
    <div class="bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 mt-5">
        <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">
            <dl>
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Total Pemasukan</dt>
                <dd class="leading-none text-2xl font-bold text-gray-900 dark:text-white">
                    Rp {{ number_format($totalPembayaran, 0, ',', '.') }}
                </dd>
            </dl>
            <div>
                <span class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                    @if ($growth > 0)
                    <span class="text-green-500">Profit rate {{ number_format($growth, 2) }}%</span>
                    @elseif ($growth < 0)
                        <span class="text-red-500">Profit rate {{ number_format(abs($growth), 2) }}%</span>
                @else
                <span class="text-gray-500">Profit rate 0%</span>
                @endif
                </span>
            </div>
        </div>

        <div class="grid grid-cols-2 py-3">
            <dl>
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Pemasukan Kemarin</dt>
                <dd class="leading-none text-xl font-bold text-green-500 dark:text-green-400">
                    Rp {{ number_format($totalPemasukanKemarin, 0, ',', '.') }}
                </dd>
            </dl>
            <dl>
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Pemasukan Sekarang</dt>
                <dd class="leading-none text-xl font-bold text-green-500 dark:text-green-400">
                    Rp {{ number_format($totalPemasukanHariIni, 0, ',', '.') }}
                </dd>
            </dl>
        </div>
    </div>

    <!-- Card 2: Total Kursus -->
    <div class="bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 mt-5">
        <div class="flex justify-between mb-3">
            <div class="flex items-center">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Total Kursus</h5>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
            <div class="grid grid-cols-3 gap-3 mb-2">
                <!-- Total Kursus -->
                <dl class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-blue-100 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $totalKursus }}
                    </dt>
                    <dd class="text-blue-600 dark:text-blue-300 text-xs font-medium">Total</dd>
                </dl>

                <!-- Kursus Aktif -->
                <dl class="bg-green-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-green-100 dark:bg-gray-500 text-green-600 dark:text-green-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $totalKursusAktif }}
                    </dt>
                    <dd class="text-green-600 dark:text-green-300 text-xs font-medium">Aktif</dd>
                </dl>

                <!-- Kursus Tidak Aktif -->
                <dl class="bg-red-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-red-100 dark:bg-gray-500 text-red-600 dark:text-red-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $totalKursusTidakAktif }}
                    </dt>
                    <dd class="text-red-600 dark:text-red-300 text-xs font-medium">Tidak Aktif</dd>
                </dl>
            </div>
        </div>
    </div>
</div>

@endsection