@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')
@vite(['resources/js/richtext.js'])
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<main>
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Kelola Kursus</h2>
        <div class="text-right mb-4">
            @if ($user->status_verifikasi === 'Sudah Diverifikasi')
            <a href="/tambahkursus" class="font-semibold bg-ButtonBase hover:bg-HoverGlow transition duration-700 py-2.5 px-5 rounded-lg text-white">
                <i class="fa-solid fa-plus me-3"></i>Tambah Kursus
            </a>
            @else
            <button disabled class="font-semibold bg-gray-400 cursor-not-allowed py-2.5 px-5 rounded-lg text-white">
                <i class="fa-solid fa-plus me-3"></i>Tambah Kursus (Verifikasi Diperlukan)
            </button>
            @endif

        </div>

        @if ($kursus->isEmpty() && $user->status_verifikasi !== 'Sudah Diverifikasi')
        <div class="text-center py-10 bg-yellow-50 border border-yellow-300 rounded-lg text-yellow-700">
            <p class="font-medium mb-2">Belum ada data kursus.</p>
            <p>Silakan lengkapi <a href="{{ route('ProfilPerusahaan') }}" class="text-blue-600 underline">Profil Perusahaan</a> Anda terlebih dahulu sebelum menambah kursus.</p>
        </div>
        @elseif ($kursus->isEmpty() && $user->status_verifikasi === 'Sudah Diverifikasi')
        <div class="text-center py-10 text-gray-500">
            <p class="font-medium">Belum ada kursus yang ditambahkan. Silakan klik tombol <strong>Tambah Kursus</strong> untuk memulai.</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Kursus</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Level</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Kapasitas</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Peserta</th> 
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($kursus as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $item->judul }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $item->tingkat_kesulitan }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $item->kapasitas}}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $item->pendaftaran->count() }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $item->status }}</td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('DetailKursus', ['id' => $item->kursus_id]) }}" class="text-blue-600 hover:underline text-sm">Detail</a>
                            <button data-modal-target="my_modal_edit_{{ $item->kursus_id }}" data-modal-toggle="my_modal_edit_{{ $item->kursus_id }}" class="text-blue-600 hover:text-blue-900 mr-2">
                                Edit
                            </button>
                            <button type="button" data-modal-target="my_modal_delete_{{ $item->kursus_id }}" data-modal-toggle="my_modal_delete_{{ $item->kursus_id }}" class="font-medium text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-400">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div id="my_modal_edit_{{ $item->kursus_id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-6 w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                            <!-- Konten Modal -->
                            <div class="relative bg-white rounded-lg shadow-lg dark:bg-gray-700">
                                <!-- Header Modal -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Edit Kursus
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="my_modal_edit_{{ $item->kursus_id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Tutup modal</span>
                                    </button>
                                </div>
                                <!-- Isi Modal -->
                                <form action="{{ route('kursus.update', $item->kursus_id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="p-6 space-y-4 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                                        <!-- Judul dan Kategori bersebelahan -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="judul" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-400">Judul Kursus</label>
                                                <input type="text" name="judul" id="judul" value="{{ old('judul', $item->judul) }}" class="mt-1 p-2 border border-gray-300 rounded w-full" />
                                            </div>
                                            <div>
                                                <label for="kategori_id" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-400">Kategori</label>
                                                <select id="kategori_id" name="kategori_id" class="mt-1 p-2 border border-gray-300 rounded w-full">
                                                    @foreach ($kategori as $kat)
                                                    <option value="{{ $kat->kategori_id }}" {{ $item->kategori_id == $kat->kategori_id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Deskripsi Kursus -->
                                        <div>
                                            <label for="deskripsi" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-400">Deskripsi</label>
                                            <textarea name="deskripsi" id="deskripsi" class="mt-1 p-2 border border-gray-300 rounded w-full">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                                        </div>

                                        <!-- Lokasi dan Harga bersebelahan -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="lokasi" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-400">Lokasi</label>
                                                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $item->lokasi) }}" class="mt-1 p-2 border border-gray-300 rounded w-full" />
                                            </div>
                                            <div>
                                                <label for="harga" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-400">Harga</label>
                                                <input type="number" name="harga" id="harga" value="{{ old('harga', $item->harga) }}" class="mt-1 p-2 border border-gray-300 rounded w-full" />
                                            </div>
                                        </div>

                                        <!-- Tingkat Kesulitan dan Kapasitas bersebelahan -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="tingkat_kesulitan" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-400">Tingkat Kesulitan</label>
                                                <select name="tingkat_kesulitan" id="tingkat_kesulitan" class="mt-1 p-2 border border-gray-300 rounded w-full">
                                                    <option value="Pemula" {{ $item->tingkat_kesulitan == 'Pemula' ? 'selected' : '' }}>Pemula</option>
                                                    <option value="Menengah" {{ $item->tingkat_kesulitan == 'Menengah' ? 'selected' : '' }}>Menengah</option>
                                                    <option value="Lanjutan" {{ $item->tingkat_kesulitan == 'Lanjutan' ? 'selected' : '' }}>Lanjutan</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="kapasitas" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-400">Kapasitas</label>
                                                <input type="number" name="kapasitas" id="kapasitas" value="{{ old('kapasitas', $item->kapasitas) }}" class="mt-1 p-2 border border-gray-300 rounded w-full" />
                                            </div>
                                        </div>

                                        <!-- Tanggal Mulai dan Tanggal Selesai bersebelahan -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="tgl_mulai" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-400">Tanggal Mulai</label>
                                                <input type="date" name="tgl_mulai" id="tgl_mulai" value="{{ old('tgl_mulai', $item->tgl_mulai) }}" class="mt-1 p-2 border border-gray-300 rounded w-full" />
                                            </div>
                                            <div>
                                                <label for="tgl_selesai" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-400">Tanggal Selesai</label>
                                                <input type="date" name="tgl_selesai" id="tgl_selesai" value="{{ old('tgl_selesai', $item->tgl_selesai) }}" class="mt-1 p-2 border border-gray-300 rounded w-full" />
                                            </div>
                                        </div>

                                        <!-- Foto Kursus -->
                                        <div>
                                            <label for="foto_kursus" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-400">Foto Kursus</label>
                                            <input type="file" name="foto_kursus" id="foto_kursus" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" accept=".jpg,.jpeg,.png,.gif" />
                                        </div>
                                    </div>

                                    <!-- Tombol Update -->
                                    <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-b">
                                        <button type="submit" class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                    <!-- Modal Delete -->
                    <div id="my_modal_delete_{{ $item->kursus_id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <form action="{{ route('HapusKursus', $item->kursus_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda Yakin Ingin Menghapus Kursus Ini?</h3>
                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Yakin
                                        </button>
                                        <button type="button" data-modal-hide="my_modal_delete_{{ $item->kursus_id }}" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white">
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
        </div>
        @endif
    </div>
</main>
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

@endsection