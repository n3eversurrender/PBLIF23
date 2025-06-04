@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')

<main>
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 text-sm text-gray-500 pb-6">
        <a href="/jadwal" class="hover:text-blue-600 transition">Jadwal</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-blue-600 font-medium">Kelola Jadwal</span>
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
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4">Sesi ke-1</th>
                        <td class="px-6 py-4 ">15 Agustus 2023</td>
                        <td class="px-6 py-4 ">15.00 WIB</td>
                        <td class="px-6 py-4 ">Gedung A, Lantai 3</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-4 justify-center items-center h-full">
                                <a href="#" class="edit-button font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="#" class="font-medium text-red-600 dark:text-blue-500 hover:underline">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Tambahkan baris lain sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Edit Jadwal -->
    <div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6 relative">
            <h2 class="text-xl font-bold mb-4 text-center">Edit Jadwal</h2>
            <form id="editJadwalForm">
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700">Sesi</label>
                    <input type="number" id="edit-sesi" class="border border-gray-300 text-sm rounded-lg w-full p-2.5" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700">Tanggal</label>
                    <input type="date" id="edit-tanggal" class="border border-gray-300 text-sm rounded-lg w-full p-2.5" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700">Waktu</label>
                    <input type="time" id="edit-waktu" class="border border-gray-300 text-sm rounded-lg w-full p-2.5" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700">Lokasi</label>
                    <input type="text" id="edit-lokasi" class="border border-gray-300 text-sm rounded-lg w-full p-2.5" required>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    document.getElementById('toggleTambahJadwal').addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah link reload halaman
        const passwordForm = document.getElementById('tambahJadwal');
        passwordForm.classList.toggle('hidden'); // Menyembunyikan atau menampilkan form

    });
    // Fungsi untuk buka modal edit dan isi form dengan data
    function openEditModal(data) {
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // Isi form modal
        document.getElementById('editSesi').value = data.sesi;
        document.getElementById('editTanggal').value = data.tanggal;
        document.getElementById('editWaktu').value = data.waktu;
        document.getElementById('editLokasi').value = data.lokasi;
    }

    // Fungsi tutup modal
    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Event listener untuk semua tombol edit
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            // Ambil data dari atribut data-*
            const data = {
                sesi: this.dataset.sesi,
                tanggal: this.dataset.tanggal,
                waktu: this.dataset.waktu,
                lokasi: this.dataset.lokasi
            };

            // Buka modal dan isi data ke form
            openEditModal(data);
        });
    });
</script>
@endsection