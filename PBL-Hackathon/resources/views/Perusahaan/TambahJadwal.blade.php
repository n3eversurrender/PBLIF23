@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')

<main>
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 text-sm text-gray-500 pb-6">
        <a href="/kursus" class="hover:text-blue-600 transition">Kelola Kursus</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <a href="/tambahkursus" class="hover:text-blue-600 transition">Tambah Kursus</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-blue-600 font-medium">Tambah Jadwal</span>
    </div>

    <div class="text-center mb-5">
        <h2 class="text-2xl font-bold">Tambah Jadwal</h2>
        <p class="text-lg font-semibold text-gray-700">Kursus Pengelasan bagi Pemula</p>
    </div>

    <div class="">
        <form action="">
            <div class="sm:mt-6 mt-4">
                <div class="flex justify-end">
                    <a href="#"
                        id="toggleTambahJadwal"
                        class="font-semibold bg-ButtonBase hover:bg-HoverGlow transition duration-700 py-2.5 px-5 rounded-lg text-white">
                        <i class="fa-solid fa-plus me-3"></i>Tambah Jadwal
                    </a>
                </div>
                <div class="flex justify-center">
                    <div id="tambahJadwal" class="mt-5 rounded-lg shadow-md px-6 pt-6 hidden w-full">
                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Sesi</label>
                        <input type="number"
                            class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Sesi Ke" />

                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white mt-4">Tanggal</label>
                        <input type="date"
                            class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" />

                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white mt-4">Waktu</label>
                        <input type="time"
                            class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" />

                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white mt-4">Lokasi</label>
                        <input type="text"
                            class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contoh Gedung A, Lantai 3" />

                        <div class="flex justify-end w-full my-5">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-HoverGlow focus:ring-4 focus:ring-HoverGlow font-medium rounded-md text-sm px-10 py-1.5 me-5 focus:outline-none duration-700 transition">
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-400 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Sesi</th>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Waktu</th>
                        <th scope="col" class="px-6 py-3">Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4">Sesi ke-1</th>
                        <td class="px-6 py-4 ">15 Agustus 2023</td>
                        <td class="px-6 py-4 ">15.00 WIB</td>
                        <td class="px-6 py-4 ">Gedung A, Lantai 3</td>
                    </tr>

                    <!-- Tambahkan baris lain sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    document.getElementById('toggleTambahJadwal').addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah link reload halaman
        const passwordForm = document.getElementById('tambahJadwal');
        passwordForm.classList.toggle('hidden'); // Menyembunyikan atau menampilkan form
    });
</script>
@endsection