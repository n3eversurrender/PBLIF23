@extends('layouts.mainPeserta')

@section('MainPeserta')

@include('partials.breadcrumbKursus')

@foreach($pendaftaran as $pendaftaranItem)
<div class="w-full bg-white border border-gray-300 rounded-xl shadow-md overflow-hidden mt-5">
    <div class="md:flex">
        <div class="md:shrink-0">
            <img class="h-48 w-full object-cover md:h-full md:w-48 border-r border-gray-300"
                src="{{ $pendaftaranItem->kursus->foto_kursus ? asset('image/' . $pendaftaranItem->kursus->foto_kursus) : asset('image/Thumnnail.jpg') }}"
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
                    <a href="{{ route('kursusModul.show', $pendaftaranItem->kursus->kursus_id) }}" class="text-white">Continue Learning</a>
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Pagination -->
<div class="flex justify-center items-center mt-5">
    <ul class="inline-flex -space-x-px text-sm">
        <li>
            <a href="{{ $pendaftaran->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Sebelumnya
            </a>
        </li>
        <li>
            <a href="{{ $pendaftaran->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Berikutnya
            </a>
        </li>
    </ul>
</div>

<!-- Menampilkan informasi data -->
<div class="mt-4 mb-5 text-center text-sm text-gray-600 dark:text-gray-400">
    Menampilkan {{ $pendaftaran->firstItem() }} sampai {{ $pendaftaran->lastItem() }} dari {{ $pendaftaran->total() }} entri
</div>

@endsection
