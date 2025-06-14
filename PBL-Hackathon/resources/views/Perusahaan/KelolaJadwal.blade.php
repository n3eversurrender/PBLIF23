@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')

<main>
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 text-sm text-gray-500 pb-6">
        <a href="/jadwal" class="hover:text-blue-600 transition">Jadwal</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-blue-600 font-medium">Kelola Jadwal</span>
    </div>

    <div class="text-center mb-5">
        <h2 class="text-2xl font-bold">Tambah Jadwal</h2>
        <p class="text-lg font-semibold text-gray-700">{{ $kursus->judul }}</p>
    </div>

    <div class="">
        <!-- Tombol untuk membuka modal -->
        <div class="flex justify-end sm:mt-6 mt-4">
            <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                <i class="fa-solid fa-plus me-3"></i>Tambah Jadwal
            </button>
        </div>

        <!-- Modal -->
        <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Tambah Jadwal</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form method="POST" action="{{ route('KelolaJadwal.simpan') }}">
                            @csrf
                            <input type="hidden" name="kursus_id" value="{{ $kursus->kursus_id }}">

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Sesi</label>
                                <input type="text" name="sesi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                                <input type="date" name="tanggal" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                                <input type="time" name="jam_mulai" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                                <input type="time" name="jam_selesai" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                                <input type="text" name="lokasi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="flex justify-end space-x-2">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg text-sm px-5 py-2.5">Simpan</button>
                                <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 text-sm font-medium bg-white rounded-lg border border-gray-200 hover:bg-gray-100">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Jadwal -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-400 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Sesi</th>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Waktu</th>
                        <th scope="col" class="px-6 py-3">Lokasi</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4">{{ $item->sesi }}</th>
                        <td class="px-6 py-4">{{ $item->tanggal }}</td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($item->jam_mulai)->format('g:i A') }} - {{ \Carbon\Carbon::parse($item->jam_selesai)->format('g:i A') }}
                        </td>
                        <td class="px-6 py-4">{{ $item->lokasi }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-4 justify-center items-center h-full">
                                <!-- Tombol Edit -->
                                <button data-modal-target="my_modal_edit_{{ $item->jadwal_id }}" data-modal-toggle="my_modal_edit_{{ $item->jadwal_id }}" class="text-blue-600 hover:text-blue-900 mr-2">
                                    Edit
                                </button>
                                <!-- Tombol Hapus -->
                                <button type="button" data-modal-target="my_modal_delete_{{ $item->jadwal_id }}" data-modal-toggle="my_modal_delete_{{ $item->jadwal_id }}" class="font-medium text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-400">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Edit Jadwal -->
                    <div id="my_modal_edit_{{ $item->jadwal_id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-6 w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                            <div class="relative bg-white rounded-lg shadow-lg dark:bg-gray-700">
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Edit Jadwal
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="my_modal_edit_{{ $item->jadwal_id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Tutup modal</span>
                                    </button>
                                </div>

                                <!-- Isi Modal -->
                                <form action="{{ route('KelolaJadwal.update', $item->jadwal_id) }}" method="POST">
                                    @csrf

                                    <div class="p-6 space-y-4 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                                        <!-- Sesi -->
                                        <div class="mb-4">
                                            <label for="sesi" class="block text-sm font-semibold text-gray-700 dark:text-gray-400">Sesi</label>
                                            <input type="text" name="sesi" id="sesi" value="{{ old('sesi', $item->sesi) }}"
                                                class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                                        </div>

                                        <!-- Tanggal -->
                                        <div class="mb-4">
                                            <label for="tanggal" class="block text-sm font-semibold text-gray-700 dark:text-gray-400">Tanggal</label>
                                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $item->tanggal) }}"
                                                class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                                        </div>

                                        <!-- Jam Mulai -->
                                        <div class="mb-4">
                                            <label for="jam_mulai" class="block text-sm font-semibold text-gray-700 dark:text-gray-400">Jam Mulai</label>
                                            <input type="time" name="jam_mulai" id="jam_mulai" value="{{ \Carbon\Carbon::parse(old('jam_mulai', $item->jam_mulai))->format('H:i') }}"
                                                class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                                        </div>

                                        <!-- Jam Selesai -->
                                        <div class="mb-4">
                                            <label for="jam_selesai" class="block text-sm font-semibold text-gray-700 dark:text-gray-400">Jam Selesai</label>
                                            <input type="time" name="jam_selesai" id="jam_selesai" value="{{ \Carbon\Carbon::parse(old('jam_selesai', $item->jam_selesai))->format('H:i') }}"
                                                class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                                        </div>

                                        <!-- Lokasi -->
                                        <div class="mb-4">
                                            <label for="lokasi" class="block text-sm font-semibold text-gray-700 dark:text-gray-400">Lokasi</label>
                                            <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $item->lokasi) }}"
                                                class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                                        </div>

                                        <!-- Tombol -->
                                        <div class="flex justify-end gap-3 mt-6">
                                            <button type="button" onclick="window.history.back()"
                                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                                                Batal
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- Modal Delete Jadwal -->
                    <div id="my_modal_delete_{{ $item->jadwal_id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <form action="{{ route('KelolaJadwal.hapus', $item->jadwal_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin menghapus jadwal ini?</h3>
                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Yakin
                                        </button>
                                        <button type="button" data-modal-hide="my_modal_delete_{{ $item->jadwal_id }}" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white">
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
    </div>
</main>

@endsection