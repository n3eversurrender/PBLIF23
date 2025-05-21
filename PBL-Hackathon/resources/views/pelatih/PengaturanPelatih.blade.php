@extends('layouts.mainPelatih')

@section('MainPelatih')

<!-- content start -->
<section class="bg-white dark:bg-gray-900">
    <div class="flex mb-2">
        <div>
            <img class="w-16 h-16 rounded-full object-cover"
                src="{{ $pengguna->foto_profil ? asset('storage/foto_profil/' . $pengguna->foto_profil) : asset('image/9203764.png') }}"
                alt="Rounded avatar" />
              
        </div>
        <div class="flex flex-col ms-3 w-full">
            <div>
                <h2 class="text-base font-bold">{{ $pengguna->nama }}</h2>
                <p class="text-xs">{{ $pengguna->email }}</p>
            </div>

            <div class="flex items-center mt-2">
                @if($pengguna->status == 'Aktif')
                <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 me-2">
                    <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                    Aktif
                </span>
                <i class="fas fa-check-circle text-green-500 text-xs"></i>

                @elseif($pengguna->status == 'Tidak Aktif')
                <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300 me-2">
                    <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                    Tidak Aktif
                </span>
                <i class="fas fa-times-circle text-red-500 text-xs"></i>
                <span class="text-red-500 text-xs ml-2">Akun Anda Tidak Aktif</span>

                @if($pengguna->verifikasi && ($pengguna->verifikasi->status_verifikasi == 'Ditolak' || $pengguna->verifikasi->status_verifikasi == 'Menunggu'))
                <form action="{{ route('pengaturanPelatih.ajukanVerifikasi') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-blue-500 text-xs ml-2 hover:underline">
                        Ajukan Verifikasi
                    </button>
                </form>
                @endif
                @else
                <span class="inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-gray-900 dark:text-gray-300 me-2">
                    <span class="w-2 h-2 me-1 bg-gray-500 rounded-full"></span>
                    No Status
                </span>
                <form action="{{ route('pengaturanPelatih.ajukanVerifikasi') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-blue-500 text-xs font-medium hover:underline">
                        Ajukan Verifikasi
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <form action="{{ route('pelatih.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="flex justify-end w-full mb-3">
            <button type="button" id="tambahButton" data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="text-white bg-ButtonBase hover:bg-HoverGlow transition duration-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-6 py-1.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Tambah Data
            </button>

            <button type="button" id="editButton" class="text-white bg-ButtonBase hover:bg-HoverGlow transition duration-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-6 py-1.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Edit
            </button>
        </div>

        <div class="sm:flex gap-6 mb-5">
            <div class="w-full mb-5">
                <label for="nama" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ $pengguna->nama }}"
                    aria-label="disabled input"
                    class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Nama Anda" disabled>
                    @error('nama')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                <label for="no_telepon" class="block mb-2 mt-6 text-sm font-bold text-gray-900 dark:text-white">No Telepon</label>
                <input type="text" name="no_telepon" id="no_telepon" value="{{ $pengguna->no_telepon }}"
                    class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Nomor Telepon Anda" disabled>
                    @error('no_telepon')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror

                <label for="alamat" class="block mb-2 mt-6 text-sm font-bold text-gray-900 dark:text-white">Alamat</label>
                <textarea name="alamat" id="alamat"
                    class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Alamat Anda" disabled>{{ $pengguna->alamat }}</textarea>
                    @error('alamat')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
            </div>

            <div class="w-full mb-5">
                <label for="kata_sandi" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Kata Sandi</label>
                <input type="password" name="kata_sandi" id="kata_sandi"
                    class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Kata Sandi" disabled>
                    @error('kata_sandi')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror

                <label for="jenis_kelamin" class="block mb-2 mt-6 text-sm font-bold text-gray-900 dark:text-white">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin"
                    class=" bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    disabled>
                    <option selected disabled>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ $pengguna->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $pengguna->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                    @error('jenis_kelamin')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                <div class="w-full">
                    <label for="foto_profil" class="block mb-2 mt-6 text-sm font-bold text-gray-900 dark:text-white">Foto Profil</label>
                    <input type="file" name="foto_profil" id="foto_profil"
                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" accept="image/jpeg, image/png, image/gif, image/svg+xml" disabled>
                        @error('foto_profil')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-end w-full mb-10">
            <button type="submit" class="text-white bg-ButtonBase hover:bg-HoverGlow transition duration-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-10 py-1.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Simpan
            </button>
        </div>
    </form>
</section>


