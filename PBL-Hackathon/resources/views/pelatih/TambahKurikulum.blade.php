@extends('layouts.mainPelatih')

@section('MainPelatih')

<div>
    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Tambah Kurikulum
    </button>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <h2 class="text-lg sm:text-xl font-bold text-gray-700 dark:text-white my-5">
        Kurikulum untuk Kursus: {{ $kursus->judul }}
    </h2>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-3 py-3">NO</th>
                <th scope="col" class="px-3 py-3">Nama Topik</th>
                <th scope="col" class="px-3 py-3">Deskripsi</th>
                <th scope="col" class="px-3 py-3">Durasi</th>
                <th scope="col" class="px-3 py-3">Materi</th>
                <th scope="col" class="px-3 py-3">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kurikulum as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-3 py-3">{{ $kurikulum->firstItem() + $loop->iteration - 1 }}</td>
                <td class="px-3 py-3">{{ $item->nama_topik }}</td>
                <td class="px-3 py-3">{{ $item->deskripsi }}</td>
                <td class="px-3 py-3">{{ $item->durasi }}</td>
                <td class="px-3 py-3 max-w-xs truncate">{{ $item->materi }}</td>
                <td class="px-3 py-3">
                    <!-- Tombol Edit -->
                    <button type="button" data-modal-target="my_modal_edit_{{ $item->kurikulum_id }}" data-modal-toggle="my_modal_edit_{{ $item->kurikulum_id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400 my-1 mr-2">
                        <i class="fas fa-edit"></i> Edit
                    </button>

                    <!-- Tombol Hapus -->
                    <button type="button" data-modal-target="my_modal_delete_{{ $item->kurikulum_id }}" data-modal-toggle="my_modal_delete_{{ $item->kurikulum_id }}" class="font-medium text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-400">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </td>
            </tr>

            <!-- Modal Update -->
            <div id="my_modal_edit_{{ $item->kurikulum_id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Header Modal -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Edit Kurikulum: {{ $item->nama_topik }}
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="my_modal_edit_{{ $item->kurikulum_id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Tutup modal</span>
                            </button>
                        </div>
                        <!-- Isi Modal -->
                        <form action="{{ route('PengelolaanKurikulum.update', $item->kurikulum_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="p-4 md:p-5 bg-white dark:bg-gray-800 rounded-lg shadow-lg space-y-4">
                                <div>
                                    <label for="nama_topik" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Nama Topik</label>
                                    <input type="text" name="nama_topik" id="nama_topik" class="mt-1 p-2 border border-gray-300 rounded w-full" value="{{ old('nama_topik', $item->nama_topik) }}" required>
                                </div>
                                <div>
                                    <label for="deskripsi" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" class="mt-1 p-2 border border-gray-300 rounded w-full" required>{{ old('deskripsi', $item->deskripsi) }}</textarea>
                                </div>
                                <div>
                                    <label for="durasi" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Durasi (Menit)</label>
                                    <input type="number" name="durasi" id="durasi" class="mt-1 p-2 border border-gray-300 rounded w-full" value="{{ old('durasi', $item->durasi) }}" required>
                                </div>
                                <div>
                                    <label for="materi" class="text-sm font-semibold text-gray-500 dark:text-gray-400">Materi</label>
                                    <input type="text" name="materi" id="materi" class="mt-1 p-2 border border-gray-300 rounded w-full" value="{{ old('materi', $item->materi) }}" required>
                                </div>
                            </div>
                            <!-- Tombol Update -->
                            <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-b">
                                <button type="submit" class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                                    Update Kurikulum
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Hapus -->
            <div id="my_modal_delete_{{ $item->kurikulum_id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                Apakah Anda yakin ingin menghapus topik "<strong>{{ $item->nama_topik }}</strong>"?
                            </h3>
                            <form action="{{ route('PengelolaanKurikulum.destroy', $item->kurikulum_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Hapus
                                </button>
                                <button type="button" data-modal-hide="my_modal_delete_{{ $item->kurikulum_id }}" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white">
                                    Batal
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


<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Kurikulum
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('kurikulum.store') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <input type="hidden" name="kursus_id" value="{{ $kursus_id }}">
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div class="col-span-1">
                        <label for="nama_topik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Topik</label>
                        <input type="text" name="nama_topik" id="nama_topik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Masukkan nama topik" >
                        @error('nama_topik')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Masukkan deskripsi"></textarea>
                    </div>
                    <div class="col-span-1">
                        <label for="durasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Durasi</label>
                        <input type="text" name="durasi" id="durasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Masukkan durasi (misal: 2 jam)">
                    </div>
                    <div class="col-span-1">
                        <label for="materi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Materi</label>
                        <input name="materi" id="materi" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Masukkan materi"></input>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-700">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</div>

@endsection