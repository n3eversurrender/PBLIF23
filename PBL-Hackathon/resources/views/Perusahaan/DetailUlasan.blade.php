@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')

<main>
    <div class="flex items-center space-x-2 text-sm text-gray-500 pb-6">
        <a href="{{ route('UlasanPerusahaan') }}" class="hover:text-blue-600 transition">Ulasan</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-blue-600 font-medium">Detail Ulasan</span>
    </div>

    <div class="mb-4">
        <h2 class="text-xl font-bold">{{ $kursus->judul }}</h2>
        <p class="text-gray-600">
            Rata-Rata Ulasan:
            <i class="fas fa-star text-yellow-400 text-sm me-1"></i>
            {{ round($ulasan->avg('rating'), 1) }}
            | Total Ulasan:
            {{ $total }}
        </p>
    </div>

    <!-- Distribusi Sentimen -->
    <div class="bg-white shadow rounded p-4 mb-4">
        <h3 class="font-semibold text-lg mb-2">Distribusi Sentimen</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
            <div>
                <p><span class="text-green-600 font-medium">Positif:</span>
                    <span class="text-green-700">{{ $distribusi['positif'] }}% ({{ $positif_count }}/{{ $total }})</span>
                </p>
            </div>
            <div>
                <p><span class="text-red-600 font-medium">Negatif:</span>
                    <span class="text-red-700">{{ $negatif_count }}/{{ $total }} ({{ $distribusi['negatif'] }}%)</span>
                </p>
            </div>
            <div>
                <p><span class="text-yellow-600 font-medium">Netral:</span>
                    <span class="text-yellow-700">{{ $netral_count }}/{{ $total }} ({{ $distribusi['netral'] }}%)</span>
                </p>
            </div>
        </div>

        <div class="mt-4 bg-gray-50 p-3 rounded">
            <p class="font-medium text-gray-700">Rekomendasi:
                <span class="font-normal">{{ $rekomendasi }}</span>
            </p>
        </div>
    </div>

    <!-- Tabel Ulasan -->
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Pengulas</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Ulasan</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Rating</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($ulasan as $review)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">
                    {{ ($ulasan->currentPage() - 1) * $ulasan->perPage() + $loop->iteration }}
                </td>
                <td class="px-4 py-3 font-medium text-gray-800">
                    {{ $review->pengguna->nama ?? 'Pengguna Anonim' }}
                </td>
                <td class="px-4 py-3 text-gray-600">
                    {{ $review->komentar ?? 'Tidak ada komentar.' }}
                </td>
                <td class="px-4 py-3 text-gray-600">
                    <i class="fas fa-star text-yellow-400 text-sm me-2"></i>
                    {{ $review->rating }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-4 py-3 text-center text-gray-600">Belum ada ulasan untuk kursus ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Custom -->
    <div class="flex justify-center items-center mt-5">
        <ul class="inline-flex -space-x-px text-sm">
            {{-- Tombol Sebelumnya --}}
            <li>
                @if ($ulasan->onFirstPage())
                <span class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-400 bg-gray-100 border border-gray-300 rounded-s-lg cursor-not-allowed">
                    Sebelumnya
                </span>
                @else
                <a href="{{ $ulasan->previousPageUrl() }}"
                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                    Sebelumnya
                </a>
                @endif
            </li>

            {{-- Tombol Nomor Halaman --}}
            @for ($i = 1; $i <= $ulasan->lastPage(); $i++)
            <li>
                @if ($i == $ulasan->currentPage())
                <span class="flex items-center justify-center px-3 h-8 leading-tight text-white bg-blue-600 border border-gray-300">
                    {{ $i }}
                </span>
                @else
                <a href="{{ $ulasan->url($i) }}"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    {{ $i }}
                </a>
                @endif
            </li>
            @endfor

            {{-- Tombol Berikutnya --}}
            <li>
                @if ($ulasan->hasMorePages())
                <a href="{{ $ulasan->nextPageUrl() }}"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                    Berikutnya
                </a>
                @else
                <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-400 bg-gray-100 border border-gray-300 rounded-e-lg cursor-not-allowed">
                    Berikutnya
                </span>
                @endif
            </li>
        </ul>
    </div>

    <!-- Info entri -->
    <div class="mt-4 mb-5 text-center text-sm text-gray-600 dark:text-gray-400">
        Menampilkan {{ $ulasan->firstItem() }} sampai {{ $ulasan->lastItem() }} dari {{ $ulasan->total() }} entri
    </div>

    <div class="mt-6">
        <a href="{{ route('UlasanPerusahaan') }}"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Ulasan
        </a>
    </div>
</main>

@endsection
