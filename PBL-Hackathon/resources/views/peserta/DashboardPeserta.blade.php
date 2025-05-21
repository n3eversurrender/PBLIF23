@extends('layouts.mainPeserta')

@section('MainPeserta')


<div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
    <!-- <div class="flex mb-3">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white mr-48">Pelatihan Kamu</h5>
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white mr-40">Status Pendaftaran</h5>
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Status Pembayaran</h5>
    </div> -->

    <div class="lg:grid lg:grid-cols-3 gap-3">
        <!-- Total Pelatihan -->
        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
            <h5 class="text-lg sm:text-xl font-bold leading-none text-gray-900 dark:text-white mb-3 sm:mb-5">Pelatihan Kamu</h5>
            <dl class="bg-orange-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                <dt class="w-8 h-8 rounded-full bg-orange-100 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                    {{ $totalPendaftaran }}
                </dt>
                <dd class="text-orange-600 dark:text-orange-300 text-xs font-medium">Total Pelatihan Yang Diikuti</dd>
            </dl>
        </div>

        <!-- Status Pendaftaran -->
        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
        <h5 class="text-lg sm:text-xl font-bold leading-none text-gray-900 dark:text-white mb-3 sm:mb-5">Status Pendaftaran</h5>
            <div class="grid grid-cols-4 gap-3">
                @foreach ($statusPendaftaranCounts as $status => $count)
                @php
                $bgColor = match ($status) {
                'Menunggu' => 'bg-yellow-100 dark:bg-yellow-500 text-yellow-600 dark:text-yellow-300',
                'Aktif' => 'bg-green-100 dark:bg-green-500 text-green-600 dark:text-green-300',
                'Selesai' => 'bg-blue-100 dark:bg-blue-500 text-blue-600 dark:text-blue-300',
                'Dibatalkan' => 'bg-red-100 dark:bg-red-500 text-red-600 dark:text-red-300',
                default => 'bg-gray-100 dark:bg-gray-500 text-gray-600 dark:text-gray-300',
                };
                @endphp
                <dl class="rounded-lg flex flex-col items-center justify-center h-[78px] {{ $bgColor }}">
                    <dt class="w-8 h-8 rounded-full {{ $bgColor }} text-sm font-medium flex items-center justify-center mb-1">
                        {{ $count }}
                    </dt>
                    <dd class="text-xs font-medium">{{ $status }}</dd>
                </dl>
                @endforeach
            </div>
        </div>

        <!-- Status Pembayaran -->
        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
        <h5 class="text-lg sm:text-xl font-bold leading-none text-gray-900 dark:text-white mb-3 sm:mb-5">Status Pembayaran</h5>
            <div class="grid grid-cols-3 gap-3">
                @foreach ($statusPembayaranCounts as $status => $count)
                @php
                $bgColor = match ($status) {
                'Pending' => 'bg-yellow-100 dark:bg-yellow-500 text-yellow-600 dark:text-yellow-300',
                'Berhasil' => 'bg-green-100 dark:bg-green-500 text-green-600 dark:text-green-300',
                'Gagal' => 'bg-red-100 dark:bg-red-500 text-red-600 dark:text-red-300',
                default => 'bg-gray-100 dark:bg-gray-500 text-gray-600 dark:text-gray-300',
                };
                @endphp
                <dl class="rounded-lg flex flex-col items-center justify-center h-[78px] {{ $bgColor }}">
                    <dt class="w-8 h-8 rounded-full {{ $bgColor }} text-sm font-medium flex items-center justify-center mb-1">
                        {{ $count }}
                    </dt>
                    <dd class="text-xs font-medium">{{ $status }}</dd>
                </dl>
                @endforeach
            </div>
        </div>
    </div>
</div>



@foreach($pendaftaran as $pendaftaranItem)
<div class="w-full bg-white border border-gray-300 rounded-xl shadow-md overflow-hidden mt-5">
    <div class="md:flex">
        <div class="md:shrink-0">
            <img class="h-48 w-full object-cover md:h-full md:w-48 border-r border-gray-300"
                src="{{ $pendaftaranItem->kursus->foto_kursus ? asset('storage/' . $pendaftaranItem->kursus->foto_kursus) : asset('image/Thumnnail.jpg') }}"
                alt="Gambar">
        </div>

        <div class="p-8 flex flex-col justify-between w-full">
            <div>
                <div class="uppercase tracking-wide text-lg lg:text-xl font-bold text-gray-800">
                    {{ $pendaftaranItem->kursus->judul }}
                </div>
                <p class="lg:mt-4 mt-2 h-20 sm:h-24 overflow-hidden text-sm lg:text-base text-TeksSecond">
                    {{ $pendaftaranItem->kursus->deskripsi }} 
                </p>
            </div>
            <div class="mt-6 flex items-center justify-between">
                <button type="button"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-ButtonBase hover:bg-HoverGlow transition duration-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-auto">
                    <a href="{{ route('kursusModul.show', $pendaftaranItem->kursus->kursus_id) }}" class="text-white">Lanjut Belajar</a>
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection