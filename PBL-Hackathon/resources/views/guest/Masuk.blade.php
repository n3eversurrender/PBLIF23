<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Script modal -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="flex flex-col lg:flex-row lg:justify-between h-screen">
        <!-- Image Section -->
        <img class="w-full h-48 sm:h-1/3 object-cover lg:w-1/3 lg:h-auto" src="{{ asset('image/12.webp') }}"
            alt="Background Main" />

        <!-- Form Section -->
        <div class="bg-white p-4 w-full mt-5 sm:mt-14 lg:mt-0 flex flex-col justify-center items-center">
            <h2 class="font-bold text-2xl sm:text-3xl lg:text-4xl text-center mb-6 lg:mb-10 w-full">
                Ayo Segera Masuk
                <br>Ke Halamanmu
            </h2>

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

            <!-- Cek apakah ada pesan kesalahan untuk login_error -->
            @if ($errors->has('login_error'))
                <div class="text-red-500 text-sm mb-4">
                    <strong>{{ $errors->first('login_error') }}</strong>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="w-full px-12 lg:px-0 mt-5 lg:mt-0 lg:max-w-md">
                @csrf
                <div class="mb-4 lg:mb-6">
                    <label for="email" class="block mb-2 text-sm font-semibold text-gray-950 dark:text-white">
                        Email
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="john.doe@company.com" />
                    <!-- Pesan error untuk email -->
                    @error('email')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror

                </div>

                <div class="relative">
                    <label for="kata_sandi" class="block mb-2 text-sm font-semibold text-gray-950 dark:text-white">
                        Kata Sandi
                    </label>
                    <input type="password" id="kata_sandi" name="kata_sandi"
                        class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="•••••••••" />
                    <i class="fas fa-eye absolute right-3 top-12 transform -translate-y-1/2 cursor-pointer"
                        id="togglePassword"></i>
                    <!-- Pesan error untuk kata sandi -->
                    @error('kata_sandi')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div
                    class="mb-4 lg:mb-6 text-right text-xs sm:text-sm font-semibold mt-2 w-full text-HoverGlow hover:text-ButtonBase transition duration-700">
                    <a href="/lupasandi">Lupa kata sandi?</a>
                </div>

                <div class="flex justify-center sm:mt-8 mt-0 lg:mt-0 ">
                    <button type="submit"
                        class="text-white bg-ButtonBase hover:bg-HoverGlow focus:ring-4 focus:outline-none focus:ring-HoverGlow font-semibold rounded-lg text-sm w-full sm:w-1/2 lg:w-full px-5 py-2 text-center transition duration-700">
                        Masuk
                    </button>
                </div>
            </form>


            <a href="/Daftar"
                class="group font-semibold text-sm sm:text-base mt-2 text-ButtonBase transition duration-700">
                <span class="group-hover:text-HoverGlow text-slate-950">Belum Punya Akun?</span>
                <span class="group-hover:text-HoverGlow">Daftar</span>
            </a>

            <!-- <a href="/Home" class="text-sm sm:text-base font-semibold mt-7 text-slate-800 hover:text-HoverGlow transition duration-700">Kembali Ke Beranda</a> -->
        </div>
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
</body>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('kata_sandi');

    togglePassword.addEventListener('click', function() {
        // Jika tipe password saat ini adalah "password", ubah menjadi "text"
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;

        // Ubah ikon mata sesuai dengan kondisi
        this.classList.toggle('fa-eye-slash');
    });
</script>

</html>
