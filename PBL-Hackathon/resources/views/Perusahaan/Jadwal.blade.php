@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')

<main>
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
            <!-- Baris Kursus 1 -->
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">1</td>
                <td class="px-4 py-3 font-medium text-gray-800">Welding Pro</td>
                <td class="px-4 py-3 text-gray-600">7x</td>
                <td class="px-4 py-3 space-x-2">
                    <div class="flex gap-4 h-full">
                        <a href="/kelolajadwal" class="edit-button font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <i class="fas fa-edit"></i> Kelola Jadwal
                        </a>
                    </div>
                </td>
            </tr>

            <!-- Tambahkan baris kursus lainnya di sini -->
        </tbody>
    </table>
</main>
@endsection