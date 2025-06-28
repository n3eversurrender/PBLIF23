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

        <!-- Pagination -->
        <div class="flex justify-center items-center mt-5">
            <ul class="inline-flex -space-x-px text-sm">
                <!-- Tombol Sebelumnya -->
                <li>
                    @if ($dataKursusUlasan->onFirstPage())
                    <span class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-400 bg-gray-100 border border-e-0 border-gray-300 rounded-s-lg cursor-not-allowed">
                        Sebelumnya
                    </span>
                    @else
                    <a href="{{ $dataKursusUlasan->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                        Sebelumnya
                    </a>
                    @endif
                </li>

                <!-- Tombol Berikutnya -->
                <li>
                    @if ($dataKursusUlasan->hasMorePages())
                    <a href="{{ $dataKursusUlasan->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
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
            Menampilkan {{ $dataKursusUlasan->firstItem() }} sampai {{ $dataKursusUlasan->lastItem() }} dari {{ $dataKursusUlasan->total() }} entri
        </div>

    </main>
    @endsection