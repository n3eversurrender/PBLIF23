<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillMatching</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Script modal -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

</head>

<body>

@if (session('success'))
        <script>
            // {{ session('success') }}
            document.addEventListener('DOMContentLoaded', (event) => {
                Swal.fire({
    icon: 'success',
    title: "{{ session('success') }}",
    text: "Ayo isi Data Pengalaman Anda untuk Mendapatkan Rekomendasi Kursus",
    confirmButtonText: 'OK',
    customClass: {
        confirmButton: 'my-swal-button'
    }
});
            });
            
        </script>
        @endif

    <div class="flex flex-col lg:flex-row lg:justify-between">
        <!-- Image Section -->
        <img class="w-full h-48 sm:h-1/3 object-cover lg:w-1/3 lg:h-auto"
            src="{{ asset('image/12.webp') }}"
            alt="Background Main" />
        
        <!-- form Section -->
        <div class="bg-white p-4 w-full mt-5 sm:mt-14 flex flex-col justify-center items-center">
            <h2 class="font-bold text-2xl sm:text-3xl lg:text-4xl text-center mb-6 lg:mb-10 w-full">
                Isi Data
                <br>Pengalaman Anda
            </h2>

            <!-- Form -->
            <form class="w-full px-12 lg:px-0 mt-5 lg:mt-0 lg:max-w-md" method="POST" action="{{ route('peserta.skillmatching') }}">
                @csrf
                <!-- Minat Bidang -->
                <div class="mb-4 lg:mb-6">
                    <label class="block mb-2 text-sm font-semibold text-gray-950 dark:text-white">
                        Bidang yang Diminati
                    </label>
                    <input type="text" name="minat_bidang" class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan bidang minat Anda anda">  
                        @error('minat_bidang')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                </div>
                 <!-- Bidang saat ini -->
                    <div class="mb-4 sm:mb-0">
                        <label class="block mb-2 text-sm font-semibold text-gray-950 dark:text-white">
                        Bidang Saat ini
                        </label>
                        <input type="text" name="bidang_saat_ini" class="border w-full border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Masukkan bidang saat ini">  
                        @error('bidang_saat_ini')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                <!-- Preferensi level -->
                <div class="mb-4 lg:mb-6">
                    <label for="level" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
                        Preferensi Level Kursus
                    </label>
                    <select id="level" name="level" class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required class="...">
                        <option selected disabled>Pilih preferensi level kursus yang Anda inginkan</option>
                        <option value="Pemula">Pemula</option>
                        <option value="Menengah">Menengah</option>
                        <option value="Lanjutan">Lanjutan</option>
                    </select>
                    @error('level')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                 <!-- Pendidikan -->
                <div class="mb-4 lg:mb-6">
                    <label  class="block mb-2 text-sm font-semibold text-gray-950 dark:text-white">
                        Pendidikan
                    </label>
                    <input type="text"  name="pendidikan" class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan riwayat pendidikan anda">
                       @error('pendidikan')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror 
                </div>

                 <!-- Status -->
                <div class="mb-4 lg:mb-6">
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
                        Status
                    </label>
                    <select id="status" name="status" class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required class="...">
                        <option selected disabled>Pilih status pekerjaan anda saat ini</option>
                        <option value="Siswa">Siswa</option>
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="Pekerja">Pekerja</option>
                    </select>
                    @error('status')
                       <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Keahlian -->
                 <div class="mb-4 lg:mb-6">
                    <label class="block mb-2 text-sm font-semibold text-gray-950 dark:text-white">
                        Keahlian
                    </label>
                    <textarea name="nama_keahlian" rows="4" class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Tuliskan keahlian yang anda miliki"></textarea>
                    @error('nama_keahlian')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="sm:mt-8 mt-0 lg:mt-0">
                    <button type="submit"
                        class="text-white bg-ButtonBase hover:bg-HoverGlow focus:ring-4 focus:outline-none focus:ring-HoverGlow font-semibold rounded-lg text-sm w-full sm:w-1/2 lg:w-1/4 px-5 sm:px-2 py-2 text-center transition duration-700">
                        Simpan
                    </button>
                </div>
            </form>
            <div class="bg-white p-4 w-full flex flex-col justify-center items-center lg:mb-20">
                <div class="sm:flex sm:gap-2 w-full font-semibold px-12 lg:px-0 lg:max-w-md text-xs sm:text-sm">
                    <h3>Belum ada pengalaman atau sudah mengisi form?</h3>
                    <a href="{{ route('BerandaTrainee') }}" class="text-ButtonBase transition duration-700 hover:text-HoverGlow">lewati halaman ini</a>
                </div>
            </div>
        </div>
    </div>

    @if (session('error'))
    <script>
        // {{ session('error') }}
        document.addEventListener('DOMContentLoaded', (event) => {
            Swal.fire({
                icon: 'error',
                title: "{{ session('error') }}",
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'my-swal-button'
                }
            });
        });
    </script>
@endif
</body>