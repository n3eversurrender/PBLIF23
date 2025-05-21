@extends('layouts.mainPelatih')

@section('MainPelatih')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-end flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
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
                <th scope="col" class="px-3 py-3">Nama Kursus</th>
                <th scope="col" class="px-3 py-3">Harga</th>
                <th scope="col" class="px-3 py-3">Tingkat Kesulitan</th>
                <th scope="col" class="px-3 py-3">Status</th>
                <th scope="col" class="px-3 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kursus as $kursusItem)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-3 py-3">{{ $kursus->firstItem() + $loop->iteration - 1 }}</td>
                <td class="px-3 py-3">{{ $kursusItem->judul }}</td>
                <td class="px-3 py-3">Rp {{ number_format($kursusItem->harga, 0, ',', '.') }}</td>
                <td class="px-3 py-3">{{ $kursusItem->tingkat_kesulitan }}</td>
                <td class="px-3 py-3">{{ $kursusItem->status }}</td>
                <td class="px-3 py-3">
                    <a href="{{ url('/TambahKurikulum', $kursusItem->kursus_id) }}" class="font-medium text-green-600 dark:text-green-500 hover:text-green-700 dark:hover:text-green-400 my-1 mr-2">
                        <i class="fas fa-plus-circle"></i> Tambah Kurikulum
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


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