    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Peserta</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
        @vite(['resources/js/Waktu.js'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
        <script src="https://www.youtube.com/iframe_api"></script>

        <!-- Script modal -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
        </button>

        <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 " aria-label="Sidebar">
            <div class="h-full px-3 py-4 border overflow-y-auto bg-sky-50 dark:bg-gray-800">
                <div class="flex justify-center">
                    <a href="/BerandaTrainee">
                        <img src="{{ asset('image/SKILLB.png') }}" class="w-20 h-20 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500" alt="SkillBridge Logo" />
                    </a>
                </div>
                <p class="text-xl font-bold text-center text-[#0F172A] mb-5">SKILLBRIDGE</p>
                <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700">
                <ul class="space-y-2 font-medium mt-2">
                    <!-- Dashboard -->
                    <li>
                        <a href="/DashboardPeserta" class="{{ request()->is('DashboardPeserta') ? 'text-ButtonBase font-bold' : 'text-black' }} flex items-center p-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 group">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>

                    <!-- Daftar Kursus -->
                    <li>
                        <a href="/DaftarPelatihan" class="{{ request()->is('DaftarPelatihan') ? 'text-ButtonBase font-bold' : 'text-black' }}   flex items-center p-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 group">
                            <i class="fas fa-box"></i>
                            <span class="ms-3">Daftar Pelatihan</span>
                        </a>
                    </li>

                    <!-- Kursus -->
                    <li>
                        <a href="/Kursus" class="{{ request()->is('Kursus') ? 'text-ButtonBase font-bold' : 'text-black' }}   flex items-center p-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 group">
                            <i class="fas fa-book"></i>
                            <span class="ms-3">Kursus</span>
                        </a>
                    </li>

                    <!-- Pesan -->
                    <li>
                        <a href="/PenilaianKursus" class="{{ request()->is('PenilaianKursus') ? 'text-ButtonBase font-bold' : 'text-black' }} flex items-center p-2 hover:bg-gray-300 dark:hover:bg-gray-700 group">
                            <i class="fas fa-star"></i>
                            <span class="flex-1 ms-3 whitespace-nowrap">Penilaian Kursus</span>
                        </a>
                    </li>


                    <!-- Users -->
                    <li>
                        <a href="/PengaturanPeserta" class="{{ request()->is('PengaturanPeserta') ? 'text-ButtonBase font-bold' : 'text-black' }}   flex items-center p-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 group">
                            <span class="fa-solid fa-cog"></span>
                            <span class="ms-3">Pengaturan</span>
                        </a>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logoutPeserta') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group">
                            @csrf
                            <button type="submit" class="flex items-center">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="ms-3">Sign Out</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </aside>
        <!-- Navbar + Image -->

        <!-- Main -->
        <div class="sm:ml-64">
            <div class=" grid grid-cols-7 sm:flex justify-between items-center bg-white pt-4 px-4">
                <h1 class="text-3xl col-span-6 lg:text-4xl font-extrabold dark:text-white">
                    Selamat Datang Peserta
                    <small class="ms-2 text-xl lg:text-2xl font-semibold text-TeksSecond">
                        {{ Auth::user()->nama }}
                    </small>
                </h1>
                <div class="col-span-1">
                    <img class="w-14 h-auto object-cover aspect-square rounded-full" src="{{ asset('image/9203764.png') }}" alt="Rounded avatar" />
                </div>
            </div>

            <p id="datetime" class="sm:text-sm ps-4 text-xs font-normal text-TeksSecond pt-5  sm:pt-3 lg:py-1 bg-white "></p>
            <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700 mb-5">
            <div class="p-4 m-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                @include('partials.succesAlert')
                @include('partials.daggerAlert')
                @yield('MainPeserta')
            </div>
        </div>
        <!-- Main -->

        <script>
            document.querySelector('.sign-out-btn').addEventListener('click', function(event) {
                if (!confirm('Apakah Anda yakin ingin keluar?')) {
                    event.preventDefault(); // Mencegah logout jika pengguna membatalkan
                }
            });
        </script>
    </body>

    </html>