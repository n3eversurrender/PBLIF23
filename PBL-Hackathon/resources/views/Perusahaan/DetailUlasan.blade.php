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
            {{ $ulasan->count() }}
        </p>
    </div>

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
            @forelse ($ulasan as $index => $review)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">{{ $index + 1 }}</td>
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

    <div class="mt-6">
        <a href="{{ route('UlasanPerusahaan') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Ulasan
        </a>
    </div>
</main>
@endsection