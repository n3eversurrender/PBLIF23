@extends('layouts.mainNavPerusahaan')

@vite(['resources/js/home.js'])
@vite(['resources/css/berandaperusahaan.css'])
@section('MainNavPerusahaan')

<main class="sm:mx-10 mx-5 mt-16">
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 text-sm text-gray-500 pt-4">
        <a href="/ProfilPerusahaan" class="hover:text-blue-600 transition">Profil</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-blue-600 font-medium">Kelola Galeri</span>
    </div>

    <!-- Kelola galeri perusahaan -->
    <div class="mx-16">
        <h1 class="font-bold text-2xl text-center mt-5 mb-16">Kelola Galeri Perusahaan</h1>
        <form action="">
            <div class="sm:mt-6 mt-4">
                <div class="flex justify-end">
                    <a href="#"
                        id="toggleTambahGaleri"
                        class="font-semibold bg-ButtonBase hover:bg-HoverGlow transition duration-700 py-2.5 px-5 rounded-lg text-white">
                        Tambah Galeri
                    </a>
                </div>
                <div class="flex justify-center">
                    <div id="tambahGaleri" class="mt-5 rounded-lg shadow-md px-6 pt-6 hidden w-full">
                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Foto Kegiatan</label>
                        <input type="file"
                            class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white mt-4">Nama Kegiatan</label>
                        <input type="text"
                            class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Contoh. Pertemuan pertama kelas mengelas">

                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white mt-4">Tanggal Kegiatan</label>
                        <input type="date"
                            class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <div class="flex justify-end w-full my-5">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-HoverGlow focus:ring-4 focus:ring-HoverGlow font-medium rounded-md text-sm px-10 py-1.5 me-5 focus:outline-none duration-700 transition">
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        <div class="relative my-5 overflow-x-auto shadow-md sm:rounded-lg">
            <h2 class="font-semibold text-lg mb-2">Daftar Kegiatan</h2>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-400 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Gambar</th>
                        <th scope="col" class="px-6 py-3">Nama Kegiatan</th>
                        <th scope="col" class="px-6 py-3">Tanggal Kegiatan</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4">
                            <img src="{{ asset('image/12.webp') }}" alt="" class="w-24 h-24 object-cover aspect-square rounded-lg img-kegiatan">
                        </th>
                        <td class="px-6 py-4 nama-kegiatan">Kegiatan Team Build</td>
                        <td class="px-6 py-4 tanggal-kegiatan">2023-06-06</td>
                        <td class="px-6 py-4 h-full">
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
                </tbody>
            </table>

            <!-- Modal Edit -->
            <div id="editModal" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg w-full max-w-md relative">
                    <button id="closeEditModal" class="absolute top-2 right-3 text-gray-600 hover:text-red-600 text-lg font-bold">&times;</button>
                    <h2 class="text-xl font-semibold mb-4">Edit Kegiatan</h2>
                    <form id="editForm">
                        <div class="mb-4">
                            <label class="block mb-1">Gambar</label>
                            <input type="file" id="editImage" class="w-full border rounded" />
                        </div>
                        <div class="mb-4">
                            <label class="block mb-1">Nama Kegiatan</label>
                            <input type="text" id="editNama" class="w-full border px-3 py-2 rounded" />
                        </div>
                        <div class="mb-4">
                            <label class="block mb-1">Tanggal Kegiatan</label>
                            <input type="date" id="editTanggal" class="w-full border px-3 py-2 rounded" />
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</main>

<script>
    document.getElementById('toggleTambahGaleri').addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah link reload halaman
        const passwordForm = document.getElementById('tambahGaleri');
        passwordForm.classList.toggle('hidden'); // Menyembunyikan atau menampilkan form
    });

    const editModal = document.getElementById('editModal');
    const closeEditModal = document.getElementById('closeEditModal');

    document.querySelectorAll('.edit-button').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const row = this.closest('tr');
            const nama = row.querySelector('.nama-kegiatan')?.textContent.trim();
            const tanggal = row.querySelector('.tanggal-kegiatan')?.textContent.trim();

            document.getElementById('editNama').value = nama;
            document.getElementById('editTanggal').value = tanggal;

            editModal.classList.remove('hidden');
            editModal.classList.add('flex');
        });
    });

    function closeModal() {
        editModal.classList.remove('flex');
        editModal.classList.add('hidden');
    }

    closeEditModal.addEventListener('click', closeModal);

    editModal.addEventListener('click', function(e) {
        if (e.target === editModal) {
            closeModal();
        }
    });
</script>
@endsection