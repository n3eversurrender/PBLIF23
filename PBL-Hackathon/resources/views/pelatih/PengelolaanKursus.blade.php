@extends('layouts.mainPelatih')

@section('MainPelatih')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
        <div>
            @if(Auth::check() && Auth::user()->peran == 'Pelatih' && Auth::user()->status == 'Aktif')
            <a href="/TambahKursus" class="flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                <i class="fas fa-plus mr-2"></i>
                Tambah Kursus
            </a>
            @else
            <button class="flex items-center px-4 py-2 bg-gray-400 text-white font-semibold rounded-lg cursor-not-allowed" disabled>
                <i class="fas fa-plus mr-2"></i>
                Tambah Kursus
            </button>
            @endif
        </div>
        <div class="relative">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" id="table-search-users" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Data">
        </div>
    </div>
    <table id="kursus-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-3 py-3">NO</th>
                <th scope="col" class="px-3 py-3 w-52">Nama Kursus</th>
                <th scope="col" class="px-3 py-3">Harga</th>
                <th scope="col" class="px-3 py-3">Tingkat Kesulitan</th>
                <th scope="col" class="px-3 py-3">Status</th>
                <th scope="col" class="px-3 py-3">Tanggal Mulai</th>
                <th scope="col" class="px-3 py-3">Tanggal Selesai</th>
                <th scope="col" class="px-3 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kursus as $kursusItem)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-3 py-3">{{ $kursus->firstItem() + $loop->iteration - 1 }}</td>
                <td class="px-3 py-3 w-52">{{ $kursusItem->judul }}</td>
                <td class="px-3 py-3">Rp {{ number_format($kursusItem->harga, 0, ',', '.') }}</td>
                <td class="px-3 py-3">{{ $kursusItem->tingkat_kesulitan }}</td>
                <td class="px-3 py-3">{{ $kursusItem->status }}</td>
                <td class="px-3 py-3">{{ $kursusItem->tgl_mulai }}</td>
                <td class="px-3 py-3">{{ $kursusItem->tgl_selesai }}</td>
                <td class="px-3 py-3">
                    <button type="button" data-modal-target="my_modal_edit_{{ $kursusItem->kursus_id }}" data-modal-toggle="my_modal_edit_{{ $kursusItem->kursus_id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400 my-1 mr-2">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button type="button" data-modal-target="my_modal_delete_{{ $kursusItem->kursus_id }}" data-modal-toggle="my_modal_delete_{{ $kursusItem->kursus_id }}" class="font-medium text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-400">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </td>
            </tr>

           

            <!-- Modal Edit -->
            <div id="my_modal_edit_{{ $kursusItem->kursus_id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Edit Informasi Kursus
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="my_modal_edit_{{ $kursusItem->kursus_id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Tutup modal</span>
                            </button>
                        </div>
                        <!-- Isi Modal -->
                        <form action="{{ route('PengelolaanKursus.update', $kursusItem->kursus_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="p-4 md:p-5 bg-white dark:bg-gray-800 rounded-lg shadow-lg space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="judul" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Judul</label>
                                        <input type="text" name="judul" id="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('judul', $kursusItem->judul) }}">
                                        @error('judul')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="deskripsi" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('deskripsi', $kursusItem->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="tingkat_kesulitan" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Tingkat Kesulitan</label>
                                        <select name="tingkat_kesulitan" id="tingkat_kesulitan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="Pemula" {{ $kursusItem->tingkat_kesulitan == 'Pemula' ? 'selected' : '' }}>Pemula</option>
                                            <option value="Menengah" {{ $kursusItem->tingkat_kesulitan == 'Menengah' ? 'selected' : '' }}>Menengah</option>
                                            <option value="Lanjutan" {{ $kursusItem->tingkat_kesulitan == 'Lanjutan' ? 'selected' : '' }}>Lanjutan</option>
                                        </select>
                                        @error('tingkat_kesulitan')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="kategori_id" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Tingkat Kesulitan</label>
                                        <select name="kategori_id" id="kategori_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="-" disabled selected>Pilih Kategori</option>
                                            @foreach ($kategori as $item)
                                            <option value="{{ $item->kategori_id }}">{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="harga" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Harga</label>
                                        <input type="text" name="harga" id="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('harga', $kursusItem->harga) }}">
                                        @error('harga')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="tgl_mulai" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Tanggal Mulai</label>
                                        <input type="date" name="tgl_mulai" id="tgl_mulai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('tgl_mulai', $kursusItem->tgl_mulai) }}">
                                        @error('tgl_mulai')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="tgl_selesai" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Tanggal Selesai</label>
                                        <input type="date" name="tgl_selesai" id="tgl_selesai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('tgl_selesai', $kursusItem->tgl_selesai) }}">
                                        @error('tgl_selesai')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="kapasitas" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Kapasitas</label>
                                        <input type="number" name="kapasitas" id="kapasitas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('kapasitas', $kursusItem->kapasitas) }}">
                                        @error('kapasitas')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Foto Kursus -->
                                    <div>
                                        <label for="foto_kursus" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Foto Kursus</label>
                                        <input type="file" name="foto_kursus" id="foto_kursus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" accept="image/jpeg, image/png, image/gif, image/svg+xml">
                                        @error('foto_kursus')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="justify-right mb-2">
                                        @if($kursusItem->foto_kursus)
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Current image:</p>
                                        <img src="{{ asset('storage/'.$kursusItem->foto_kursus) }}" alt="Foto Kursus" class="w-full h- object-cover mt-2">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Tombol Update -->
                            <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-b">
                                <button type="submit" class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                                    Update Kursus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Hapus -->
            <div id="my_modal_delete_{{ $kursusItem->kursus_id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <form action="{{ route('PengelolaanKursus.destroy', $kursusItem->kursus_id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda Yakin Ingin Menghapus Ini?</h3>
                                <button data-modal-hide="my_modal_delete_{{ $kursusItem->kursus_id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Yakin
                                </button>
                                <button data-modal-hide="my_modal_delete_{{ $kursusItem->kursus_id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white">
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
            @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', (event) => {
                    Swal.fire({
                        position: "middle",
                        icon: "success",
                        title: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            </script>
            @endif

<!-- Pagination -->
<div class="flex justify-center items-center mt-5">
    <ul class="inline-flex -space-x-px text-sm">
        <li>
            <a href="{{ $kursus->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Sebelumnya
            </a>
        </li>
        <li>
            <a href="{{ $kursus->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Berikutnya
            </a>
        </li>
    </ul>
</div>

<!-- Menampilkan informasi data -->
<div class="mt-4 mb-5 text-center text-sm text-gray-600 dark:text-gray-400">
    Menampilkan {{ $kursus->firstItem() }} sampai {{ $kursus->lastItem() }} dari {{ $kursus->total() }} entri
</div>

<script>
    document.getElementById('table-search-users').addEventListener('input', function() {
        var searchTerm = this.value.toLowerCase(); // Ambil nilai pencarian dan konversi ke lowercase
        var rows = document.querySelectorAll('#kursus-table tbody tr'); // Ambil semua baris tabel

        rows.forEach(function(row) {
            var kursusName = row.cells[1].textContent.toLowerCase(); // Ambil Nama Kursus (kolom 2)
            var pelatihName = row.cells[2].textContent.toLowerCase(); // Ambil Nama Pelatih (kolom 3)
            var status = row.cells[3].textContent.toLowerCase(); // Ambil Status (kolom 4)

            // Periksa apakah ada kecocokan dengan kata pencarian
            if (kursusName.includes(searchTerm) || pelatihName.includes(searchTerm) || status.includes(searchTerm)) {
                row.style.display = ''; // Tampilkan baris jika cocok
            } else {
                row.style.display = 'none'; // Sembunyikan baris jika tidak cocok
            }
        });
    });
</script>

@endsection