@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')
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

        {{-- Success message --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error message --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('SimpanKursus') }}" method="POST" enctype="multipart/form-data" id="kursusForm">
            @csrf

            <div class="mb-5">
                <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Judul Kursus</label>
                <input type="text" name="judul" value="{{ old('judul') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" />
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
                    <div id="editor-deskripsi" class="bg-white h-60 border border-gray-300 rounded p-3 overflow-y-auto">
                        {!! old('deskripsi') !!}
                    </div>
                    <textarea name="deskripsi" hidden>{{ old('deskripsi') }}</textarea>
                </div>
            </div>

            <div class="sm:flex gap-3 mb-5">
                <div class="sm:w-1/2">
                    <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Tingkat Kesulitan</label>
                    <select name="tingkat_kesulitan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                        <option value="" disabled {{ old('tingkat_kesulitan') ? '' : 'selected' }}>Pilih Tingkat Kesulitan</option>
                        <option value="Pemula" {{ old('tingkat_kesulitan') == 'Pemula' ? 'selected' : '' }}>Pemula</option>
                        <option value="Menengah" {{ old('tingkat_kesulitan') == 'Menengah' ? 'selected' : '' }}>Menengah</option>
                        <option value="Lanjutan" {{ old('tingkat_kesulitan') == 'Lanjutan' ? 'selected' : '' }}>Lanjutan</option>
                    </select>
                </div>

                <div class="sm:w-1/2 sm:mt-0 mt-5">
                    <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Kategori</label>
                    <select name="kategori_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
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
                    <input type="number" name="harga" value="{{ old('harga') }}"
                        class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" />
                </div>

                <div class="sm:w-1/2 sm:mt-0 mt-5">
                    <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Kapasitas</label>
                    <input type="number" name="kapasitas" value="{{ old('kapasitas') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                </div>
            </div>

            <div class="sm:flex gap-3 mb-5">
                <div class="sm:w-1/2">
                    <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" value="{{ old('tgl_mulai') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" />
                </div>
                <div class="sm:w-1/2 sm:mt-0 mt-5">
                    <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Tanggal Selesai</label>
                    <input type="date" name="tgl_selesai" value="{{ old('tgl_selesai') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" />
                </div>
            </div>

            <div class="sm:flex gap-3 mb-5">
                <div class="sm:w-1/2">
                    <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" />
                </div>
                <div class="sm:w-1/2 sm:mt-0 mt-5">
                    <label class="block mb-2 text-base lg:text-xl font-semibold text-gray-900 dark:text-white">Foto Kursus</label>
                    <input type="file" name="foto_kursus"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        accept=".jpg,.jpeg,.png,.gif" />
                </div>
            </div>

            <button type="submit"
                class="px-3 py-2 mt-5 text-sm w-30 font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
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

        // Saat form disubmit, ambil isi editor dan masukkan ke textarea
        const form = document.getElementById('kursusForm');
        form.addEventListener('submit', function (e) {
            const deskripsiInput = document.querySelector('textarea[name="deskripsi"]');
            const html = quill.root.innerHTML.trim();

            // Cek jika deskripsi kosong
            if (html === '' || html === '<p><br></p>') {
                e.preventDefault();
                alert("Deskripsi tidak boleh kosong.");
                return;
            }

            deskripsiInput.value = html;
        });
    </script>
@endsection
