@extends('layouts.mainPelatih')

@section('MainPelatih')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div
        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
        <div>
            @if(Auth::check() && Auth::user()->peran == 'Pelatih' && Auth::user()->status == 'Aktif')
            <a href="/TambahSertifikat"
                class="flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                <i class="fas fa-plus mr-2"></i>
                Tambah Sertifikat
            </a>
            @else
            <button
                class="flex items-center px-4 py-2 bg-gray-400 text-white font-semibold rounded-lg cursor-not-allowed"
                disabled>
                <i class="fas fa-plus mr-2"></i>
                Tambah Sertifikat
            </button>
            @endif
        </div>

        <div class="relative">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" id="table-search-users"
                class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Cari Data">
        </div>
    </div>
    <table id="kursus-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">Nomor</th>
                <th scope="col" class="px-6 py-3">File Sertifikat</th>
                <th scope="col" class="px-6 py-3">Nama Kursus</th>
                <th scope="col" class="px-6 py-3">Nomor Sertifikat</th>
                <th scope="col" class="px-6 py-3">Tanggal Terbit</th>
                <th scope="col" class="px-6 py-3 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sertifikat as $srtf)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-3 py-4 text-center">
                    {{ $loop->iteration + ($sertifikat->currentPage() - 1) * $sertifikat->perPage() }}
                </td>
                <td class="px-6 py-4 truncate max-w-xs">{{ $srtf->file_sertifikat }}</td>
                <td class="px-6 py-4">{{ $srtf->nama_kursus }}</td>
                <td class="px-6 py-4">{{ $srtf->nomor_sertifikat }}</td>
                <td class="px-6 py-4">{{ $srtf->tanggal_terbit }}</td>
                <td class="px-3 py-3">
                    <button type="button" data-modal-target="my_modal_edit_{{ $srtf->sertifikat_id }}" data-modal-toggle="my_modal_edit_{{ $srtf->sertifikat_id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400 my-1 mr-2">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button type="button" data-modal-target="my_modal_delete_{{ $srtf->sertifikat_id }}" data-modal-toggle="my_modal_delete_{{ $srtf->sertifikat_id }}" class="font-medium text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-400">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div id="my_modal_edit_{{ $srtf->sertifikat_id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Edit Informasi Sertifikat
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="my_modal_edit_{{ $srtf->sertifikat_id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Tutup modal</span>
                            </button>
                        </div>
                        <form action="{{ route('sertifikat.update', $srtf->sertifikat_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="p-4 md:p-5 space-y-4">
                                <div>
                                    <label for="file_sertifikat" class="text-sm font-semibold text-gray-500 dark:text-gray-400">File Sertifikat</label>
                                    <input type="file" name="file_sertifikat" id="file_sertifikat" class="mt-1 p-2 border border-gray-300 rounded w-full" accept="application/pdf">
                                        @error('file_sertifikat')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                            </div>
                                <div>
                                    <label for="nama_kursus" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Nama Kursus</label>
                                    <input type="text" name="nama_kursus" id="nama_kursus" class="block w-full text-sm p-2 border rounded-lg" value="{{ old('nama_kursus', $srtf->nama_kursus) }}">
                                        @error('nama_kursus')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                            </div>
                                <div>
                                    <label for="nomor_sertifikat" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Nomor Sertifikat</label>
                                    <input type="text" name="nomor_sertifikat" id="nomor_sertifikat" class="block w-full text-sm p-2 border rounded-lg" value="{{ old('nomor_sertifikat', $srtf->nomor_sertifikat) }}">
                                </div>
                                <div>
                                    <label for="tanggal_terbit" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Tanggal Terbit</label>
                                    <input type="date" name="tanggal_terbit" id="tanggal_terbit" class="block w-full text-sm p-2 border rounded-lg" value="{{ old('tanggal_terbit', $srtf->tanggal_terbit) }}">
                                </div>
                                    @error('nomor_sertifikat')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-b">
                                <button type="submit" class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Update Sertifikat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Hapus -->
            <div id="my_modal_delete_{{ $srtf->sertifikat_id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <form action="{{ route('sertifikat.delete', $srtf->sertifikat_id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda Yakin Ingin Menghapus Sertifikat Ini?</h3>
                                <button type="submit" class="px-5 py-2.5 text-white bg-red-600 hover:bg-red-800 rounded-lg">Yakin</button>
                                <button type="button" data-modal-hide="my_modal_delete_{{ $srtf->sertifikat_id }}" class="px-5 py-2.5 text-sm text-gray-900 bg-white rounded-lg border hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-400">Tidak Yakin</button>
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
        <!-- Previous Page Link -->
        <li>
            <a href="{{ $sertifikat->previousPageUrl() }}"
                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Sebelumnya
            </a>
        </li>
        <!-- Next Page Link -->
        <li>
            <a href="{{ $sertifikat->nextPageUrl() }}"
                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Berikutnya
            </a>
        </li>
    </ul>
</div>

<!-- Display Pagination Info -->
<div class="mt-4 mb-5 text-center text-sm text-gray-600 dark:text-gray-400">
    Menampilkan {{ $sertifikat->firstItem() }} sampai {{ $sertifikat->lastItem() }} dari {{ $sertifikat->total() }}
    entri
</div>
@endsection


<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('table-search-users').addEventListener('input', function() {
            var searchTerm = this.value
                .toLowerCase(); // Ambil istilah pencarian dan konversi ke lowercase
            var rows = document.querySelectorAll('#kursus-table tbody tr'); // Ambil semua baris tabel

            rows.forEach(function(row) {
                // Cek apakah ada nilai dalam setiap sel di baris yang sesuai dengan istilah pencarian
                var isMatch = Array.from(row.cells).some(function(cell) {
                    return cell.textContent.toLowerCase().includes(searchTerm);
                });

                if (isMatch) {
                    row.style.display = ''; // Tampilkan baris jika cocok
                } else {
                    row.style.display = 'none'; // Sembunyikan baris jika tidak cocok
                }
            });
        });
    });
</script>