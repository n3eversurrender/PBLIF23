@extends('layouts.NavAndFoot')

@section('NavAndFoot')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@vite(['resources/js/home.js'])

<!-- content -->
<section class="sm:grid sm:grid-cols-3 gap-4 mt-24 sm:pr-8 pr-4">
  <div class=" pl-4 sm:pl-8 mb-10 sm:mb-0">
    <div class="rounded-lg border border-gray-200 bg-gray-100 px-4 py-6 shadow-sm ">
      <!-- Gambar -->
      <div class="object-cover aspect-video">
        <img class="w-full rounded-lg h-full hover:brightness-50 object-cover"
          src="{{ $kursus->foto_kursus ? asset('storage/' . $kursus->foto_kursus) : asset('image/Thumnnail.jpg') }}"
          alt="{{ $kursus->judul }}" />
      </div>

      <!-- Informasi -->
      <div class="mt-4">
        <h2 class="text-lg lg:text-2xl font-bold">{{ $kursus->judul }}</h2>
        <div class="mt-4 text-sm text-gray-500">
          <p>
            <span>Jadwal:
              {{ \Carbon\Carbon::parse($kursus->tgl_mulai)->format('d M Y') }}
              <strong>s/d</strong>
              {{ \Carbon\Carbon::parse($kursus->tgl_selesai)->format('d M Y') }}
            </span>
          </p>
          <p>
            Durasi:
            @php
            $start = \Carbon\Carbon::parse($kursus->tgl_mulai);
            $end = \Carbon\Carbon::parse($kursus->tgl_selesai);
            $diff = $start->diff($end);

            // Format deskripsi durasi
            $durasi = [];
            if ($diff->m > 0) {
            $durasi[] = $diff->m . ' bulan';
            }
            if ($diff->d > 0) {
            $durasi[] = $diff->d . ' hari';
            }

            echo implode(' ', $durasi);
            @endphp
          </p>

          <p><span>Lokasi: {{ $kursus->lokasi }}</span></p>
          <p>Kapasitas tersisa: {{ $kursus->kapasitas - $kursus->pendaftaran->count() }}</p>

        </div>

        <p class="lg:text-xl text-base font-bold mt-4">Rp.{{ number_format($kursus->harga, 0, ',', '.') }}</p>
      </div>

      <!-- Tombol Aksi -->
      @auth
      @if (Auth::user()->peran === 'Peserta')
      @php
      $pendaftaranSebelumnya = \App\Models\Pendaftaran::where('pengguna_id', Auth::id())
      ->where('kursus_id', $kursus->kursus_id)
      ->where('status_pendaftaran', '!=', 'Selesai')
      ->exists();
      @endphp

      @if ($pendaftaranSebelumnya)
      <div class="mt-4">
        <p class="text-gray-500 text-sm">Anda sudah terdaftar di kursus ini dan belum menyelesaikannya.</p>
      </div>
      @else
      <form action="/DaftarPendaftaran" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="kursus_id" value="{{ $kursus->kursus_id }}">
        <input type="hidden" name="tgl_pendaftaran" value="{{ now()->toDateString() }}">

        @php
        $pendaftaranSebelumnya = \App\Models\Pendaftaran::where('pengguna_id', auth()->id())
        ->where('kursus_id', $kursus->kursus_id)
        ->where('status_pendaftaran', '!=', 'Selesai')
        ->exists();
        $kursusPenuh = $kursus->pendaftaran->count() >= $kursus->kapasitas;
        @endphp

        @if ($pendaftaranSebelumnya)
        <p class="text-gray-500">Anda sudah terdaftar di kursus ini dan belum menyelesaikannya.</p>
        @elseif ($kursusPenuh)
        <p class="text-red-500">Kapasitas kursus telah penuh.</p>
        @else
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg">
          Mulai Belajar
        </button>
        @endif
      </form>
      @endif
      @elseif(Auth::user()->peran === 'Pelatih')
      <div class="mt-4">
        <p class="text-gray-500 text-sm">Kamu Adalah Seorang <strong>Pelatih</strong></p>
      </div>
      @endif
      @else
      <div class="mt-4 text-sm">
        <p class="text-red-500">Silakan <a href="{{ route('login') }}" class="text-blue-500 underline">login</a> untuk mulai belajar.</p>
      </div>
      @endauth
    </div>
  </div>

  <!-- content 2 -->
  <div class="col-span-2 text-wrap pr-5 pl-8">
    <div class="lg:py-6 py-4 text-sm lg:text-lg text-gray-500">
      <P>KURSUS DITERBITKAN OLEH <b>{{ $kursus->pengguna ? $kursus->pengguna->nama : 'Nama Tidak Ditemukan' }}</b></P>
      <p class="text-sm">{{ $kursus->deskripsi }}</p>
    </div>
    <!-- course modul -->
    <div class="w-full max-w-4xl mx-auto border border-gray-300 rounded-lg">
      <div class="cursor-default p-3 lg:p-4 text-lg lg:text-xl font-bold text-gray-700 bg-gray-100 border-b border-gray-300">
        <h1>Modul Kursus</h1>
      </div>

      <!-- Module 1 -->
      <div class="border-b border-gray-200 ">
        <div id="accordion-collapse" class="mt-5">
          @if($kursus->kurikulum->isEmpty()) <!-- Check if kurikulum is empty -->
          <p class="text-center text-gray-500 dark:text-gray-400">Tidak ada modul yang tersedia.</p>
          @else
          @foreach($kursus->kurikulum as $kurikulum) <!-- Loop through kurikulums -->
          <h2 id="accordion-collapse-heading-{{ $kurikulum->kurikulum_id }}">
            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-{{ $kurikulum->kurikulum_id }}" aria-expanded="false" aria-controls="accordion-collapse-body-{{ $kurikulum->kurikulum_id }}">
              <span class="text-left">{{ $kurikulum->nama_topik }}</span>
              <i id="lock-icon-closed-{{ $kurikulum->kurikulum_id }}" class="fas fa-lock text-gray-500 dark:text-gray-400"></i>
            </button>
          </h2>
          <div id="accordion-collapse-body-{{ $kurikulum->kurikulum_id }}" class="hidden" aria-labelledby="accordion-collapse-heading-{{ $kurikulum->kurikulum_id }}">
            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
              <div class="flex flex-col md:flex-row items-start gap-4">
                <!-- Pemutar video YouTube atau pesan alternatif -->
                @if($kurikulum->materi)
                <div class="mt-4 md:mt-0 flex-shrink-0">
                  <iframe width="560" height="315" src="{{ $kurikulum->materi }}"
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
                  <p>{{ $kurikulum->deskripsi }}</p>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>


      <style>
        input:checked+label+div {
          display: block;
        }
      </style>
    </div>
