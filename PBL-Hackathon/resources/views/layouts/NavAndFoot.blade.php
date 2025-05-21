<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skillbridge™</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="w-full">

    <!-- Navbar + Image -->
    <nav class="bg-black bg-opacity-90 border-gray-200 dark:bg-black dark:bg-opacity-50 fixed top-0 w-full z-10">
        <div class="max-w-screen-2xl grid grid-cols-12 items-center sm:justify-between mx-auto p-2 sm:p-4">
            <a href="#" class="flex {{ Auth::check() ? 'col-span-9' : 'col-span-8' }} sm:col-span-5 items-center space-x-2 rtl:space-x-reverse">
                <img src="{{ asset('image/SKILLB.png') }}" class="w-10 h-10 rounded-full" alt="Flowbite Logo" />
                <span class="self-center text-lg sm:text-2xl font-semibold whitespace-nowrap text-white">SKILL BRIDGE</span>
            </a>

            <div class="{{ Auth::check() ? 'col-span-3' : 'col-span-4' }} flex  gap-x-3  sm:col-span-7 sm:flex sm:justify-between">
                <div class="items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    @if (Auth::check())
                    @php
                    $user = Auth::user(); // Ambil data pengguna yang sedang login
                    @endphp

                    <!-- Menampilkan nama pengguna -->
                    <!-- <div>
                        <h3 class="text-white">Selamat datang, {{ $user->nama }}!</h3>
                    </div> -->

                    <!-- Menampilkan menu berdasarkan peran -->
                    @if($user->peran === 'Pelatih')
                    <!-- Menu untuk Pelatih -->
                    <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500" src="{{ $user->foto_profil ? asset('storage/foto_profil/' . $user->foto_profil) : asset('image/9203764.png') }}" alt="user photo">
                    </button>

                    <div class="z-50 block my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900 dark:text-white">{{ $user->nama }}</span>
                            <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ $user->email }}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <a href="{{ route('DashboardPelatih') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard Pelatih</a>
                            </li>
                            <li>
                                <a href="{{ route('PengaturanPelatih') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Pengaturan Pelatih</a>
                            </li>
                            <li>
                                <form action="{{ route('logoutPelatih') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                        Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @elseif($user->peran === 'Peserta')
                    <!-- Menu untuk Peserta -->
                    <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500" src="{{ $user->foto_profil ? asset('storage/foto_profil/' . $user->foto_profil) : asset('image/9203764.png') }}" alt="user photo">
                    </button>

                    <div class="z-50 block my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900 dark:text-white">{{ $user->nama }}</span>
                            <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ $user->email }}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <a href="{{ route('DashboardPeserta') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard Peserta</a>
                            </li>
                            <li>
                                <a href="{{ route('PengaturanPeserta') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Pengaturan Peserta</a>
                            </li>
                            <li>
                                <a href="{{ route('daftarTransaksi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Daftar Transaksi</a>
                            </li>
                            <li>
                                <form action="{{ route('logoutPeserta') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                        Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endif
                    @else
                    <!-- Tampilkan tombol login jika pengguna belum login -->
                    <button type="button" id="login-button" class=" mt-1.5 text-gray-900 bg-white  hover:bg-HoverGlow hover:text-white transition duration-500 font-medium rounded-lg text-xs sm:text-sm lg:px-5 px-3 lg:py-2.5 py-2 me-2 mb-2 group" onclick="window.location.href='/Masuk';">
                        Masuk
                    </button>
                    @endif

                </div>

                <button data-collapse-toggle="navbar-default" type="button" class="inline-flex mt-2 z-20 items-center p-1 w-7 h-7 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>

                <div class="items-center absolute top-14 sm:top-0 right-0 z-10 sm:relative justify-between hidden sm:w-full md:flex md:w-auto md:order-1" id="navbar-default">
                    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent dark:bg-transparent md:dark:bg-transparent dark:border-gray-700">
                        <li>
                            <a href="/Home"
                                class="{{ request()->is('Home') ? ' text-blue-600 font-bold' : 'text-black sm:text-white' }} block py-2 px-3 rounded md:border-0 md:p-0 hover:text-blue-500">
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="/TentangKami"
                                class="{{ request()->is('TentangKami') ? ' text-blue-600 font-bold' : 'text-black sm:text-white' }} block py-2 px-3 rounded md:border-0 md:p-0 hover:text-blue-500">
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="/DaftarKursus"
                                class="{{ request()->is('DaftarKursus', 'CoursePage/*', 'DaftarTransaksi') ? ' text-blue-600 font-bold' : 'text-black sm:text-white' }} block py-2 px-3 rounded md:border-0 md:p-0 hover:text-blue-500">
                                Kursus
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div>
        @yield('NavAndFoot')
    </div>

    <footer class="bg-white md:px-4 dark:bg-gray-900">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div>
                    <h2 class=" mb-2 sm:mb-6 self-center text-lg sm:text-2xl font-semibold whitespace-nowrap">SkillBridge</h2>
                    <ul class="text-gray-500 mb-5 sm:mb-10 text-xs sm:text-base dark:text-gray-400 font-medium">
                        <li class="mb-2 flex items-center">
                            <i class="fas fa-envelope mr-2"></i>
                            <a href="mailto:SkillBridge@gmail.com" class="hover:underline">SkillBridge@gmail.com</a>
                        </li>
                        <li class="mb-2 flex items-center">
                            <i class="fas fa-phone mr-2"></i>
                            <a href="tel:+9191813232309" class="hover:underline">+91 91813 23 2309</a>
                        </li>
                        <li class="mb-2 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span class="text-gray-500 dark:text-gray-400">Jl. Ahmad Yani, Tlk. Tering, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29461</span>
                        </li>
                    </ul>
                </div>

                <div class="grid grid-cols-2 mb-10 gap-8 sm:gap-20 sm:grid-cols-3">
                    <div>
                        <h2 class=" mb-2 sm:mb-6 text-xs sm:text-sm font-semibold text-gray-900 uppercase dark:text-white">HOME</h2>
                        <ul class="text-gray-500 text-xs sm:text-sm dark:text-gray-400 font-medium">
                            <li class="mb-2">
                                <a href="https://flowbite.com/" class="hover:underline">Benefit</a>
                            </li>
                            <li class="mb-2">
                                <a href="https://tailwindcss.com/" class="hover:underline">Our Courses</a>
                            </li>
                            <li class="mb-2">
                                <a href="https://tailwindcss.com/" class="hover:underline">Our Testimonials</a>
                            </li>
                            <li>
                                <a href="https://tailwindcss.com/" class="hover:underline">Our FAQ</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-2 sm:mb-6 text-xs sm:text-sm font-semibold text-gray-900 uppercase dark:text-white">ABOUT US</h2>
                        <ul class="text-gray-500 text-xs sm:text-sm dark:text-gray-400 font-medium">
                            <li class="mb-2">
                                <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Company</a>
                            </li>
                            <li class="mb-2">
                                <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Achievements</a>
                            </li>
                            <li>
                                <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Our Goals</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class=" mb-2 sm:mb-6 text-xs sm:text-sm font-semibold text-gray-900 uppercase dark:text-white">SOCIAL PROFILE</h2>
                        <ul class="flex justify-start space-x-3 text-gray-500 dark:text-gray-400 font-medium">
                            <li>
                                <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                                        <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Facebook page</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                                        <path fill-rule="evenodd" d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Twitter page</span>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/in/your-linkedin-username" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.579v-5.576c0-1.331-.026-3.048-1.856-3.048-1.856 0-2.141 1.447-2.141 2.943v5.681h-3.578V9.18h3.433v1.636h.048c.477-.908 1.648-1.867 3.387-1.867 3.628 0 4.295 2.394 4.295 5.51v6.993zM5.005 8.748c-1.146 0-2.071-.935-2.071-2.077 0-1.14.925-2.073 2.071-2.073 1.139 0 2.073.933 2.073 2.073 0 1.142-.934 2.077-2.073 2.077zm-1.789 11.704h3.579v-12H3.216v12zM22.5 0H1.5C.673 0 0 .673 0 1.5v21c0 .827.673 1.5 1.5 1.5h21c.827 0 1.5-.673 1.5-1.5V1.5C24 .673 23.327 0 22.5 0z" />
                                    </svg>
                                    <span class="sr-only">LinkedIn account</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <div class="sm:flex sm:items-center w-full justify-center">
                <span class="text-xs sm:text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="#" class="hover:underline">Skillbridge™</a>. All Rights Reserved.</span>
            </div>
        </div>
    </footer>

    <script>
        // Cek status login (misalnya menggunakan localStorage)
        const isLoggedIn = localStorage.getItem('loggedIn'); // Misalnya, status login disimpan di localStorage
        const userDropdown = document.getElementById('user-dropdown');
        const loginButton = document.getElementById('login-button');
        const logoutButton = document.getElementById('logout-button');

        if (isLoggedIn) {
            // Jika sudah login, tampilkan dropdown dan sembunyikan tombol login
            userDropdown.classList.remove('hidden');
            loginButton.classList.add('hidden');

            // Jika tombol keluar diklik, hapus status login
            logoutButton.addEventListener('click', () => {
                localStorage.removeItem('loggedIn'); // Hapus status login
                window.location.href = '/login'; // Arahkan ke halaman login
            });
        } else {
            // Jika belum login, sembunyikan dropdown dan tampilkan tombol login
            userDropdown.classList.add('hidden');
            loginButton.classList.remove('hidden');
        }
    </script>
</body>

</html>