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
                    @elseif(Auth::user()->peran === 'Perusahaan')
                        <div class="mt-4">
                            <p class="text-gray-500 text-sm">Kamu Adalah Seorang <strong>Perusahaan</strong></p>
                        </div>
                    @endif
                @else
                    <div class="mt-4 text-sm">
                        <p class="text-red-500">Silakan <a href="{{ route('login') }}" class="text-blue-500 underline">login</a>
                            untuk mulai belajar.</p>
                    </div>
                @endauth
            </div>
        </div>

        <!-- content 2 -->
        <div class="col-span-2 text-wrap pr-5 pl-8">
            <div class="lg:py-6 py-4 text-sm lg:text-lg text-gray-500">
                <P>KURSUS DITERBITKAN OLEH <b>{{ $kursus->pengguna ? $kursus->pengguna->nama : 'Nama Tidak Ditemukan' }}</b>
                </P>
                <p class="text-sm">{!! $kursus->deskripsi !!}</p>
            </div>
            <!-- course modul -->
            <div class="w-full max-w-4xl mx-auto rounded-lg">
                <div class="cursor-default p-3 lg:p-4 text-lg lg:text-xl font-bold text-gray-700">
                    <h1>Jadwal Kursus</h1>
                </div>
                <table class="w-full cursor-default">
                    <thead class="bg-gray-200 rounded-lg text-xs sm:text-sm">
                        <tr>
                            <th class="py-3 px-4 text-left font-semibold text-primary">Sesi</th>
                            <th class="py-3 px-4 text-left font-semibold text-primary">Tanggal</th>
                            <th class="py-3 px-4 text-left font-semibold text-primary">Waktu</th>
                            <th class="py-3 px-4 text-left font-semibold text-primary">Lokasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-[10px] sm:text-sm">
                        @forelse($kursus->jadwalKursus as $jadwal)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-4 font-medium">{{ $jadwal->sesi }}</td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('g:i A') }} -
                                        {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('g:i A') }}
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        {{ $jadwal->lokasi }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 py-4">Belum ada jadwal untuk kursus ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>




                <style>
                    input:checked+label+div {
                        display: block;
                    }
                </style>
            </div>
    </section>


    <section class="mx-4 sm:mx-8 lg:mx-16 my-12">
        <div class="mb-4 text-sm text-gray-600 text-center">
            Menampilkan {{ $ratings->count() }} ulasan dari total {{ $kursus->ratingKursus()->count() }}
            ulasan
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse ($ratings as $rating)
                <div class="bg-gray-50 md:p-4 p-2 rounded-lg text-xs md:text-sm text-center">
                    <div class="flex flex-col items-center text-amber-400 mb-2">
                        <div class="flex space-x-1">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($rating->rating >= $i)
                                    <i class="fas fa-star"></i>
                                @elseif ($rating->rating >= $i - 0.5)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-gray-700 mt-1">{{ number_format($rating->rating, 1) }}/5</span>
                    </div>
                    <p class="font-medium italic">"{{ $rating->komentar ?? 'Tidak ada komentar.' }}"</p>
                    <p class="text-sm text-gray-500 mt-1">
                        Ulasan dari {{ $rating->pengguna->nama ?? 'Anonim' }} pada {{ $rating->created_at->format('d M Y') }}
                    </p>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-500">Belum ada ulasan untuk kursus ini.</div>
            @endforelse
        </div>
    </section>


    <!-- review end -->

    <section class="p-3">
        <div class="sm:mb-0 my-3">
            <div class="bg-gwhite text-center py-4">
                <div class="px-3 sm:px-10 pt-5 pb-20">
                    <div class="text-left ps-2 sm:ps-5">
                        <h2 class="my-2 font-bold text-xl sm:text-3xl text-slate-950">Kursus Unggulan</h2>
                        <p class="mb-5 text-gray-700">Tingkatkan kemampuan dengan kursus pilihan terbaik untuk Anda.</p>
                    </div>
                    <!-- Grid Container -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($relatedCourses as $k)
                            <div
                                class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                                <div class="relative cursor-default">
                                    <img class="w-full h-36 sm:h-36 lg:h-40 xl:h-44 object-cover"
                                        src="{{ $k->foto_kursus ? asset('storage/' . $k->foto_kursus) : asset('image/Thumnnail.jpg') }}"
                                        alt="Thumbnail {{ $k->judul }}">
                                    <div
                                        class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                        {{ ucfirst($k->tingkat_kesulitan) ?? 'Umum' }}
                                    </div>
                                </div>

                                <div class="p-4 xl:p-6">
                                    <div class="flex justify-between items-start mb-2 cursor-default">
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                            {{ $k->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                        </span>
                                        <div class="flex items-center">
                                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                                            <span class="text-gray-700 text-sm font-medium ml-1">
                                                {{ number_format($k->rating_kursus_avg_rating ?? 0, 1) }}
                                            </span>
                                            <span class="text-gray-400 text-sm ml-1">
                                                ({{ $k->rating_kursus_count ?? 0 }})
                                            </span>

                                        </div>
                                    </div>

                                    <div class="w-full text-left">
                                        <a href="/CoursePage/{{ $k->kursus_id }}"
                                            class="lg:text-lg text-md font-bold text-gray-800 mb-1 line-clamp-2 text-left hover:text-HoverGlow active:text-ButtonBase">
                                            {{ $k->judul }}
                                        </a>
                                        <p class="text-gray-500 text-xs mb-4 line-clamp-2 text-left cursor-default">
                                            {{ Str::limit(strip_tags($k->deskripsi), 60) }}
                                        </p>
                                    </div>

                                    <div class="flex items-center justify-between cursor-default">
                                        <div class="flex items-center">
                                            <img class="w-8 h-8 rounded-full"
                                                src="{{ $k->foto_pengajar ? asset('storage/' . $k->foto_pengajar) : asset('image/Thumnnail.jpg') }}"
                                                alt="Instruktur">
                                            <div class="ml-2">
                                                <p class="lg:text-sm text-xs font-medium text-gray-700">
                                                    {{ $k->pengguna->nama ?? 'Instruktur' }}</p>
                                                <p class="text-[6px] sm:text-[10px] lg:text-[11px] text-gray-500">Instruktur</p>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <p class="text-ButtonBase font-bold text-base lg:text-lg">
                                                Rp. {{ number_format($k->harga, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.4.1/dist/flowbite.min.js"></script>

    <!-- content -->

@endsection
