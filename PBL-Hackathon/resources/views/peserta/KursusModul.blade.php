@extends('layouts.mainPeserta')

@section('MainPeserta')

@include('partials.breadcrumbKursus')

<div>
    <div id="accordion-collapse" data-accordion="collapse" class="mt-5">
        @if($kurikulum->isEmpty())
        <p class="text-center text-gray-500 dark:text-gray-400">Tidak ada modul yang tersedia.</p>
        @else
        @foreach($kurikulum as $modul)
        <h2 id="accordion-collapse-heading-{{ $modul->kurikulum_id }}">
            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-{{ $modul->kurikulum_id }}" aria-expanded="false" aria-controls="accordion-collapse-body-{{ $modul->kurikulum_id }}">
                <span>{{ $modul->nama_topik }}</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-{{ $modul->kurikulum_id }}" class="hidden" aria-labelledby="accordion-collapse-heading-{{ $modul->kurikulum_id }}">
            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                <div class="flex flex-col md:flex-row items-start gap-4">
                    <!-- Pemutar video YouTube atau pesan alternatif -->
                    @if($modul->materi)
                    <div class="mt-4 md:mt-0 flex-shrink-0">
                        <iframe width="560" height="315" src="{{ $modul->materi }}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                    @else
                    <div class="mt-4 text-gray-500 dark:text-gray-400 flex-shrink-0">
                        Video tidak tersedia
                    </div>
                    @endif

                    <!-- Deskripsi di sebelah kanan video -->
                    <div class="flex-1">
                        <p>{{ $modul->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>

@endsection
