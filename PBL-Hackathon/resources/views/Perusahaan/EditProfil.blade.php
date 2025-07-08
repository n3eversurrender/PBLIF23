@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')
@vite(['resources/js/richtext.js'])
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<main>
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 text-sm text-gray-500 pt-4">
        <a href="/ProfilPerusahaan" class="hover:text-blue-600 transition">Profil</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-blue-600 font-medium">Edit Profil</span>
    </div>

    <form class="mt-10 space-y-10" action="{{ route('UpdateProfilPerusahaan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Header with avatar -->
        <div class="flex justify-center">
            <div class="text-center">
                <img src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('image/Thumnnail.jpg') }}"
                    alt="Profile Image" class="w-44 h-44 rounded-full mb-4 object-cover mx-auto shadow-md">
                <p class="font-bold text-lg">{{ $user->nama ?? '-' }}</p>
                <p class="text-gray-600 text-xs">{{ $user->email ?? '-' }}</p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto space-y-8">

            <!-- Informasi Umum -->
            <div class="p-8 bg-white rounded-xl shadow-md dark:bg-gray-800 space-y-6">
                <h2 class="text-xl font-semibold text-gray-800">📄 Informasi Umum</h2>

                <!-- Foto Profil -->
                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Foto Profil</label>
                    <input type="file" name="foto_profil"
                        class="bg-gray-50 border border-Border text-gray-900 text-sm rounded-lg block w-full dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        accept="image/jpeg, image/png, image/gif, image/svg+xml">
                    @error('foto_profil')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Nama Perusahaan</label>
                        <input type="text" name="nama" value="{{ $user->nama ?? '' }}"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                            placeholder="Contoh: PT. Sukses Makmur" />
                        @error('nama')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Nomor Telepon</label>
                        <input type="tel" name="no_telepon" value="{{ $user->no_telepon ?? '' }}"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                            placeholder="Contoh: 0812xxxxxxx">
                        @error('no_telepon')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Alamat</label>
                    <textarea name="alamat"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                        placeholder="Contoh: Jl. Industri No. 1, Batam, Kepulauan Riau">{{ $user->alamat ?? '' }}</textarea>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea name="deskripsi"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                        placeholder="Tuliskan deskripsi perusahaan">{{ $perusahaan->deskripsi ?? '' }}</textarea>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Layanan</label>
                    <input type="text" name="layanan" value="{{ $perusahaan->layanan ?? '' }}"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                        placeholder="Contoh: Welding Service, Fabrication">
                </div>

                <div class="grid sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Visi</label>
                        <textarea name="visi"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                            placeholder="Tuliskan visi perusahaan">{{ $perusahaan->visi ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Misi</label>
                        <textarea name="misi"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                            placeholder="Tuliskan misi perusahaan">{{ $perusahaan->misi ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Informasi Legal -->
            <div class="p-8 bg-white rounded-xl shadow-md dark:bg-gray-800 space-y-6">
                <h2 class="text-xl font-semibold text-gray-800">📄 Informasi Legal</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">NPWP</label>
                        <input type="text" name="npwp" value="{{ $perusahaan->npwp ?? '' }}"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        <label class="block mt-2 text-sm font-bold text-gray-900 dark:text-white">File NPWP (PDF)</label>
                        <input type="file" name="file_npwp"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5"
                            accept="application/pdf" />
                        @error('file_npwp')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Akta Pendirian</label>
                        <input type="text" name="akta_pendirian" value="{{ $perusahaan->akta_pendirian ?? '' }}"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        <label class="block mt-2 text-sm font-bold text-gray-900 dark:text-white">File Akta (PDF)</label>
                        <input type="file" name="file_akta_pendirian"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5"
                            accept="application/pdf">
                        @error('file_akta_pendirian')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Izin Operasional</label>
                        <input type="text" name="izin_operasional" value="{{ $perusahaan->izin_operasional ?? '' }}"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        <label class="block mt-2 text-sm font-bold text-gray-900 dark:text-white">File Izin (PDF)</label>
                        <input type="file" name="file_izin_operasional"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5"
                            accept="application/pdf">
                        @error('file_izin_operasional')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Sertifikasi BNSP</label>
                        <input type="text" name="sertifikasi_bnsp" value="{{ $perusahaan->sertifikasi_bnsp ?? '' }}"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        <label class="block mt-2 text-sm font-bold text-gray-900 dark:text-white">File Sertifikasi (PDF)</label>
                        <input type="file" name="file_sertifikasi_bnsp"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5"
                            accept="application/pdf">
                        @error('file_sertifikasi_bnsp')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-center">
                <button type="submit"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2">
                    Simpan
                </button>
            </div>

        </div>
    </form>



</main>
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        confirmButtonText: 'OK',
        customClass: {
            confirmButton: 'my-swal-button'
        }
    });
</script>
@endif

@endsection