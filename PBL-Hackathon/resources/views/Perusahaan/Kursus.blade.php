@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')
@vite(['resources/js/richtext.js'])
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<main>
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Kelola Kursus</h2>
        <div class="text-right mb-4">
            <a href="/tambahkursus" class="font-semibold bg-ButtonBase hover:bg-HoverGlow transition duration-700 py-2.5 px-5 rounded-lg text-white"><i class="fa-solid fa-plus me-3"></i>Tambah Kursus</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Kursus</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Level</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Peserta</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Pertemuan</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <!-- Baris Kursus 1 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">1</td>
                        <td class="px-4 py-3 font-medium text-gray-800">Welding Pro</td>
                        <td class="px-4 py-3 text-gray-600">Lanjutan</td>
                        <td class="px-4 py-3 text-gray-600">35</td>
                        <td class="px-4 py-3 text-gray-600">7x</td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="/detailkursus" class="text-blue-600 hover:underline text-sm">Detail</a>
                            <a href="javascript:void(0);" onclick='openEditModal({ nama: "Welding Pro" })' class="text-green-600 hover:underline text-sm">Edit</a>
                            <button onclick="openModal()" class="text-red-600 hover:underline text-sm">Hapus</button>
                        </td>
                    </tr>

                    <!-- Tambahkan baris kursus lainnya di sini -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit Kursus -->
    <div id="editModal"  class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-full max-w-3xl max-h-[90vh] p-6 rounded-lg relative overflow-y-auto">
            <button onclick="closeEditModal()" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Kursus</h2>

            <!-- Form Edit -->
            <form id="editCourseForm">
                <div class="mb-5">
                    <label class="block mb-2 text-base font-semibold text-gray-900">Judul Kursus</label>
                    <input type="text" id="edit-judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full" />
                </div>
                <div class="mb-5">
                    <label for="" class="block mb-2 text-base font-semibold text-gray-900 dark:text-white">Deskripsi</label>
                    <div>
                        <div id="toolbar-deskripsi" class="mb-2">
                            <span class="ql-formats">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-list" value="ordered"></button>
                                <button class="ql-list" value="bullet"></button>
                            </span>
                        </div>
                        <div id="editor-deskripsi" class="bg-white h-60 border border-gray-300 rounded p-3 overflow-y-auto"></div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="" class="block mb-2 text-base font-semibold text-gray-900 dark:text-white">Nama Mentor</label>
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <div class="sm:flex gap-3 mb-5">
                    <div class="sm:w-1/2">
                        <label for="" class="block mb-2 text-base font-semibold text-gray-900 dark:text-white">Tingkat Kesulitan</label>
                        <select name="" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" disabled selected>Pilih Tingkat Kesulitan</option>
                            <option value="">Pemula</option>
                            <option value="">Menengah</option>
                            <option value="">Lanjutan</option>
                        </select>
                    </div>

                    <div class="sm:w-1/2 sm:mt-0 mt-5">
                        <label for="" class="block mb-2 text-base font-semibold text-gray-900 dark:text-white">Kategori</label>
                        <select name="" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="">Pengelasan</option>
                            <option value="">Pengecatan</option>
                            <option value="">Pemotongan</option>
                        </select>
                    </div>
                </div>
                <div class="sm:flex gap-3 mb-5">
                    <div class="sm:w-1/2">
                        <label for="" class="block mb-2 text-base font-semibold text-gray-900">Harga</label>
                        <input type="number" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>

                    <div class="sm:w-1/2 sm:mt-0 mt-5">
                        <label for="" class="block mb-2 text-base font-semibold text-gray-900 dark:text-white">Kapasitas</label>
                        <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>

                <div class="sm:flex gap-3 mb-5">
                    <div class="sm:w-1/2">
                        <label for="" class="block mb-2 text-base font-semibold text-gray-900 dark:text-white">Tanggal Mulai</label>
                        <input type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <div class="sm:w-1/2 sm:mt-0 mt-5">
                        <label for="" class="block mb-2 text-base font-semibold text-gray-900 dark:text-white">Tanggal Selesai</label>
                        <input type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                </div>

                <div class="sm:flex gap-3 mb-5">
                    <div class="sm:w-1/2">
                        <label for="" class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Lokasi</label>
                        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <div class="sm:w-1/2 sm:mt-0 mt-5">
                        <label for="" class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Foto Kursus</label>
                        <input type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept=".jpg,.jpeg,.png,.gif" />
                    </div>
                </div>


                <!-- Tombol simpan -->
                <div class="text-right">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</main>
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    function openEditModal(data) {
        document.getElementById("editModal").classList.remove("hidden");
        document.getElementById("editModal").classList.add("flex");
    }

    function closeEditModal() {
        document.getElementById("editModal").classList.add("hidden");
        document.getElementById("editModal").classList.remove("flex");
    }

    // Contoh handler submit form
    document.getElementById("editCourseForm").addEventListener("submit", function(e) {
        e.preventDefault();
        // Ambil semua input dari modal, lalu proses (kirim ke backend atau update frontend)
        alert("Perubahan kursus disimpan!");
        closeEditModal();
    });
</script>


@endsection