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
            <input type="text" id="table-search-users" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Data">
        </div>
    </div>
    <table id="peserta-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">No</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">No Telepon</th>
                <th scope="col" class="px-6 py-3">Peran</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penggunaList as $index => $pengguna)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-3 py-3 text-center">{{ $penggunaList->firstItem() + $loop->iteration - 1 }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <img class="w-10 h-10 rounded-full" src="{{ asset($pengguna->foto_profil ?? 'image/9203764.png') }}" alt="{{ $pengguna->nama }}">
                        <div class="ps-3">
                            <div class="text-base font-semibold">{{ $pengguna->nama }}</div>
                            <div class="font-normal text-gray-500">{{ $pengguna->email }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <a href="https://wa.me/{{ $pengguna->no_telepon }}" target="_blank" class="text-blue-500 hover:underline">
                        {{ $pengguna->no_telepon }}
                    </a>
                </td>
                <td class="px-6 py-4">{{ $pengguna->peran }}</td>
                <td class="px-6 py-4">
                    @if($pengguna->status == 'Aktif')
                    <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                        <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                        Aktif
                    </span>
                    @elseif($pengguna->status == 'Tidak Aktif')
                    <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                        <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                        Tidak Aktif
                    </span>
                    @else
                    <span class="inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-gray-900 dark:text-gray-300">
                        <span class="w-2 h-2 me-1 bg-gray-500 rounded-full"></span>
                        No Status
                    </span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <button type="button" data-modal-target="my_modal_view_{{ $pengguna->pengguna_id }}" data-modal-toggle="my_modal_view_{{ $pengguna->pengguna_id }}" class="font-medium text-green-600 dark:text-green-500 hover:text-green-700 dark:hover:text-green-400 my-1 mr-2">
                        <i class="fas fa-eye"></i> Lihat
                    </button>
                    <!-- Tombol Hapus -->
                    <button type="button" data-modal-target="my_modal_delete_{{ $pengguna->pengguna_id }}" data-modal-toggle="my_modal_delete_{{ $pengguna->pengguna_id }}" class="font-medium text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-400">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </td>
            </tr>
            <!-- sweetalert -->
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


            <!-- Modal Lihat peserta -->
            <div id="my_modal_view_{{ $pengguna->pengguna_id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Detail peserta
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="my_modal_view_{{ $pengguna->pengguna_id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Tutup modal</span>
                            </button>
                        </div>
                        <div class="p-4 md:p-5 bg-white dark:bg-gray-800">
                            <div class="flex items-center space-x-4 mb-4">
                                <img class="w-16 h-16 rounded-full" src="{{ asset($pengguna->foto_profil ?? 'image/9203764.png') }}" alt="{{ $pengguna->nama }}">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $pengguna->nama }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $pengguna->email }}</p>
                                </div>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300 space-y-2">
                                <div class="space-y-2">
                                    <div class="flex items-start space-x-2">
                                        <p class="w-32 font-semibold">Jenis Kelamin</p>:
                                        <p>{{ $pengguna->jenis_kelamin }}</p>
                                    </div>
                                    <div class="flex items-start space-x-2">
                                        <p class="w-32 font-semibold">No Telepon</p>:
                                        <p><a href="https://wa.me/{{ $pengguna->no_telepon }}" target="_blank" class="text-blue-500 hover:underline">{{ $pengguna->no_telepon }}</a></p>
                                    </div>
                                    <div class="flex items-start space-x-2">
                                        <p class="w-32 font-semibold">Alamat</p>:
                                        <p>{{ $pengguna->alamat }}</p>
                                    </div>

                                    <div class="flex items-start space-x-2">
                                        <p class="w-32 font-semibold">Peran</p>:
                                        <p>{{ $pengguna->peran }}</p>
                                    </div>
                                    <div class="flex items-start space-x-2">
                                        <p class="w-32 font-semibold">Status</p>:
                                        <p>
                                            @if($pengguna->status == 'Aktif')
                                            <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                                Aktif
                                            </span>
                                            @elseif($pengguna->status == 'Tidak Aktif')
                                            <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                                <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                                Tidak Aktif
                                            </span>
                                            @else
                                            <span class="inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-gray-900 dark:text-gray-300">
                                                <span class="w-2 h-2 me-1 bg-gray-500 rounded-full"></span>
                                                No Status
                                            </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="relative my-6">
                                    <hr class="border-gray-300 dark:border-gray-600">
                                    <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white px-3 text-sm font-medium text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                                        Informasi Lainnya
                                    </span>
                                    <hr class="border-gray-300 dark:border-gray-600">
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-start space-x-2">
                                        <p class="w-32 font-semibold">Pengalaman</p>:
                                        <p>{{ $pengguna->peserta->pengalaman_kerja ?? 'Tidak ada data' }} tahun</p>
                                    </div>
                                    <div class="flex items-start space-x-2">
                                        <p class="w-32 font-semibold">Keahlian</p>:
                                        <p>{{ $pengguna->peserta->nama_keahlian ?? 'Tidak ada data' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Hapus Peserta -->
            <div id="my_modal_delete_{{ $pengguna->pengguna_id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <form action="{{ route('pengguna.destroy', $pengguna->pengguna_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda Yakin Ingin Menghapus Peserta Ini?</h3>
                                <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Yakin
                                </button>
                                <button type="button" data-modal-hide="my_modal_delete_{{ $pengguna->pengguna_id }}" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white">
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
                <a href="{{ $penggunaList->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Sebelumnya
                </a>
            </li>

            <!-- Next Button -->
            <li>
                <a href="{{ $penggunaList->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Berikutnya
                </a>
            </li>
        </ul>
    </div>

    <!-- Menampilkan informasi data -->
    <div class="mt-4 mb-5 text-center text-sm text-gray-600 dark:text-gray-400">
        Menampilkan {{ $penggunaList->firstItem() }} sampai {{ $penggunaList->lastItem() }} dari {{ $penggunaList->total() }} entri
    </div>

    <script>
        document.getElementById('table-search-users').addEventListener('input', function() {
            var searchTerm = this.value.toLowerCase(); // Ambil nilai pencarian dan konversi ke lowercase
            var rows = document.querySelectorAll('#peserta-table tbody tr'); // Menggunakan ID peserta-table

            rows.forEach(function(row) {
                var name = row.cells[1].textContent.toLowerCase(); // Ambil Nama Peserta (kolom 2)
                var gender = row.cells[2].textContent.toLowerCase(); // Ambil Jenis Kelamin (kolom 3)
                var phone = row.cells[3].textContent.toLowerCase(); // Ambil No Telepon (kolom 4)
                var address = row.cells[4].textContent.toLowerCase(); // Ambil Alamat (kolom 5)
                var role = row.cells[5].textContent.toLowerCase(); // Ambil Peran (kolom 6)

                // Periksa apakah ada kecocokan dengan kata pencarian
                if (name.includes(searchTerm) || gender.includes(searchTerm) || phone.includes(searchTerm) || address.includes(searchTerm) || role.includes(searchTerm)) {
                    row.style.display = ''; // Tampilkan baris jika cocok
                } else {
                    row.style.display = 'none'; // Sembunyikan baris jika tidak cocok
                }
            });
        });
    </script>


    @endsection