@extends('layouts.mainAdmin')

@section('MainAdmin')


<div class="flex justify-between gap-2">
    <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between mb-3">
            <div class="flex items-center">
                <div class="flex justify-center items-center">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Pengguna Aplikasi</h5>
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

                <!-- Total Perusahaan -->
                <dl class="bg-teal-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-teal-100 dark:bg-gray-500 text-teal-600 dark:text-teal-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $totalPelatih }}
                    </dt>
                    <dd class="text-teal-600 dark:text-teal-300 text-xs font-medium">Total Perusahaan</dd>
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
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Verifikasi Perusahaan</h5>
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
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Perusahaan Aktif</h5>
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1 ml-8">Peserta Aktif</h5>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
            <div class="grid grid-cols-4 gap-3 mb-2">
                <!-- Perusahaan Aktif -->
                <dl class="bg-green-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                    <dt class="w-8 h-8 rounded-full bg-green-100 dark:bg-gray-500 text-green-600 dark:text-green-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $totalPelatihAktif }}
                    </dt>
                    <dd class="text-green-600 dark:text-green-300 text-xs font-medium">Aktif</dd>
                </dl>

                <!-- Perusahaan Tidak Aktif -->
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