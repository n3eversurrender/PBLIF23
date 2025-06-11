@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')
@vite(['resources/js/richtext.js'])
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<main>
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 text-sm text-gray-500 pb-6">
        <a href="/kursus" class="hover:text-blue-600 transition">Kelola Kursus</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-blue-600 font-medium">Tambah Kursus</span>
    </div>

    <h2 class="text-2xl font-bold text-center mb-5">Tambah Kursus</h2>
    <form action="{{ route('SimpanKursus') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-5">
            <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Judul Kursus</label>
            <input type="text" name="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        </div>

        <div class="mb-5">
            <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Deskripsi</label>
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
                <textarea name="deskripsi" hidden></textarea>
            </div>
        </div>

        <div class="sm:flex gap-3 mb-5">
            {{-- Tingkat Kesulitan --}}
            <div class="sm:w-1/2">
                <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Tingkat Kesulitan</label>
                <select name="tingkat_kesulitan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" disabled {{ old('tingkat_kesulitan') ? '' : 'selected' }}>Pilih Tingkat Kesulitan</option>
                    <option value="Pemula" {{ old('tingkat_kesulitan') == 'Pemula' ? 'selected' : '' }}>Pemula</option>
                    <option value="Menengah" {{ old('tingkat_kesulitan') == 'Menengah' ? 'selected' : '' }}>Menengah</option>
                    <option value="Lanjutan" {{ old('tingkat_kesulitan') == 'Lanjutan' ? 'selected' : '' }}>Lanjutan</option>
                </select>
            </div>

            {{-- Kategori --}}
            <div class="sm:w-1/2 sm:mt-0 mt-5">
                <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Kategori</label>
                <select name="kategori_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" disabled {{ old('kategori_id') ? '' : 'selected' }}>Pilih Kategori</option>
                    @foreach ($kategori as $kat)
                    <option value="{{ $kat->kategori_id }}" {{ old('kategori_id') == $kat->kategori_id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="sm:flex gap-3 mb-5">
            <div class="sm:w-1/2">
                <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900">Harga</label>
                <input type="number" name="harga" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

            <div class="sm:w-1/2 sm:mt-0 mt-5">
                <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Kapasitas</label>
                <input type="number" name="kapasitas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
        </div>

        <div class="sm:flex gap-3 mb-5">
            <div class="sm:w-1/2">
                <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="sm:w-1/2 sm:mt-0 mt-5">
                <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
        </div>

        <div class="sm:flex gap-3 mb-5">
            <div class="sm:w-1/2">
                <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Lokasi</label>
                <input type="text" name="lokasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <div class="sm:w-1/2 sm:mt-0 mt-5">
                <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Foto Kursus</label>
                <input type="file" name="foto_kursus" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept=".jpg,.jpeg,.png,.gif" />
            </div>
        </div>

        {{-- Tombol submit --}}
        <button type="submit" class="px-3 py-2 mt-5 text-sm w-30 font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="fas fa-paper-plane mr-2"></i>Simpan
        </button>
    </form>
</main>
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    const quill = new Quill('#editor-deskripsi', {
        theme: 'snow',
        modules: {
            toolbar: '#toolbar-deskripsi'
        }
    });

    const form = document.querySelector('form');
    form.addEventListener('submit', function() {
        const deskripsiInput = document.querySelector('textarea[name="deskripsi"]');
        deskripsiInput.value = quill.root.innerHTML;
    });
</script>

@endsection