<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skillbridge™</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite(['resources/js/Waktu.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 border overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <div class="flex justify-center">
                <a href="/Home">
                    <img src="{{ asset('image/SKILLB.png') }}" class="w-20 h-20 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500" alt="SkillBridge Logo" />
                </a>
            </div>
            <p class="text-xl font-semibold text-center text-[#0F172A] mb-5">SKILLBRIDGE</p>
            <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700">
            <ul class="space-y-2 font-medium mt-2">
                <!-- Dashboard -->
                <li>
                    <a href="/statistik" class="{{ request()->is('statistik') ? 'text-ButtonBase font-bold' : 'text-black' }} flex items-center p-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 group">
                        <i class="fas fa-chart-line"></i>
                        <span class="ms-3">Statistik</span>
                    </a>
                </li>

                <li>
                    <a href="/kursus" class="{{ request()->is('kursus', 'detailkursus', 'tambahkursus', 'tambahjadwal') ? 'text-ButtonBase font-bold' : 'text-black' }} flex items-center p-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 group">
                        <i class="fas fa-book-open"></i>
                        <span class="ms-3">Pengelolaan Kursus</span>
                    </a>
                </li>

                <li>
                    <a href="/jadwal" class="{{ request()->is('jadwal', 'kelolajadwal') ? 'text-ButtonBase font-bold' : 'text-black' }} flex items-center p-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 group">
                        <i class="fas fa-calendar-alt"></i>
                        <span class="ms-3">Pengelolaan Jadwal</span>
                    </a>
                </li>

                <li>
                    <a href="/ulasan" class="{{ request()->is('ulasan', 'detailulasan') ? 'text-ButtonBase font-bold' : 'text-black' }} flex items-center p-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 group">
                        <i class="fas fa-solid fa-users"></i>
                        <span class="ms-3">Ulasan & Rating</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('ProfilPerusahaan') }}"
                        class="{{ request()->is('ProfilPerusahaan') ? 'text-ButtonBase font-bold' : 'text-black' }} flex items-center p-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 group">
                        <i class="fas fa-solid fa-building"></i>
                        <span class="ms-3">Profil Perusahaan</span>
                    </a>
                </li>

                <li>
                    <form method="POST" action="{{ route('logoutPerusahaan') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group">
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


    <div class="sm:ml-64">
        <div class="grid grid-cols-7 sm:flex justify-between items-center bg-white pt-4 px-4">
            <h1 class="text-3xl col-span-6 lg:text-4xl font-extrabold dark:text-white">
                Selamat Datang <span class="text-2xl text-gray-600 font-semibold"> {{ Auth::user()->nama }}</span>
            </h1>
            <div class="flex items-center space-x-4">


                <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" class="relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400" type="button">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
                        <path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
                    </svg>

                    <div class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5 dark:border-gray-900"></div>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownNotification" class="z-20 hidden w-full max-w-sm bg-[#f9fafb] shadow-lg rounded-lg dark:bg-gray-800 dark:divide-gray-700" aria-labelledby="dropdownNotificationButton">
                    <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg dark:bg-gray-800 dark:text-white">
                        Notifikasi
                    </div>
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="shrink-0">
                                <img class="rounded-full w-11 h-11" src="{{ asset('image/SKILLB.png') }}" alt="Joseph image" />
                            </div>
                            <div class="w-full ps-3">
                                <div class="text-gray-700 text-sm mb-1.5 dark:text-gray-400"><span class="font-semibold text-blue-700 dark:text-white">Pendaftar Baru</span> Budi Santoso mendaftar kursus Web Development</div>
                                <div class="text-xs text-gray-500 dark:text-blue-500">2 jam yang lalu</div>
                            </div>
                        </a>
                        <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="shrink-0">
                                <img class="rounded-full w-11 h-11" src="{{ asset('image/SKILLB.png') }}" alt="Joseph image" />
                            </div>
                            <div class="w-full ps-3">
                                <div class="text-gray-700 text-sm mb-1.5 dark:text-gray-400"><span class="font-semibold text-blue-700 dark:text-white">Pendaftar Baru</span> Budi Santoso mendaftar kursus Web Development</div>
                                <div class="text-xs text-gray-500 dark:text-blue-500">2 jam yang lalu</div>
                            </div>
                        </a>
                    </div>
                    <a href="#" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                        <div class="inline-flex items-center ">
                            <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                            </svg>
                            Lihat Semua
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <p id="datetime" class="sm:text-sm ps-4 text-xs font-normal text-TeksSecond pt-5  sm:pt-3 lg:py-1 bg-white "></p>
        <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700 mb-5">
        <div class="p-4 m-4 rounded-lg dark:border-gray-700">
            @yield('MainPerusahaan')
        </div>
    </div>

    <!-- WhatsApp -->
    <div class="fixed bottom-4 right-4 z-50 group">
        <a href="https://wa.me/6281234567890" target="_blank"
            class="bg-green-500 hover:bg-green-600 text-white p-3 rounded-full shadow-lg transition duration-300 flex items-center justify-center">
            <!-- WhatsApp Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.52 3.48A11.75 11.75 0 0 0 2.63 17.38l-1.38 5.06 5.21-1.37a11.72 11.72 0 0 0 5.55 1.41c6.48 0 11.75-5.27 11.75-11.75a11.7 11.7 0 0 0-3.24-8.25zm-8.77 17.26a9.91 9.91 0 0 1-5.06-1.38l-.36-.21-3.1.82.83-3.02-.24-.37a9.92 9.92 0 1 1 7.93 4.16zm5.45-7.38c-.3-.15-1.76-.86-2.03-.96-.27-.1-.47-.15-.67.15-.2.3-.77.95-.94 1.14-.17.2-.35.22-.64.07-.3-.15-1.26-.46-2.4-1.47-.89-.8-1.48-1.77-1.65-2.07-.17-.3-.02-.46.13-.6.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.61-.92-2.2-.24-.58-.48-.5-.67-.51h-.57c-.2 0-.52.07-.79.37s-1.04 1.02-1.04 2.5 1.07 2.9 1.22 3.1c.15.2 2.1 3.2 5.08 4.49.71.31 1.26.5 1.69.64.71.23 1.35.2 1.86.12.57-.09 1.76-.72 2.01-1.41.25-.69.25-1.27.17-1.41-.08-.13-.27-.2-.57-.35z" />
            </svg>
        </a>

        <!-- Tooltip Text -->
        <div class="absolute right-14 bottom-1/2 translate-y-1/2 bg-white text-black text-sm px-4 py-2 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none shadow-lg w-max whitespace-nowrap">
            Dapatkan bantuan dengan menghubungi admin
        </div>
    </div>

    <script>
        document.querySelector('.sign-out-btn').addEventListener('click', function(event) {
            if (!confirm('Apakah Anda yakin ingin keluar?')) {
                event.preventDefault(); // Mencegah logout jika pengguna membatalkan
            }
        });
    </script>

</body>