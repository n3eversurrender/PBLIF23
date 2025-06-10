@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')

<main>
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Kursus</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Ulasan</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Rating</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($dataKursusUlasan as $index => $kursus)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">{{ $index + 1 }}</td>
                <td class="px-4 py-3 font-medium text-gray-800">{{ $kursus['nama_kursus'] }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $kursus['jumlah_ulasan'] }}</td>
                <td class="px-4 py-3 text-gray-600">
                    <i class="fas fa-star text-yellow-400 text-sm me-2"></i>
                    {{ $kursus['rata_rata_rating'] }}
                </td>
                <td class="px-4 py-3 space-x-2">
                    <div class="flex gap-4 h-full">
                        <a href="/detailulasan/{{ $kursus['kursus_id'] }}" class="edit-button font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <i class="fas fa-edit"></i> Detail
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-3 text-center text-gray-600">Tidak ada data kursus yang tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</main>
@endsection