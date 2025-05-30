@extends('layouts.maintrainee')

@vite(['resources/js/home.js'])
@vite(['resources/css/berandaperusahaan.css'])
@section('MainTrainee')

<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<main class="sm:mx-10 mx-5 mt-16">
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 text-sm text-gray-500 pt-4">
        <a href="/ProfilPerusahaan" class="hover:text-blue-600 transition">Profil</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-blue-600 font-medium">Edit Profil</span>
    </div>

    <form class="mt-10 space-y-10">
        <!-- Header with avatar -->
        <div class="flex justify-center">
            <div class="text-center">
                <img src="{{ asset('image/12.webp') }}" alt="Profile Image" class="w-44 h-44 rounded-full mb-4 object-cover mx-auto shadow-md">
                <p class="font-bold text-lg">PT. SkillMaju</p>
                <p class="text-gray-600 text-xs">info@teknikmaju.co.id</p>
            </div>
        </div>

        <!-- Form fields -->
        <div class="flex items-center justify-center">
            <div class="max-w-3xl w-full p-8 bg-white rounded-xl shadow-md dark:bg-gray-800 space-y-6">
                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Foto Profil</label>
                    <input type="file"
                        class="bg-gray-50 border border-Border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" accept="image/jpeg, image/png, image/gif, image/svg+xml" />
                    <i class="fas fa-eye absolute right-3 top-12 transform -translate-y-1/2 cursor-pointer"
                        id="togglePassword"></i>
                </div>
                <div class="grid sm:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Nama Perusahaan</label>
                        <input type="text"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 transition"
                            placeholder="Contoh: PT. Sukses Makmur">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Nomor Telepon</label>
                        <input type="tel"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 transition"
                            placeholder="Contoh: 0812xxxxxxx">
                    </div>
                </div>
                <!-- Alamat -->
                <div class="mt-6">
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Alamat</label>
                    <textarea
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 transition"
                        placeholder="Contoh: Jl. Industri No. 1, Batam, Kepulauan Riau"></textarea>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Informasi Umum</label>
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

                <!-- Education -->
                <!-- <div class="mt-3">
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Pendidikan</label>
                    <div>
                        <div id="toolbar-pendidikan" class="mb-2">
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
                        <div id="editor-pendidikan" class="bg-white h-60 border border-gray-300 rounded p-2"></div>
                    </div>
                </div> -->

                <!-- Services -->
                <!-- <div class="mt-3">
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Layanan</label>
                    <div>
                        <div id="toolbar-layanan" class="mb-2">
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
                        <div id="editor-layanan" class="bg-white h-60 border border-gray-300 rounded p-2"></div>
                    </div>
                </div> -->

                <!-- Visi-->
                <!-- <div class="mt-10">
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Visi</label>
                    <div>
                        <div id="toolbar-visi" class="mb-2">
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
                        <div id="editor-visi" class="bg-white h-60 border border-gray-300 rounded p-2"></div>
                    </div>
                </div> -->

                <!-- Misi -->
                <!-- <div class="mt-10">
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Misi</label>
                    <div>
                        <div id="toolbar-misi" class="mb-2">
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
                        <div id="editor-misi" class="bg-white h-60 border border-gray-300 rounded p-2"></div>
                    </div>
                </div> -->
            </div>
        </div>

        <!-- Button -->
        <div class="flex justify-center">
            <button type="submit"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2 focus:outline-none transition duration-300">
                Simpan
            </button>
        </div>
    </form>
</main>
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
  const editors = [
    { toolbar: '#toolbar-deskripsi', editor: '#editor-deskripsi' },
  ];

  editors.forEach(({ toolbar, editor }) => {
    new Quill(editor, {
      theme: 'snow',
      modules: {
        toolbar: toolbar
      },
      placeholder: 'Anda bisa memasukkan informasi umum tentang perusahaan anda seperti deskripsi, pendidikan, layanan, visi, misi dan lainnya...'  // Tambahkan placeholder di sini
    });
  });
</script>

@endsection