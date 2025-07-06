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

        <div class="bg-white p-4 w-full mt-5 sm:mt-14 lg:mt-0 flex flex-col justify-center items-center">


            <!-- Gooogle seaction -->

            <!-- Cek apakah ada pesan kesalahan untuk login_error -->
            @if ($errors->has('login_error'))
                <div class="text-red-500 text-sm mb-4">
                    <strong>{{ $errors->first('login_error') }}</strong>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}"
                class="max-w-md mx-auto p-6 ">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <h2 class="text-2xl font-bold mb-4 text-center">Reset Password</h2>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password Baru</label>
                    <input type="password" name="password" required autocomplete="new-password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Konfirmasi
                        Password</label>
                    <input type="password" name="password_confirmation" required autocomplete="new-password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                    Reset Password
                </button>
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