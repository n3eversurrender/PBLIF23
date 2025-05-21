@extends('layouts.mainPeserta')

@section('MainPeserta')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div
        class="flex items-center justify-end flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
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

    <table id="kursus-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">NO</th>
                <th scope="col" class="px-6 py-3">Nama Kursus</th>
                <th scope="col" class="px-6 py-3">Pelatih</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Sertifikat</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftaran as $pendaftaranItem)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4 text-center">{{ $pendaftaran->firstItem() + $loop->iteration - 1 }}</td>
                <td class="px-6 py-4">{{ $pendaftaranItem->kursus->judul }}</td>
                <td class="px-6 py-4">
                    {{ $pendaftaranItem->kursus->pengguna ? $pendaftaranItem->kursus->pengguna->nama : 'Tidak ada pelatih' }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                        @if($pendaftaranItem->status_pendaftaran)
                        {{ $pendaftaranItem->status_pendaftaran }}
                        @else
                        Belum terdaftar
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4">
                    @if($pendaftaranItem->status_pendaftaran == "Selesai")
                    <!-- Button Sertifikat (Download PDF) -->
                    <a href="{{ route('DaftarPelatihan.sertifikat', $pendaftaranItem->pendaftaran_id) }}"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400 mr-3">
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                    @endif

                    <!-- Button Detail -->
                <td class="px-6 py-4 flex space-x-3">
                    <!-- Button Detail -->
                    <button type="button" data-modal-target="my_modal_detail_{{ $pendaftaranItem->pendaftaran_id }}"
                        data-modal-toggle="my_modal_detail_{{ $pendaftaranItem->pendaftaran_id }}"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400">
                        <i class="fas fa-eye"></i> Detail
                    </button>

                    <!-- Button Hapus -->
                    <button type="button" data-modal-target="my_modal_delete_{{ $pendaftaranItem->pendaftaran_id }}"
                        data-modal-toggle="my_modal_delete_{{ $pendaftaranItem->pendaftaran_id }}"
                        class="font-medium text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-400">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </td>


            </tr>

            <!-- Modal Detail -->
            <div id="my_modal_detail_{{ $pendaftaranItem->pendaftaran_id }}" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Detail Informasi
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="my_modal_detail_{{ $pendaftaranItem->pendaftaran_id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Tutup modal</span>
                            </button>
                        </div>
                        <!-- Isi Modal -->
                        <div class="p-4 md:p-5 bg-white dark:bg-gray-800 rounded-lg shadow-lg space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-1 gap-4">
                                <div class="space-y-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <p class="text-md font-bold text-gray-500 dark:text-gray-400 w-44">Judul</p>
                                            <p class="text-sm text-gray-800 dark:text-gray-200 w-44">
                                                {{ $pendaftaranItem->kursus->judul }}</p>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-md font-bold text-gray-500 dark:text-gray-400">Pelatih</p>
                                            <p class="text-sm text-gray-800 dark:text-gray-200">
                                                {{ $pendaftaranItem->pengguna->nama ?? 'Tidak ada pelatih' }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <p class="text-md font-bold text-gray-500 dark:text-gray-400">Deskripsi</p>
                                            <p class="text-sm text-gray-800 dark:text-gray-200">
                                                {{ $pendaftaranItem->kursus->deskripsi }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <p class="text-md font-bold text-gray-500 dark:text-gray-400">Tanggal Mulai
                                            </p>
                                            <p class="text-sm text-gray-800 dark:text-gray-200">
                                                {{ $pendaftaranItem->kursus->tgl_mulai }}</p>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-md font-bold text-gray-500 dark:text-gray-400">Tanggal
                                                Selesai</p>
                                            <p class="text-sm text-gray-800 dark:text-gray-200">
                                                {{ $pendaftaranItem->kursus->tgl_selesai }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <p class="text-md font-bold text-gray-500 dark:text-gray-400">Harga</p>
                                            <p class="text-sm text-gray-800 dark:text-gray-200">Rp.
                                                {{ number_format($pendaftaranItem->kursus->harga, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-md font-bold text-gray-500 dark:text-gray-400">Status
                                                Pendaftaran</p>
                                            <p class="text-base text-gray-800 dark:text-gray-200">
                                                @if($pendaftaranItem->status_pendaftaran)
                                                {{ $pendaftaranItem->status_pendaftaran }}
                                                @else
                                                Belum terdaftar
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Hapus -->
            <div id="my_modal_delete_{{ $pendaftaranItem->pendaftaran_id }}" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <form action="{{ route('DaftarPelatihan.destroy', $pendaftaranItem->pendaftaran_id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda Yakin
                                    Ingin Menghapus Ini?</h3>
                                <button data-modal-hide="my_modal_delete_{{ $pendaftaranItem->pendaftaran_id }}"
                                    type="submit"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Yakin
                                </button>
                                <button data-modal-hide="my_modal_delete_{{ $pendaftaranItem->pendaftaran_id }}"
                                    type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white">
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

<!-- Pagination -->
<div class="flex justify-center items-center mt-5">
    <ul class="inline-flex -space-x-px text-sm">
        <li>
            <a href="{{ $pendaftaran->previousPageUrl() }}"
                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Sebelumnya
            </a>
        </li>
        <li>
            <a href="{{ $pendaftaran->nextPageUrl() }}"
                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Berikutnya
            </a>
        </li>
    </ul>
</div>

<!-- Menampilkan informasi data -->
<div class="mt-4 mb-5 text-center text-sm text-gray-600 dark:text-gray-400">
    Menampilkan {{ $pendaftaran->firstItem() }} sampai {{ $pendaftaran->lastItem() }} dari {{ $pendaftaran->total() }}
    entri
</div>


<script>
    document.getElementById('table-search-users').addEventListener('input', function () {
        var searchTerm = this.value.toLowerCase(); // Ambil nilai pencarian dan konversi ke lowercase
        var rows = document.querySelectorAll('#kursus-table tbody tr'); // Ambil semua baris tabel

        rows.forEach(function (row) {
            var kursusName = row.cells[1].textContent.toLowerCase(); // Ambil Nama Kursus (kolom 2)
            var pelatihName = row.cells[2].textContent.toLowerCase(); // Ambil Nama Pelatih (kolom 3)
            var status = row.cells[3].textContent.toLowerCase(); // Ambil Status (kolom 4)

            // Periksa apakah ada kecocokan dengan kata pencarian
            if (kursusName.includes(searchTerm) || pelatihName.includes(searchTerm) || status.includes(
                    searchTerm)) {
                row.style.display = ''; // Tampilkan baris jika cocok
            } else {
                row.style.display = 'none'; // Sembunyikan baris jika tidak cocok
            }
        });
    });

</script>


@endsection