<table id="pelatih-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-3 py-3 text-center">No</th>
            <th scope="col" class="px-3 py-3">Pengalaman Kerja</th>
            <th scope="col" class="px-3 py-3">Spesialisasi</th>
            <th scope="col" class="px-3 py-3">File Sertifikasi</th>
            <th scope="col" class="px-3 py-3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pelatihList as $pelatih)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-3 py-3 text-center">{{ $pelatihList->firstItem() + $loop->iteration - 1 }}</td>
            <td class="px-3 py-3">
                @php
                $tahun = $pelatih->tahun_pengalaman ?? 0;
                $bulan = $pelatih->bulan_pengalaman ?? 0;
                @endphp
                @if ($tahun > 0 || $bulan > 0)
                {{ $tahun > 0 ? $tahun . ' tahun' : '' }}
                {{ $bulan > 0 ? $bulan . ' bulan' : '' }}
                @else
                Tidak Ada Pengalaman
                @endif
            </td>
            <td class="px-3 py-3">{{ $pelatih->nama_spesialisasi ?? '-' }}</td>
            <td class="px-3 py-3">
                @if ($pelatih->file_sertifikasi)
                <a href="{{ asset('storage/' . $pelatih->file_sertifikasi) }}" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
                @else
                Tidak Ada
                @endif
            </td>
            <td class="px-3 py-3">
                <!-- Edit Button -->
                <button type="button" data-modal-target="my_modal_edit_{{ $pelatih->pelatih_id }}" data-modal-toggle="my_modal_edit_{{ $pelatih->pelatih_id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400 my-1 mr-2">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <!-- Delete Button -->
                <button type="button" data-modal-target="my_modal_delete_{{ $pelatih->pelatih_id }}" data-modal-toggle="my_modal_delete_{{ $pelatih->pelatih_id }}" class="font-medium text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-400">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </td>
        </tr>

        <!-- Modal Update -->
        <div id="my_modal_edit_{{ $pelatih->pelatih_id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Edit Data Pelatih</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="my_modal_edit_{{ $pelatih->pelatih_id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Tutup modal</span>
                        </button>
                    </div>
                    <form action="{{ route('pelatihSpesialisasi.update', $pelatih->pelatih_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="p-4 md:p-5 bg-white dark:bg-gray-800 rounded-lg shadow-lg space-y-4">
                            <div class="grid grid-cols-1 gap-4">
                                <!-- Form Input Tahun Pengalaman -->
                                <div class="mb-4">
                                    <label for="tahun_pengalaman" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tahun Pengalaman</label>
                                    <input type="number" id="tahun_pengalaman" name="tahun_pengalaman" value="{{ $pelatih->tahun_pengalaman }}" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300" required min="0">
                                </div>

                                <!-- Form Input Bulan Pengalaman -->
                                <div class="mb-4">
                                    <label for="bulan_pengalaman" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bulan Pengalaman</label>
                                    <input type="number" id="bulan_pengalaman" name="bulan_pengalaman" value="{{ $pelatih->bulan_pengalaman }}" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300" required min="0" max="11">
                                </div>

                                <!-- Form Input Spesialisasi -->
                                <div class="mb-4">
                                    <label for="nama_spesialisasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Spesialisasi</label>
                                    <input type="text" id="nama_spesialisasi" name="nama_spesialisasi" value="{{ $pelatih->nama_spesialisasi }}" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300" required>
                                </div>

                                <!-- Form Input File Sertifikasi -->
                                <div class="mb-4">
                                    <label for="file_sertifikasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">File Sertifikasi</label>
                                    <input type="file" name="file_sertifikasi" id="file_sertifikasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" accept="application/pdf">
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Simpan
                                </button>
                                <button data-modal-hide="my_modal_edit_{{ $pelatih->pelatih_id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Hapus -->
        <div id="my_modal_delete_{{ $pelatih->pelatih_id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <form action="{{ route('pelatih.destroy', $pelatih->pelatih_id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda Yakin Ingin Menghapus Ini?</h3>
                            <button data-modal-hide="my_modal_delete_{{ $pelatih->pelatih_id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Yakin
                            </button>
                            <button data-modal-hide="my_modal_delete_{{ $pelatih->pelatih_id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white">
                                Tidak Yakin
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>



<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Data
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('pelatih.store') }}" method="POST" class="p-4 md:p-5" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="tahun_pengalaman" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pengalaman Kerja</label>
                        <div class="flex space-x-4">
                            <div class="flex-1">
                                <label for="tahun_pengalaman" class="block mb-1 text-xs font-medium text-gray-900 dark:text-white">Tahun</label>
                                <input type="number" id="tahun_pengalaman" name="tahun_pengalaman" min="0" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0">
                            </div>
                            <div class="flex-1">
                                <label for="bulan_pengalaman" class="block mb-1 text-xs font-medium text-gray-900 dark:text-white">Bulan</label>
                                <input type="number" id="bulan_pengalaman" name="bulan_pengalaman" min="0" max="11" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="nama_spesialisasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Spesialisasi</label>
                        <input type="text" name="nama_spesialisasi" id="nama_spesialisasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tidak Wajib Isi ( Isilah Sesuai Yang Diginkan )">
                    </div>
                    <div class="col-span-2">
                        <label for="file_sertifikasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File Sertifikasi (PDF)</label>
                        <input type="file" name="file_sertifikasi" id="file_sertifikasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" accept="application/pdf">
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Tambah
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('editButton').addEventListener('click', function() {
        // Pilih semua elemen input, textarea, dan select
        const inputs = document.querySelectorAll('input, textarea, select');

        // Hapus atribut disabled dan ubah cursor
        inputs.forEach(input => {
            input.removeAttribute('disabled');
            input.classList.remove('cursor-not-allowed'); // Hapus kelas 'cursor-not-allowed'
            input.classList.add('cursor-text'); // Tambahkan kelas 'cursor-text' untuk teks
        });

        // Berikan fokus ke input pertama
        document.getElementById('nama').focus();
    });
</script>

@endsection