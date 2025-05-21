@extends('layouts.mainPelatih')

@section('MainPelatih')


<section class="grid grid-cols-3">
    <!-- Sidebar start -->
    <aside id="default-sidebar" aria-label="Sidebar">
        <div class="h-1/3 pe-2 w-72 bg-white">
            <!-- Search Start -->
            <form class="max-w-md mx-auto">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required />
                </div>
            </form>
            <!-- Search End -->

            <!-- List Chat Start -->
            <div class="flex justify-between my-5">
                <div>
                    <h1 class="font-bold text-2xl"> List Chat</h1>
                </div>
                <div>
                    <svg id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="flex items-center mt-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512">
                        <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z" />
                    </svg>

                    <!-- Dropdown menu -->
                    <div id="dropdownHover" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-32">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">List Group</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <ul class="space-y-3 font-medium overflow-y-auto max-h-[calc(100vh-200px)]"> <!-- Tambahkan overflow dan max-height -->
                <!-- Chat Group 1 -->
                <li>
                    <a class="flex items-center gap-4 rounded-lg pe-2 hover:bg-gray-100">
                        <img class="w-14 h-14 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium cursor-default dark:text-white w-full">
                            <div class="flex justify-between">
                                <div>Welder Class</div>
                                <div class="text-xs flex items-center">23.20</div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <p class="h-4 overflow-hidden">Liam: <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta, repudiandae.</span></p>
                            </div>
                        </div>
                    </a>
                </li>

                <!-- Chat Personal -->
                <li>
                    <a class="flex items-center gap-4 rounded-lg pe-2 hover:bg-gray-100">
                        <img class="w-14 h-14 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium cursor-default dark:text-white w-full">
                            <div class="flex justify-between">
                                <div>Liam</div>
                                <div class="text-xs flex items-center">23.20</div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <p class="h-4 overflow-hidden">Lorem ipsum dolor sit amet blabla consectetur adipisicing elit. Dicta, repudiandae.</p>
                            </div>
                        </div>
                    </a>
                </li>

                <!-- Duplicate Chats (Tiru bagian ini untuk setiap entri chat) -->
                <!-- Tambahkan lebih banyak entri chat di sini -->
                <li>
                    <a class="flex items-center gap-4 rounded-lg pe-2 hover:bg-gray-100">
                        <img class="w-14 h-14 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium cursor-default dark:text-white w-full">
                            <div class="flex justify-between">
                                <div>Liam</div>
                                <div class="text-xs flex items-center">23.20</div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <p class="h-4 overflow-hidden">Lorem ipsum dolor sit amet blabla consectetur adipisicing elit. Dicta, repudiandae.</p>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Ulangi blok ini sesuai kebutuhan -->

                <li>
                    <a class="flex items-center gap-4 rounded-lg pe-2 hover:bg-gray-100">
                        <img class="w-14 h-14 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium cursor-default dark:text-white w-full">
                            <div class="flex justify-between">
                                <div>Liam</div>
                                <div class="text-xs flex items-center">23.20</div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <p class="h-4 overflow-hidden">Lorem ipsum dolor sit amet blabla consectetur adipisicing elit. Dicta, repudiandae.</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-4 rounded-lg pe-2 hover:bg-gray-100">
                        <img class="w-14 h-14 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium cursor-default dark:text-white w-full">
                            <div class="flex justify-between">
                                <div>Liam</div>
                                <div class="text-xs flex items-center">23.20</div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <p class="h-4 overflow-hidden">Lorem ipsum dolor sit amet blabla consectetur adipisicing elit. Dicta, repudiandae.</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-4 rounded-lg pe-2 hover:bg-gray-100">
                        <img class="w-14 h-14 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium cursor-default dark:text-white w-full">
                            <div class="flex justify-between">
                                <div>Liam</div>
                                <div class="text-xs flex items-center">23.20</div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <p class="h-4 overflow-hidden">Lorem ipsum dolor sit amet blabla consectetur adipisicing elit. Dicta, repudiandae.</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-4 rounded-lg pe-2 hover:bg-gray-100">
                        <img class="w-14 h-14 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium cursor-default dark:text-white w-full">
                            <div class="flex justify-between">
                                <div>Liam</div>
                                <div class="text-xs flex items-center">23.20</div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <p class="h-4 overflow-hidden">Lorem ipsum dolor sit amet blabla consectetur adipisicing elit. Dicta, repudiandae.</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-4 rounded-lg pe-2 hover:bg-gray-100">
                        <img class="w-14 h-14 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium cursor-default dark:text-white w-full">
                            <div class="flex justify-between">
                                <div>Liam</div>
                                <div class="text-xs flex items-center">23.20</div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <p class="h-4 overflow-hidden">Lorem ipsum dolor sit amet blabla consectetur adipisicing elit. Dicta, repudiandae.</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-4 rounded-lg pe-2 hover:bg-gray-100">
                        <img class="w-14 h-14 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium cursor-default dark:text-white w-full">
                            <div class="flex justify-between">
                                <div>Liam</div>
                                <div class="text-xs flex items-center">23.20</div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <p class="h-4 overflow-hidden">Lorem ipsum dolor sit amet blabla consectetur adipisicing elit. Dicta, repudiandae.</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-4 rounded-lg pe-2 hover:bg-gray-100">
                        <img class="w-14 h-14 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium cursor-default dark:text-white w-full">
                            <div class="flex justify-between">
                                <div>Liam</div>
                                <div class="text-xs flex items-center">23.20</div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <p class="h-4 overflow-hidden">Lorem ipsum dolor sit amet blabla consectetur adipisicing elit. Dicta, repudiandae.</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-4 rounded-lg pe-2 hover:bg-gray-100">
                        <img class="w-14 h-14 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium cursor-default dark:text-white w-full">
                            <div class="flex justify-between">
                                <div>Liam</div>
                                <div class="text-xs flex items-center">23.20</div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <p class="h-4 overflow-hidden">Lorem ipsum dolor sit amet blabla consectetur adipisicing elit. Dicta, repudiandae.</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-4 rounded-lg pe-2 hover:bg-gray-100">
                        <img class="w-14 h-14 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium cursor-default dark:text-white w-full">
                            <div class="flex justify-between">
                                <div>Liam</div>
                                <div class="text-xs flex items-center">23.20</div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <p class="h-4 overflow-hidden">Lorem ipsum dolor sit amet blabla consectetur adipisicing elit. Dicta, repudiandae.</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-4 rounded-lg pe-2 hover:bg-gray-100">
                        <img class="w-14 h-14 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium cursor-default dark:text-white w-full">
                            <div class="flex justify-between">
                                <div>Liam</div>
                                <div class="text-xs flex items-center">23.20</div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <p class="h-4 overflow-hidden">Lorem ipsum dolor sit amet blabla consectetur adipisicing elit. Dicta, repudiandae.</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-4 rounded-lg pe-2 hover:bg-gray-100">
                        <img class="w-14 h-14 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="">
                        <div class="font-medium cursor-default dark:text-white w-full">
                            <div class="flex justify-between">
                                <div>Liam</div>
                                <div class="text-xs flex items-center">23.20</div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <p class="h-4 overflow-hidden">Lorem ipsum dolor sit amet blabla consectetur adipisicing elit. Dicta, repudiandae.</p>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- List Chat End -->
        </div>
    </aside>
    <!-- Sidebar end -->

    <main class="col-span-2 bg-white p-5 rounded-lg shadow-md">
        <!-- Header Diskusi -->
        <div class="flex items-center mb-4">
            <img class="w-10 h-10 object-cover rounded-full" src="{{ asset('image/9203764.png') }}" alt="Liam's Profile">
            <h2 class="ml-3 text-lg font-semibold">Liam</h2>
        </div>

        <!-- Body Diskusi -->
        <div class="border-t border-gray-300 pt-4 overflow-y-auto max-h-[calc(100vh-300px)]">
            <div class="space-y-4">
                <!-- Pesan dari pengguna -->
                <div class="flex justify-end">
                    <div class="bg-blue-500 text-white p-3 rounded-lg">
                        <p class="text-sm">Ini adalah pesan dari pengguna.</p>
                    </div>
                </div>

                <!-- Pesan dari orang lain -->
                <div class="flex justify-start">
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <p class="text-sm text-gray-700">Ini adalah pesan dari orang lain.</p>
                    </div>
                </div>

                <!-- Contoh pesan lainnya -->
                <div class="flex justify-end">
                    <div class="bg-blue-500 text-white p-3 rounded-lg">
                        <p class="text-sm">Pesan lain dari pengguna.</p>
                    </div>
                </div>
                <div class="flex justify-start">
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <p class="text-sm text-gray-700">Pesan lain dari orang lain.</p>
                    </div>
                </div>
                <div class="flex justify-start">
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <p class="text-sm text-gray-700">Pesan lain dari orang lain.</p>
                    </div>
                </div>

                <!-- Pesan dari pengguna -->
                <div class="flex justify-end">
                    <div class="bg-blue-500 text-white p-3 rounded-lg">
                        <p class="text-sm">Ini adalah pesan dari pengguna.</p>
                    </div>
                </div>

                <!-- Pesan dari orang lain -->
                <div class="flex justify-start">
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <p class="text-sm text-gray-700">Ini adalah pesan dari orang lain.</p>
                    </div>
                </div>

                <!-- Contoh pesan lainnya -->
                <div class="flex justify-end">
                    <div class="bg-blue-500 text-white p-3 rounded-lg">
                        <p class="text-sm">Pesan lain dari pengguna.</p>
                    </div>
                </div>
                <div class="flex justify-start">
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <p class="text-sm text-gray-700">Pesan lain dari orang lain.</p>
                    </div>
                </div>
                <div class="flex justify-start">
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <p class="text-sm text-gray-700">Pesan lain dari orang lain.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input untuk Mengetik Pesan -->
        <div class="flex items-center mt-4">
            <input type="text" placeholder="Ketik pesan..." class="flex-grow border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <button class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Kirim</button>
        </div>
    </main>


</section>


@endsection