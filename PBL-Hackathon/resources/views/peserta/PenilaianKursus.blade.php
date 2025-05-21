@extends('layouts.mainPeserta')

@section('MainPeserta')


<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
        <div>
            <button data-modal-target="static-modal" data-modal-toggle="static-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Tambah Rating
            </button>
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

    <table id="kursus-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">NO</th>
                <th scope="col" class="px-6 py-3">Nama Kursus</th>
                <th scope="col" class="px-6 py-3 text-center">Rating Kursus</th>
                <th scope="col" class="px-6 py-3 text-center">Rating Pelatih</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftaran as $pendaftaranItem)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4 text-center">{{ $pendaftaran->firstItem() + $loop->iteration - 1 }}</td>
                <td class="px-6 py-4">{{ $pendaftaranItem->kursus->judul }}</td>
                <td class="px-6 py-4 text-center">
                    {{ $pendaftaranItem->kursus->ratingKursus->first()?->rating ?? 'Belum ada rating' }}
                </td>
                <td class="px-6 py-4 text-center">
                    {{ $pendaftaranItem->kursus->pengguna->ratingsPelatih->first()?->rating ?? 'Belum ada rating' }}
                </td>
                <td class="px-6 py-4">
                    <!-- Button Detail -->
                    <button type="button" data-modal-target="my_modal_detail_{{ $pendaftaranItem->pendaftaran_id }}" data-modal-toggle="my_modal_detail_{{ $pendaftaranItem->pendaftaran_id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-400 mr-4">
                        <i class="fas fa-eye"></i> Detail
                    </button>
                </td>
            </tr>


            <!-- Modal Detail -->
            <div id="my_modal_detail_{{ $pendaftaranItem->pendaftaran_id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-3 w-full max-w-sm max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Detail Informasi
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="my_modal_detail_{{ $pendaftaranItem->pendaftaran_id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Tutup modal</span>
                            </button>
                        </div>
                        <!-- Isi Modal -->
                        <div class="p-4 md:p-5 bg-white dark:bg-gray-800 rounded-lg shadow-lg space-y-4">
                            <div class="space-y-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="text-md font-bold text-gray-500 dark:text-gray-400">Rating Pelatih</p>
                                        <p class="text-sm text-gray-800 dark:text-gray-200">
                                            {{ $pendaftaranItem->kursus->pengguna->ratingsPelatih->first()->rating ?? 'Belum ada rating' }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $pendaftaranItem->kursus->pengguna->ratingsPelatih->first()->komentar ?? 'Tidak ada komentar' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Rating Kursus -->
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="text-md font-bold text-gray-500 dark:text-gray-400">Rating Kursus</p>
                                        <p class="text-sm text-gray-800 dark:text-gray-200">
                                            {{ $pendaftaranItem->kursus->ratingKursus->first()->rating ?? 'Belum ada rating' }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $pendaftaranItem->kursus->ratingKursus->first()->komentar ?? 'Tidak ada komentar' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Main modal -->
<div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Berikan Rating
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <form method="POST" action="{{ route('submit.rating') }}">
                @csrf
                <div class="p-4 md:p-5 space-y-4">
                    <!-- Rating Pelatih -->

                    <div>
                        <label for="pengguna_id" class="block text-sm font-medium text-gray-700">Pilih Pelatih</label>
                        <select id="pengguna_id" name="pengguna_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="" selected disabled>Pilih Pelatih</option>
                            @foreach($pelatihs as $pelatih)
                            <option value="{{ $pelatih->pengguna_id }}">{{ $pelatih->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="rating_pelatih" class="text-md font-bold text-gray-500 dark:text-gray-400">Rating Pelatih</label>
                        <input type="number" name="rating_pelatih" id="rating_pelatih"  step="0.1" class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-white dark:border-gray-600" placeholder="Berikan rating antara 1 dan 10">
                        @error('rating_pelatih')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Komentar Pelatih -->
                    <div>
                        <label for="komentar_pelatih" class="text-md font-bold text-gray-500 dark:text-gray-400">Komentar Pelatih</label>
                        <textarea name="komentar_pelatih" id="komentar_pelatih" rows="3" class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-white dark:border-gray-600" placeholder="Tuliskan komentar mengenai pelatih (optional)"></textarea>
                    </div>

                    <div>
                        <label for="kursus_id" class="block text-sm font-medium text-gray-700">Pilih Kursus</label>
                        <select id="kursus_id" name="kursus_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="" selected disabled>Pilih Kursus</option>
                            @foreach($kursus as $kursusItem)
                            <option value="{{ $kursusItem->kursus_id }}">{{ $kursusItem->judul }}</option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Rating Kursus -->
                    <div>
                        <label for="rating_kursus" class="text-md font-bold text-gray-500 dark:text-gray-400">Rating Kursus</label>
                        <input type="number" name="rating_kursus" id="rating_kursus"  step="0.1" class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-white dark:border-gray-600" placeholder="Berikan rating antara 1 dan 10">
                        @error('rating_kursus')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Komentar Kursus -->
                    <div>
                        <label for="komentar_kursus" class="text-md font-bold text-gray-500 dark:text-gray-400">Komentar Kursus</label>
                        <textarea name="komentar_kursus" id="komentar_kursus" rows="3" class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-white dark:border-gray-600" placeholder="Tuliskan komentar mengenai kursus (optional)"></textarea>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kirim Rating</button>
                    <button type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-hide="static-modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Sweetalert -->
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

    @if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            Swal.fire({
                position: "middle",
                icon: "error",
                title: "{{ session('error') }}",
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
            <a href="{{ $pendaftaran->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Sebelumnya
            </a>
        </li>
        <li>
            <a href="{{ $pendaftaran->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Berikutnya
            </a>
        </li>
    </ul>
</div>

<!-- Menampilkan informasi data -->
<div class="mt-4 mb-5 text-center text-sm text-gray-600 dark:text-gray-400">
    Menampilkan {{ $pendaftaran->firstItem() }} sampai {{ $pendaftaran->lastItem() }} dari {{ $pendaftaran->total() }} entri
</div>


@endsection