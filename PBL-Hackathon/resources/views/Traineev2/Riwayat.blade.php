@extends('layouts.main')

@section('Main')

<main>
    <section class="p-3 sm:px-10 lg:px-10 mt-20">
        <h2 class="my-2 font-bold text-xl sm:text-3xl text-slate-950">Riwayat Kursus Saya</h2>

        <!-- Kursus Selesai -->
        <div class="mb-16 mt-8 space-y-4">
            <!-- Card 1 -->
            @foreach ($riwayat as $item)
            <div class="ticket-card bg-white rounded-lg shadow-sm p-6 border-l-4 border-secondary border-ButtonBase">
                <div class="grid grid-cols-1 md:grid-cols-6 md:items-start md:justify-between">
                    <div class=" col-span-5">
                        <div class="flex items-start">
                            <img src="{{ $item->kursus->thumbnail ? asset('storage/' . $item->kursus->thumbnail) : asset('image/Thumnnail.jpg') }}"
                                alt="Course"
                                class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                            <div class="ml-4">
                                <div class="flex items-center flex-wrap">
                                    <h3 class="font-bold text-dark mr-2">{{ $item->kursus->judul }}</h3>
                                    @if (empty($item->rating))
                                    <span class="bg-secondary text-sky-500 text-xs px-2 py-0.5 rounded">Anda belum memberikan ulasan</span>
                                    @endif
                                </div>
                                <div class="mt-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <p class="text-xs text-gray-800">Tanggal Pendaftaran</p>
                                        <p class="text-sm font-medium">{{ \Carbon\Carbon::parse($item->tgl_pendaftaran)->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-800">Status</p>
                                        <p class="text-sm font-medium">{{ $item->status_pendaftaran }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-800">Lokasi</p>
                                        <p class="text-sm font-medium">{{ $item->kursus->lokasi ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 flex flex-col md:items-end space-y-2">
                        <p class="text-lg font-bold text-dark">Rp {{ number_format($item->kursus->harga ?? 0, 0, ',', '.') }}</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('DetailRiwayat', $item->pendaftaran_id) }}" class="bg-primary text-white bg-ButtonBase hover:bg-HoverGlow px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </section>
</main>

@endsection