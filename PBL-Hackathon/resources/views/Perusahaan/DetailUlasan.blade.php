@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')

<main>
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 text-sm text-gray-500 pb-6">
        <a href="/ulasan" class="hover:text-blue-600 transition">Ulasan</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-blue-600 font-medium">Detail Ulasan</span>
    </div>
    <div class="mb-4">
        <h2 class="text-xl font-bold">Welding Pro</h2>
        <p class="text-gray-600">Rata-Rata Ulasan: <i class="fas fa-star text-yellow-400 text-sm me-1"></i>7.5 | Total Ulasan: 35</p>
    </div>
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Ulasan</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Rating</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <!-- Baris Kursus 1 -->
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">1</td>
                <td class="px-4 py-3 text-gray-600">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus ut, officia eveniet perferendis optio quos laudantium quisquam cumque? Temporibus, molestiae.
                </td>
                <td class="px-4 py-3 text-gray-600">
                    <i class="fas fa-star text-yellow-400 text-sm me-2"></i>7.5
                </td>
            </tr>

            <!-- Baris Kursus 1 -->
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">2</td>
                <td class="px-4 py-3 text-gray-600">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non, adipisci!
                </td>
                <td class="px-4 py-3 text-gray-600">
                    <i class="fas fa-star text-yellow-400 text-sm me-2"></i>7.5
                </td>
            </tr>
        </tbody>
    </table>

</main>
@endsection