@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')
<!-- Breadcrumb -->
<div class="flex items-center space-x-2 text-sm text-gray-500 pt-4">
    <a href="/ProfilPerusahaan" class="hover:text-blue-600 transition">Profil</a>
    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
    <span class="text-blue-600 font-medium">Kelola Galeri</span>
</div>

<!-- Kelola galeri perusahaan -->
<form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="sm:mt-6 mt-4">
        <div class="flex justify-end">
            <a href="#"
                id="toggleTambahGaleri"
                class="font-semibold bg-ButtonBase hover:bg-HoverGlow transition duration-700 py-2.5 px-5 rounded-lg text-white">
                Tambah Galeri
            </a>
        </div>
        <div class="flex justify-center">
            <div id="tambahGaleri" class="mt-5 rounded-lg shadow-md px-6 pt-6 hidden w-full">
                <label class="block mb-2 text-sm font-bold text-gray-900">Foto Kegiatan</label>
                <input type="file" name="file_path"
                    class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                <div class="flex justify-end w-full my-5">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-HoverGlow focus:ring-4 focus:ring-HoverGlow font-medium rounded-md text-sm px-10 py-1.5 me-5 focus:outline-none duration-700 transition">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="relative my-5 overflow-x-auto shadow-md sm:rounded-lg">
    <h2 class="font-semibold text-lg mb-2">Daftar Kegiatan</h2>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-400 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Gambar</th>
                <th scope="col" class="px-6 py-3">Di buat</th>
                <th scope="col" class="px-6 py-3">Di Update</th>
                <th scope="col" class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($galeri as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <td class="px-6 py-4">
                    <img src="{{ asset('storage/' . $item->file_path) }}" alt="Foto Kegiatan" class="w-24 h-24 object-cover aspect-square rounded-lg img-kegiatan">
                </td>
                <td class="px-6 py-4 nama-kegiatan">{{ $item->created_at->format('Y-m-d') }}</td>
                <td class="px-6 py-4 tanggal-kegiatan">{{ $item->updated_at->format('Y-m-d') }}</td>
                <td class="px-6 py-4 h-full">
                    <div class="flex gap-4 justify-center items-center h-full">
                        <button data-modal-target="modal_edit_{{ $item->foto_id }}" data-modal-toggle="modal_edit_{{ $item->foto_id }}" class="text-blue-600 hover:text-blue-900">
                            Edit
                        </button>
                        <button data-modal-target="modal_delete_{{ $item->foto_id }}" data-modal-toggle="modal_delete_{{ $item->foto_id }}" class="text-red-600 hover:text-red-800">
                            Hapus
                        </button>
                    </div>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div id="modal_edit_{{ $item->foto_id }}" tabindex="-1" class="hidden fixed top-0 left-0 right-0 z-50 items-center justify-center w-full h-full bg-black bg-opacity-50">
                <div class="bg-white rounded-lg p-6 w-full max-w-md">
                    <h2 class="text-xl font-semibold mb-4">Edit Foto Galeri</h2>
                    <form action="{{ route('galeri.update', $item->foto_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label class="block mb-1">Ganti Gambar</label>
                        <input type="file" name="file_path" class="w-full border px-3 py-2 rounded mb-4">
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Delete -->
            <div id="modal_delete_{{ $item->foto_id }}" tabindex="-1" class="hidden fixed top-0 left-0 right-0 z-50 items-center justify-center w-full h-full bg-black bg-opacity-50">
                <div class="bg-white rounded-lg p-6 w-full max-w-md text-center">
                    <h2 class="text-lg font-bold mb-4">Yakin ingin menghapus foto ini?</h2>
                    <form action="{{ route('galeri.destroy', $item->foto_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-center gap-4">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Hapus</button>
                            <button type="button" data-modal-toggle="modal_delete_{{ $item->foto_id }}" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
            @empty
            <tr>
                <td colspan="4" class="text-center py-4 text-gray-500">Belum ada galeri ditambahkan.</td>
            </tr>
            @endforelse

        </tbody>
    </table>

    <!-- Pagination -->
    <div class="flex justify-center items-center mt-5">
        <ul class="inline-flex -space-x-px text-sm">
            <!-- Tombol Sebelumnya -->
            <li>
                @if ($galeri->onFirstPage())
                <span class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-400 bg-gray-100 border border-e-0 border-gray-300 rounded-s-lg cursor-not-allowed">
                    Sebelumnya
                </span>
                @else
                <a href="{{ $galeri->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                    Sebelumnya
                </a>
                @endif
            </li>

            <!-- Tombol Berikutnya -->
            <li>
                @if ($galeri->hasMorePages())
                <a href="{{ $galeri->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                    Berikutnya
                </a>
                @else
                <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-400 bg-gray-100 border border-gray-300 rounded-e-lg cursor-not-allowed">
                    Berikutnya
                </span>
                @endif
            </li>
        </ul>
    </div>

    <!-- Info entri -->
    <div class="mt-4 mb-5 text-center text-sm text-gray-600 dark:text-gray-400">
        Menampilkan {{ $galeri->firstItem() }} sampai {{ $galeri->lastItem() }} dari {{ $galeri->total() }} entri
    </div>


</div>
<script>
    document.getElementById('toggleTambahGaleri').addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah link reload halaman
        const passwordForm = document.getElementById('tambahGaleri');
        passwordForm.classList.toggle('hidden'); // Menyembunyikan atau menampilkan form
    });

    const editModal = document.getElementById('editModal');
    const closeEditModal = document.getElementById('closeEditModal');

    document.querySelectorAll('.edit-button').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const row = this.closest('tr');
            const nama = row.querySelector('.nama-kegiatan')?.textContent.trim();
            const tanggal = row.querySelector('.tanggal-kegiatan')?.textContent.trim();

            document.getElementById('editNama').value = nama;
            document.getElementById('editTanggal').value = tanggal;

            editModal.classList.remove('hidden');
            editModal.classList.add('flex');
        });
    });

    function closeModal() {
        editModal.classList.remove('flex');
        editModal.classList.add('hidden');
    }

    closeEditModal.addEventListener('click', closeModal);

    editModal.addEventListener('click', function(e) {
        if (e.target === editModal) {
            closeModal();
        }
    });
</script>
@endsection