</section>


<!-- review start -->
<div class="mt-16 py-14 bg-gray-100">
  <div class="flex flex-wrap justify-center gap-3 h-auto">
    <!-- Loop through the limited ratings for this kursus -->
    @foreach ($ratings as $rating)
    <article class="w-72 h-72 px-10 py-5 mb-2 bg-white rounded-lg shadow-md">

      <!-- User info section -->
      <div class="flex items-center mb-4">
        <img class="w-10 h-10 me-4 rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
        <div class="font-medium dark:text-white text-xs sm:text-sm">
          <h4 class="h-5 overflow-hidden">{{ $rating->pengguna->nama }}</h4>
          <p>
            <time datetime="2014-08-16 19:00" class="block text-sm text-gray-500 dark:text-gray-400">
              Joined on {{ optional($rating->pengguna->created_at)->format('F Y') ?? 'Date not available' }}
            </time>
          </p>
        </div>
      </div>

      <!-- Rating stars -->
      <div class="flex items-center mb-1 space-x-1 rtl:space-x-reverse">
        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
          <path fill="#FFD43B" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
        </svg>
        <p class="text-xs">{{ $rating->rating }} <span class="ml-2 text-xs  text-TeksSecond">Rate</span></p>
      </div>

      <!-- Comment section -->
      <p class="my-3 text-TeksSecond dark:text-gray-400 text-xs sm:text-sm">
        {{ $rating->komentar ?? 'No comment provided.' }}
      </p>
    </article>
    @endforeach
  </div>

  <!-- Menampilkan pagination -->
  <div class="flex flex-col items-center">
    <span class="text-sm text-gray-700 dark:text-gray-400">
      Showing
      <span class="font-semibold text-gray-900 dark:text-white">{{ $ratings->firstItem() }}</span>
      to
      <span class="font-semibold text-gray-900 dark:text-white">{{ $ratings->lastItem() }}</span>
      of
      <span class="font-semibold text-gray-900 dark:text-white">{{ $ratings->total() }}</span>
      Entries
    </span>

    <!-- Pagination controls -->
    <div class="inline-flex mt-2 xs:mt-0">
      <!-- Prev Button -->
      @if ($ratings->onFirstPage())
      <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-500 cursor-not-allowed rounded-s">
        <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
        </svg>
        Prev
      </button>
      @else
      <a href="{{ $ratings->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900">
        <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
        </svg>
        Prev
      </a>
      @endif

      <!-- Next Button -->
      @if ($ratings->hasMorePages())
      <a href="{{ $ratings->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-e hover:bg-gray-900">
        Next
        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
        </svg>
      </a>
      @else
      <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-500 cursor-not-allowed rounded-e">
        Next
        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
        </svg>
      </button>
      @endif
    </div>
  </div>
</div>


<!-- review end -->

<!-- cards featured courses -->
<section class=" mx-4 sm:mx-8 lg:mx-16 sm:my-24 my-12">
  <h1 class="font-bold text-xl sm:text-3xl mb-3 sm:mb-6">Kursus Unggulan</h1>
  <!-- Cards Start -->
  <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-4">
    @foreach ($relatedCourses as $related)
    <div class="rounded-lg border border-gray-200 bg-gray-100 p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
      <div class="object-cover aspect-video">
        <img class="w-full rounded-lg h-full aspect-video object-cover" src="{{ $related->foto_kursus ? asset('storage/' . $related->foto_kursus) : asset('image/Thumnnail.jpg') }}" alt="{{ $related->judul }}" />
      </div>

      <!-- Penjelasan -->
      <div class="pt-2 cursor-default">
        <p class="text-lg h-11 overflow-hidden font-bold leading-tight text-gray-900 my-2 text-balance">
          {{ $related->judul }}
        </p>
        <p class="text-sm h-24 overflow-hidden pt-2 mb-3 text-TeksSecond">
          {{ Str::limit($related->deskripsi, 100) }}
        </p>
        <a href="/CoursePage/{{ $related->kursus_id }}" class="bg-ButtonBase hover:bg-HoverGlow transition duration-700 text-xs sm:text-sm text-white  p-2 rounded-lg w-full text-center block">Dapatkan sekarang</a>
      </div>
    </div>
    @endforeach
  </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/flowbite@1.4.1/dist/flowbite.min.js"></script>

<!-- content -->

@endsection