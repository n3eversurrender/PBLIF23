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
</head>

<body>
    <div class="flex flex-col lg:flex-row lg:justify-between">
        <!-- Image Section -->
        <img class="w-full h-48 sm:h-1/3 object-cover lg:w-1/3 lg:h-auto"
            src="{{ asset('image/12.webp') }}"
            alt="Background Main" />
        
        <!-- form Section -->
        <div class="bg-white p-4 w-full mt-5 sm:mt-14 flex flex-col justify-center items-center">
            <h2 class="font-bold text-2xl sm:text-3xl lg:text-4xl text-center mb-6 lg:mb-10 w-full">
                Ayo Isi Data
                <br>Pengalaman Anda
            </h2>

            <!-- Form -->
            <form class="w-full px-12 lg:px-0 mt-5 lg:mt-0 lg:max-w-md">
                <!-- Status -->
                <div class="mb-4 lg:mb-6">
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
                        Status
                    </label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected disabled>Pilih status pekerjaan anda saat ini</option>
                        <option value="Siswa">Siswa</option>
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="Pekerja">Pekerja</option>
                    </select>
                </div>

                <!-- Pendidikan -->
                <div class="mb-4 lg:mb-6">
                    <label  class="block mb-2 text-sm font-semibold text-gray-950 dark:text-white">
                        Pendidikan
                    </label>
                    <input type="text"  class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan riwayat pendidikan anda">  
                </div>

                <!-- Minat Bidang -->
                <div class="mb-4 lg:mb-6">
                    <label class="block mb-2 text-sm font-semibold text-gray-950 dark:text-white">
                        Minat Bidang
                    </label>
                    <input type="text" class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan bidang minat Anda anda">  
                </div>

                <!-- Line pengalaman opsional -->
                <div class="flex items-center justify-center my-6">
                    <div class="w-full border-t border-gray-400"></div>
                    <h4 class="px-4 text-sm font-semibold text-gray-950 whitespace-nowrap">
                        Pengalaman Opsional
                    </h4>
                    <div class="w-full border-t border-gray-300"></div>
                </div>

                <div class="sm:grid sm:grid-cols-2 gap-4 mb-4 lg:mb-6">
                    <!-- Bidang saat ini -->
                    <div class="mb-4 sm:mb-0">
                        <label class="block mb-2 text-sm font-semibold text-gray-950 dark:text-white">
                        Bidang Saat ini
                        </label>
                        <input type="text" class="border w-full border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Masukkan bidang saat ini">  
                    </div>
                    <!-- Pengalaman -->
                    <div class="mt-4 sm:mt-0">
                        <label class="block mb-2 text-sm font-semibold text-gray-950 dark:text-white">
                        Pengalaman (Tahun)
                        </label>
                        <input type="text" class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Masukkan tahun pengalaman">  
                    </div>
                </div>

                <!-- Keahlian -->
                 <div class="mb-4 lg:mb-6">
                    <label class="block mb-2 text-sm font-semibold text-gray-950 dark:text-white">
                        Keahlian
                    </label>
                    <textarea rows="4" class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Tuliskan keahlian yang anda miliki"></textarea>
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
                    <h3>Belum ada pengalaman?</h3>
                    <a href="#" class="text-ButtonBase transition duration-700 hover:text-HoverGlow">lewati halaman ini</a>
                </div>
            </div>
        </div>
    </div>
</body>