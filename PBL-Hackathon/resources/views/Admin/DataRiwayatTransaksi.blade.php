@extends('layouts.mainAdmin')

@section('MainAdmin')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-end flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
        <div class="relative">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" id="table-search-payments" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Data">
        </div>
    </div>
    <table id="pembayaran" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">No</th>
                <th scope="col" class="px-6 py-3">ID Pendaftaran</th>
                <th scope="col" class="px-6 py-3">Nama Kursus</th>
                <th scope="col" class="px-6 py-3">Metode Pembayaran</th>
                <th scope="col" class="px-6 py-3">Harga</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembayaranList as $index => $pembayaran)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-3 py-3 text-center">{{ $pembayaranList->firstItem() + $loop->iteration - 1 }}</td>
                <td class="px-6 py-4">
                    @if ($pembayaran->pendaftaran && $pembayaran->pendaftaran->pengguna)
                    ({{ $pembayaran->pendaftaran->pendaftaran_id }}) {{ $pembayaran->pendaftaran->pengguna->nama }}
                    @else
                    Tidak Ada Data
                    @endif
                </td>
                <td class="px-6 py-4">
                    @if ($pembayaran->pendaftaran && $pembayaran->pendaftaran->kursus)
                    {{ $pembayaran->pendaftaran->kursus->judul }}
                    @else
                    Tidak Ada Data
                    @endif
                </td>
                <td class="px-6 py-4">{{ $pembayaran->metode_pembayaran }}</td>
                <td class="px-6 py-4">Rp {{ number_format($pembayaran->jumlah, 2, ',', '.') }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-sm rounded 
                    @if($pembayaran->status == 'Berhasil') bg-green-500 text-white
                    @elseif($pembayaran->status == 'Pending') bg-yellow-500 text-white
                    @else bg-red-500 text-white @endif">
                        {{ $pembayaran->status }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <!-- Tombol Hapus -->
                    <button type="button" data-modal-target="my_modal_delete_{{ $pembayaran->pembayaran_id }}" data-modal-toggle="my_modal_delete_{{ $pembayaran->pembayaran_id }}" class="font-medium text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-400">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </td>
            </tr>

            <!-- Modal Hapus Pembayaran -->
            <div id="my_modal_delete_{{ $pembayaran->pembayaran_id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <form action="{{ route('pembayaran.destroy', $pembayaran->pembayaran_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda Yakin Ingin Menghapus Data Pembayaran Ini?</h3>
                                <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Yakin
                                </button>
                                <button type="button" data-modal-hide="my_modal_delete_{{ $pembayaran->pembayaran_id }}" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white">
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

    <!-- Pagination -->
    <div class="flex justify-center items-center mt-5">
        <ul class="inline-flex -space-x-px text-sm">
            <!-- Previous Button -->
            <li>
                <a href="{{ $pembayaranList->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Sebelumnya
                </a>
            </li>

            <!-- Next Button -->
            <li>
                <a href="{{ $pembayaranList->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Berikutnya
                </a>
            </li>
        </ul>
    </div>

    <!-- Menampilkan informasi data -->
    <div class="mt-4 mb-5 text-center text-sm text-gray-600 dark:text-gray-400">
        Menampilkan {{ $pembayaranList->firstItem() }} sampai {{ $pembayaranList->lastItem() }} dari {{ $pembayaranList->total() }} entri
    </div>
</div>

<script>
    // Fungsi untuk pencarian tabel pembayaran
    document.getElementById('table-search-payments').addEventListener('input', function() {
        var searchTerm = this.value.toLowerCase(); // Ambil nilai pencarian
        var rows = document.querySelectorAll('#pembayaran tbody tr');

        rows.forEach(row => {
            let textContent = row.textContent.toLowerCase(); // Ambil konten teks dari setiap baris
            if (textContent.indexOf(searchTerm) !== -1) {
                row.style.display = ''; // Tampilkan baris jika ditemukan
            } else {
                row.style.display = 'none'; // Sembunyikan baris jika tidak ditemukan
            }
        });
    });
</script>

@endsection