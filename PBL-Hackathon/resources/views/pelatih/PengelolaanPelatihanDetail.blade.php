@extends('layouts.mainPelatih')

@section('MainPelatih')

<div class="lg:flex sm:grid sm:grid-cols-12 items-start">
    <figure class="max-w-96 sm:col-span-4">
        <img class="h-48 w-full object-cover md:h-full md:w-48 border-r border-gray-300 rounded-lg"
            src="{{ $kursus->foto_kursus ? asset('storage/' . $kursus->foto_kursus) : asset('image/Thumnnail.jpg') }}"
            alt="Course Image" />
    </figure>
    <div class="lg:ml-4 sm:col-span-8">
        <h1 class="text-lg lg:text-2xl font-bold">{{ $kursus->judul }}</h1>
        <p class="mt-2 text-xs lg:text-sm text-gray-600">{{ $kursus->deskripsi }}</p>
    </div>
</div>

<hr class="h-px bg-gray-200 border-0 dark:bg-gray-700 mt-5 mb-5">

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-end flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" id="table-search-users" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for users">
        </div>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">NO</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Gender</th>
                <th scope="col" class="px-6 py-3">Phone Number</th>
                <th scope="col" class="px-6 py-3">Address</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftaran as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4">{{ $pendaftaran->firstItem() + $loop->iteration - 1 }}</td>
                <td class="px-6 py-4">{{ $item->pengguna->nama }}</td>
                <td class="px-6 py-4">{{ $item->pengguna->jenis_kelamin }}</td>
                <td class="px-6 py-4">{{ $item->pengguna->no_telepon }}</td>
                <td class="px-6 py-4">{{ $item->pengguna->alamat }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        @php
                        $statusColor = match($item->status_pendaftaran ?? 'Tidak Diketahui') {
                        'Menunggu' => 'bg-yellow-500', // Warna untuk status Menunggu
                        'Aktif' => 'bg-green-500', // Warna untuk status Aktif
                        'Selesai' => 'bg-blue-500', // Warna untuk status Selesai
                        'Dibatalkan' => 'bg-red-500', // Warna untuk status Dibatalkan
                        default => 'bg-gray-500', // Warna default
                        };
                        @endphp
                        <div class="h-2.5 w-2.5 rounded-full {{ $statusColor }} me-2"></div>
                        {{ $item->status_pendaftaran ?? 'Tidak Diketahui' }}
                    </div>

                </td>
                <td class="px-6 py-4">
                    <button data-modal-target="my_modal_edit_{{ $item->pengguna->pengguna_id }}" data-modal-toggle="my_modal_edit_{{ $item->pengguna->pengguna_id }}" class="text-blue-600 hover:text-blue-900 mr-2">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button type="button" data-modal-target="my_modal_delete_{{ $item->pendaftaran_id }}" data-modal-toggle="my_modal_delete_{{ $item->pendaftaran_id }}" class="font-medium text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-400">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </td>
            </tr>

            <div id="my_modal_edit_{{ $item->pengguna->pengguna_id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Konten Modal -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Header Modal -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Update Status Pendaftaran
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="my_modal_edit_{{ $item->pengguna->pengguna_id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Tutup modal</span>
                            </button>
                        </div>
                        <!-- Isi Modal -->
                        <form action="{{ route('pendaftaran.update', $item->pendaftaran_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="p-4 md:p-5 bg-white dark:bg-gray-800 rounded-lg shadow-lg space-y-4">
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <label for="status_pendaftaran" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Status</label>
                                        <select id="status_pendaftaran" name="status_pendaftaran" class="mt-1 p-2 border border-gray-300 rounded w-full">
                                            <option value="Aktif" {{ $item->status_pendaftaran == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="Selesai" {{ $item->status_pendaftaran == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="Dibatalkan" {{ $item->status_pendaftaran == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Tombol Update -->
                            <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-b">
                                <button type="submit" class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                                    Perbarui Status
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Hapus -->
            <div id="my_modal_delete_{{ $item->pendaftaran_id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <form action="{{ route('Pendaftaran.destroy', $item->pendaftaran_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda Yakin Ingin Menghapus Pendaftaran Ini?</h3>
                                <button data-modal-hide="my_modal_delete_{{ $item->pendaftaran_id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Yakin
                                </button>
                                <button data-modal-hide="my_modal_delete_{{ $item->pendaftaran_id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white">
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
        <!-- Previous Page Link -->
        <li>
            <a href="{{ $pendaftaran->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Sebelumnya
            </a>
        </li>
        <!-- Next Page Link -->
        <li>
            <a href="{{ $pendaftaran->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Berikutnya
            </a>
        </li>
    </ul>
</div>

<!-- Display Pagination Info -->
<div class="mt-4 mb-5 text-center text-sm text-gray-600 dark:text-gray-400">
    Menampilkan {{ $pendaftaran->firstItem() }} sampai {{ $pendaftaran->lastItem() }} dari {{ $pendaftaran->total() }} entri
</div>
@endsection