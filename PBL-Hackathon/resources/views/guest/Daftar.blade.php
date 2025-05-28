<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF Token -->
    <title>Daftar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="flex flex-col lg:flex-row lg:justify-between h-full">

        <img class="w-full h-48 sm:h-80 object-cover lg:w-1/3 lg:h-auto" src="{{ asset('image/12.webp') }}"
            alt="Background Main" />
        <div class="bg-white p-4 w-full mt-5  lg:mt-0 mb-10 flex flex-col justify-center items-center">
            <h2 class="font-bold text-2xl sm:text-3xl lg:text-4xl text-center my-2 lg:my-10 w-full">Buat Akun Anda</h2>

            <!-- Gooogle seaction -->
            <div class="w-full px-4 lg:px-0 mt-2 sm:mt-5 lg:mt-0 lg:max-w-md">
                <!-- Minat Bidang -->
                <div class="mb-2">
                    <a href="{{ route('Masuk.google', ['id' => 1]) }}"
                        class="flex items-center justify-center gap-3 border border-gray-300 text-gray-900 text-sm font-medium rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full py-2.5 px-4 hover:bg-gray-300 transition duration-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <i class="fa-brands fa-google text-lg" style="color: #000000;"></i>
                        <span>Masuk dengan Google</span>

                    </a>
                </div>

                <!-- Line atau -->
                <div class="flex items-center justify-center mb-6 mt-2">
                    <div class="w-full border-t border-gray-400"></div>
                    <h4 class="px-4 text-sm font-semibold text-gray-950 whitespace-nowrap">
                        atau
                    </h4>
                    <div class="w-full border-t border-gray-300"></div>
                </div>
            </div>

            <form id="registerForm" action="{{ route('pengguna.store') }}" method="POST"
                class="w-full px-4 lg:px-0 mt-2 sm:mt-5 lg:mt-0 lg:max-w-md">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="nama"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Nama</label>
                        <input type="text" id="nama" name="nama"
                            class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="John Doe" />
                        @error('nama')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="email" name="email"
                            class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="john.doe@company.com" />
                        @error('email')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-6">
                    <label for="no_telepon" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">No
                        Telepon</label>
                    <input type="number" id="no_telepon" name="no_telepon"
                        class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="08123300220" />
                    @error('no_telepon')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="alamat"
                        class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-Border focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan alamat lengkap..."></textarea>
                    @error('alamat')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="jenis_kelamin"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                            class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected disabled>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="peran"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Peran</label>
                        <select id="peran" name="peran"
                            class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected disabled>Pilih Peran</option>
                            <option value="Peserta">Peserta</option>
                            <option value="Pelatih">Pelatih</option>
                        </select>
                        @error('peran')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div class="lg:mb-3">
                        <label for="kata_sandi"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Kata Sandi</label>
                        <div class="relative">
                            <input type="password" id="kata_sandi" name="kata_sandi"
                                class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10"
                                placeholder="•••••••••" />
                            <i id="togglePassword"
                                class="fas fa-eye absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer"></i>
                        </div>
                        @error('kata_sandi')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="lg:mb-3">
                        <label for="kata_sandi_confirmation"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Konfirmasi Kata
                            Sandi</label>
                        <div class="relative">
                            <input type="password" id="kata_sandi_confirmation" name="kata_sandi_confirmation"
                                class="border @error('kata_sandi_confirmation') border-red-500 @else border-Border @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10"
                                placeholder="•••••••••" />
                            <i id="toggleConfirmPassword"
                                class="fas fa-eye absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer"></i>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="status" name="status" value="Aktif">
                <div class="flex justify-center sm:mt-8 mt-0 lg:mt-0 ">
                    <button type="submit"
                        class="text-white bg-ButtonBase hover:bg-HoverGlow transition duration-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-1/2 lg:w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kirim</button>
                </div>
            </form>

            <a href="/Masuk"
                class="group font-semibold text-sm sm:text-base mt-2 text-ButtonBase transition duration-700">
                <span class="group-hover:text-HoverGlow text-slate-950">Sudah Punya Akun?</span>
                <span class="group-hover:text-HoverGlow">Masuk</span>
            </a>

            <!-- <a href="/Home" class="text-sm sm:text-base font-semibold mt-7 text-slate-800 hover:text-HoverGlow transition duration-700">Kembali Ke Beranda</a> -->
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#togglePassword').on('click', function() {
                const passwordField = $('#kata_sandi');
                const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);

                $(this).toggleClass('fa-eye fa-eye-slash');
            });

            $('#toggleConfirmPassword').on('click', function() {
                const confirmPasswordField = $('#kata_sandi_confirmation');
                const type = confirmPasswordField.attr('type') === 'password' ? 'text' : 'password';
                confirmPasswordField.attr('type', type);

                // Ganti ikon mata sesuai dengan kondisi
                $(this).toggleClass('fa-eye fa-eye-slash');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Ketika nilai peran berubah
            $('#peran').on('change', function() {
                const selectedRole = $(this).val(); // Ambil nilai peran yang dipilih
                const statusField = $('#status'); // Ambil input status tersembunyi

                // Tentukan status berdasarkan peran yang dipilih
                if (selectedRole === 'Peserta') {
                    statusField.val('Aktif'); // Jika "Peserta", set status ke "Aktif"
                } else if (selectedRole === 'Pelatih') {
                    statusField.val('Tidak Aktif'); // Jika "Pelatih", set status ke "Tidak Aktif"
                }
            });
        });
    </script>


</body>

</html>
