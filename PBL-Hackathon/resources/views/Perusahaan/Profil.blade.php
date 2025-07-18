@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')

<main> <!-- Profil perusahaan -->
    <section class="px-5">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">📄 Informasi Umum</h2>
            <a href="{{ route('EditProfilPerusahaan') }}" class="text-blue-500 hover:text-blue-700 flex items-center gap-1">
                <i class="fas fa-edit"></i> Edit Profil
            </a>
        </div>
        <div class="sm:grid lg:grid-cols-4 sm:grid-cols-3 gap-4">
            <div class="sm:col-span-1">
                <img
                    src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) 
                            : asset('image/Thumnnail.jpg') }}"
                    class="rounded-full aspect-square object-cover" />
            </div>


            <div class="lg:col-span-3 sm:col-span-2 px-2 lg:px-6 mt-5 sm:mt-0 text-sm sm:text-base">
                <div class="mb-3">
                    <label class="font-bold text-gray-900 uppercase">Deskripsi:</label>
                    <p class="text-gray-700">
                        {{ $perusahaan->deskripsi ?? '-' }}
                    </p>
                </div>

                <div class="mb-3">
                    <label class="font-bold text-gray-900">SERVICES:</label>
                    <ul class="text-gray-700">
                        <li>{{ $perusahaan->layanan ?? '-' }} </li>
                    </ul>
                </div>

                <div class="mb-3">
                    <label class="font-bold text-gray-900">VISION</label>
                    <p class="text-gray-700">{{ $perusahaan->visi ?? '-' }}</p>
                </div>

                <div class="mb-3">
                    <label class="font-bold text-gray-900">MISION</label>
                    <p class="text-gray-700">{{ $perusahaan->misi ?? '-' }}</p>
                </div>

                <div>
                    <p class="font-semibold">Email : <span class="font-normal text-gray-700">{{ $user->email ?? '-' }}</span></p>
                    <p class="font-semibold">No Telepon : <span class="font-normal text-gray-700">{{ $user->no_telepon ?? '-' }}</span></p>
                    <p class="font-semibold">Alamat : <span class="font-normal text-gray-700">{{ $user->alamat ?? '-' }}</span></p>
                    <p class="font-semibold">Status Verifikasi:
                        <span class="font-normal text-gray-700">
                            {{ $user->status_verifikasi ?? 'Belum Diverifikasi' }}
                        </span>
                    </p>

                    @if ($user->status_verifikasi === 'Sudah Diverifikasi')
                    <p class="text-green-600 text-sm mt-1">
                        Akun Anda sudah diverifikasi. Terima kasih!
                    </p>

                    @elseif ($user->status_verifikasi === 'Ditolak')
                    <p class="text-red-600 text-sm mt-1">
                        Permintaan verifikasi Anda ditolak. Silakan perbaiki data dan kirim ulang permintaan.
                    </p>
                    <form action="{{ route('Perusahaan.kirimVerifikasi') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Ulang Permintaan Verifikasi
                        </button>
                    </form>

                    @else
                    <form action="{{ route('Perusahaan.kirimVerifikasi') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Permintaan Verifikasi
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

    </section>

    <!-- Informasi Tambahan -->
    <section class="my-5 px-10">
        <div class="bg-white rounded-xl shadow-md p-6 mt-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">📄 Informasi Legal</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="border-t pt-2 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500 font-semibold">NPWP</p>
                        <p class="text-lg text-gray-800">{{ $perusahaan ? ($perusahaan->npwp ?? '-') : '-' }}</p>
                    </div>
                    @if($perusahaan && $perusahaan->file_npwp)
                    <a href="{{ asset('storage/'.$perusahaan->file_npwp) }}" target="_blank" class="text-blue-500 text-sm flex items-center gap-1">
                        <i class="fas fa-file-pdf"></i> Lihat
                    </a>
                    @endif
                </div>


                <div class="border-t pt-2 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500 font-semibold">Akta Pendirian</p>
                        <p class="text-lg text-gray-800">{{ $perusahaan ? ($perusahaan->akta_pendirian ?? '-') : '-' }}</p>
                    </div>
                    @if($perusahaan && $perusahaan->file_akta_pendirian)
                    <a href="{{ asset('storage/'.$perusahaan->file_akta_pendirian) }}" target="_blank" class="text-blue-500 text-sm flex items-center gap-1">
                        <i class="fas fa-file-pdf"></i> Lihat
                    </a>
                    @endif
                </div>

                <div class="border-t pt-2 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500 font-semibold">Izin Operasional</p>
                        <p class="text-lg text-gray-800">{{ $perusahaan ? ($perusahaan->izin_operasional ?? '-') : '-' }}</p>
                    </div>
                    @if($perusahaan && $perusahaan->file_izin_operasional)
                    <a href="{{ asset('storage/'.$perusahaan->file_izin_operasional) }}" target="_blank" class="text-blue-500 text-sm flex items-center gap-1">
                        <i class="fas fa-file-pdf"></i> Lihat
                    </a>
                    @endif
                </div>

                <div class="border-t pt-2 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500 font-semibold">Sertifikasi BNSP</p>
                        <p class="text-lg text-gray-800">{{ $perusahaan ? ($perusahaan->sertifikasi_bnsp ?? '-') : '-' }}</p>
                    </div>
                    @if($perusahaan && $perusahaan->file_sertifikasi_bnsp)
                    <a href="{{ asset('storage/'.$perusahaan->file_sertifikasi_bnsp) }}" target="_blank" class="text-blue-500 text-sm flex items-center gap-1">
                        <i class="fas fa-file-pdf"></i> Lihat
                    </a>
                    @endif
                </div>


            </div>
        </div>
    </section>

    <!-- galeri perusahaan -->
    <section class="pb-20 mt-16">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Galeri Perusahaan</h2>
            <a href="{{ route('KelolaGaleri', ['id' => $perusahaan_id]) }}" class="text-blue-500 hover:text-blue-700 flex items-center gap-1">
                <i class="fas fa-edit"></i> Kelola Galeri
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($galeri as $foto)
            <div class="gallery-item group relative overflow-hidden rounded-xl shadow-md hover:shadow-lg transition duration-300 cursor-pointer">
                <img src="{{ asset('storage/' . $foto->file_path) }}" alt="Foto Perusahaan"
                    class="w-full h-64 object-cover transition duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                    <div>
                        <h3 class="text-white font-semibold text-lg">Foto Perusahaan</h3>
                        <p class="text-gray-200 text-sm mt-1">{{ $foto->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="absolute top-4 right-4 bg-white/90 rounded-full p-2 opacity-0 group-hover:opacity-100 transition duration-300">
                    <i class="fas fa-expand text-gray-800"></i>
                </div>
            </div>
            @empty
            <p class="col-span-full text-center text-gray-500">Belum ada foto perusahaan.</p>
            @endforelse
        </div>

        <div class="mt-12 flex justify-center">
            <nav class="flex items-center space-x-2">
                {{-- Tombol prev --}}
                @if ($galeri->onFirstPage())
                <button disabled class="px-4 py-2 border border-gray-300 rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                    <i class="fas fa-chevron-left"></i>
                </button>
                @else
                <a href="{{ $galeri->previousPageUrl() }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-chevron-left"></i>
                </a>
                @endif

                {{-- Nomor halaman --}}
                @for ($i = 1; $i <= $galeri->lastPage(); $i++)
                    @if ($i == $galeri->currentPage())
                    <span class="px-4 py-2 border border-blue-600 rounded-md text-white bg-blue-600">{{ $i }}</span>
                    @else
                    <a href="{{ $galeri->url($i) }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">{{ $i }}</a>
                    @endif
                    @endfor

                    {{-- Tombol next --}}
                    @if ($galeri->hasMorePages())
                    <a href="{{ $galeri->nextPageUrl() }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    @else
                    <button disabled class="px-4 py-2 border border-gray-300 rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    @endif
            </nav>
        </div>


        <!-- Modal -->
        <div class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center" id="imageModal">
            <div class="close-btn absolute top-4 right-4 cursor-pointer text-white text-2xl" id="closeModal">
                <i class="fas fa-times"></i>
            </div>
            <div class="relative max-w-4xl w-full p-4">
                <img src="" alt="" class="w-full max-h-[80vh] object-contain" id="modalImage">
                <div class="mt-4 text-white text-center">
                    <h3 class="text-xl font-semibold" id="modalTitle"></h3>
                    <p class="text-gray-300 mt-1" id="modalDate"></p>
                </div>
            </div>
        </div>
    </section>

</main>
<script>
    // Script untuk modal galeri
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDate = document.getElementById('modalDate');
    const closeModal = document.getElementById('closeModal');

    // Buka modal saat gambar diklik
    document.querySelectorAll('.gallery-item').forEach(item => {
        item.addEventListener('click', function() {
            const imgSrc = this.querySelector('img').src;
            const title = this.querySelector('h3').textContent;
            const date = this.querySelector('p').textContent;

            modalImage.src = imgSrc;
            modalTitle.textContent = title;
            modalDate.textContent = date;
            imageModal.classList.remove('hidden');
            imageModal.classList.add('flex');
            document.body.style.overflow = 'hidden'; // Mencegah scrolling latar belakang
        });
    });

    // Tutup modal saat tombol X diklik
    closeModal.addEventListener('click', function() {
        closeGalleryModal();
    });

    // Tutup modal saat mengklik di luar gambar
    imageModal.addEventListener('click', function(e) {
        if (e.target === imageModal) {
            closeGalleryModal();
        }
    });

    // Tutup modal dengan tombol ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !imageModal.classList.contains('hidden')) {
            closeGalleryModal();
        }
    });

    // Fungsi untuk menutup modal
    function closeGalleryModal() {
        imageModal.classList.remove('flex');
        imageModal.classList.add('hidden');
        document.body.style.overflow = 'auto'; // Mengembalikan scrolling
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        confirmButtonText: 'OK',
        customClass: {
            confirmButton: 'my-swal-button'
        }
    });
</script>
@endif

@endsection