<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Script modal -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="flex flex-col lg:flex-row lg:justify-between h-screen">
        <!-- Image Section -->
        <img class="w-full h-48 sm:h-1/3 object-cover lg:w-1/3 lg:h-auto"
            src="{{ asset('image/12.webp') }}"
            alt="Background Main" />

        <!-- Form Section -->
        <div class="bg-white p-4 w-full mt-5 sm:mt-14 lg:mt-0 flex flex-col justify-center items-center">
            <h2 class="font-bold text-2xl sm:text-3xl lg:text-4xl text-center mb-6 lg:mb-10 w-full">
                Lupa Kata Sandi
            </h2>


            <!-- Cek apakah ada pesan kesalahan untuk login_error -->
            <!-- @if ($errors->has('login_error'))
            <div class="text-red-500 text-sm mb-4">
                <strong>{{ $errors->first('login_error') }}</strong>
            </div>
            @endif -->

            <form  action="" class="w-full px-12 lg:px-0 mt-5 lg:mt-0 lg:max-w-md">
                
                <div class="mb-4 lg:mb-6">
                    <label for="password" class="block mb-2 text-sm font-semibold text-gray-950 dark:text-white">
                        Kata Sandi
                    </label>
                    <input type="password"
                        class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="********" />
                    <!-- <span class="text-xs text-red-600">Masukkan email aktif yang sesuai dengan akun yang anda gunakan sebelumnya</span> -->
                    <!-- Pesan error untuk email -->
                    <!-- @error('email')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror -->

                    <label for="password" class="block mb-2 mt-4 text-sm font-semibold text-gray-950 dark:text-white">
                        Konfirmasi Kata Sandi
                    </label>
                    <input type="password"
                        class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="********" />

                </div>

                <div class="flex justify-center sm:mt-8 mt-0 lg:mt-0 ">
                    <button type="submit"
                        class="text-white bg-ButtonBase hover:bg-HoverGlow focus:ring-4 focus:outline-none focus:ring-HoverGlow font-semibold rounded-lg text-sm w-full sm:w-1/2 lg:w-full px-5 py-2 text-center transition duration-700">
                        Kirim
                    </button>
                </div>
            </form>
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

</html>