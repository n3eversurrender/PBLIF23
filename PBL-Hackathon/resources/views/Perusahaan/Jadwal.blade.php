@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')

<main>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Kursus</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Pertemuan</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($kursus as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $item->judul }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $item->jadwalKursus->count() }} x</td>
                        <td class="px-4 py-3 space-x-2">
                            <div class="flex gap-4 h-full">
                                <a href="{{ route('KelolaJadwal', ['kursus_id' => $item->kursus_id]) }}" class="edit-button font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <i class="fas fa-edit"></i> Kelola Jadwal
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach

                @if($kursus->isEmpty())
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500">Belum ada kursus yang tersedia.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</main>

@endsection
