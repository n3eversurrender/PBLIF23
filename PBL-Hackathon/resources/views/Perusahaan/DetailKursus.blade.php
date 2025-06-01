@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')

<main>
    <div class="">
        <div class="">
            <div class="text-sm text-gray-500 mb-2">
                <a href="/kursus" class="hover:underline">Kelola Kursus</a> &gt; <span class="hover:underline text-blue-600">Detail Kursus</span>
            </div>

            <h2 class="text-xl font-bold">Welding Pro</h2>
            <p class="text-gray-600">Level: Lanjutan | Total Peserta: 35</p>

            <!-- Tabs -->
            <div class="flex border-b mt-4 space-x-6">
                <button id="tab-info" onclick="showTab('info')" class="pb-2 border-b-2 border-blue-600 font-semibold">Info Umum</button>
                <button id="tab-jadwal" onclick="showTab('jadwal')" class="pb-2 text-gray-600 hover:text-blue-600">Jadwal Pertemuan</button>
                <button id="tab-peserta" onclick="showTab('peserta')" class="pb-2 text-gray-600 hover:text-blue-600">Peserta</button>
            </div>

            <!-- Content -->
            <div class="mt-4">
                <div id="info">

                    <div class="sm:flex gap-4">
                        <div>
                            <img src="{{ asset('image/12.webp') }}" class=" aspect-video rounded-lg object-cover mt-2">
                        </div>
                        <div>
                            <h3 class="font-semibold text-base text-gray-700">Deskripsi Kursus</h3>
                            <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti corrupti qui fugiat consequatur laboriosam voluptatum reprehenderit facilis, deserunt quae quam totam? Dolorum suscipit, sequi modi temporibus ipsum fugiat excepturi ut placeat eaque! Vero, ea. Cumque, doloribus. Accusamus expedita ducimus eius, recusandae accusantium, deserunt obcaecati sed quia perferendis repudiandae quas debitis. Aperiam repellat in doloribus amet soluta cumque tenetur recusandae corrupti! Delectus officia incidunt mollitia qui soluta quae quia consectetur, eaque adipisci esse doloribus voluptate est in vel officiis laboriosam eos explicabo enim totam harum similique impedit. Nulla doloremque deserunt, omnis, nihil consequatur totam rerum hic ab labore ullam ratione modi.</p>
                        </div>
                    </div>

                    <div class="mt-6 pb-10">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6 text-gray-700 mt-4">
                            <div class="flex">
                                <h3 class="font-semibold">Mentor:</h3>
                                <span class="ms-3 font-normal text-sm self-center">Fulan</span>
                            </div>

                            <div class="flex">
                                <h3 class="font-semibold">Jadwal:</h3>
                                <span class="ms-3 font-normal text-sm self-center">02 April 2025 s/d 29 Juni 2025</span>
                            </div>

                            <div class="flex">
                                <h3 class="font-semibold">Durasi:</h3>
                                <span class="ms-3 font-normal text-sm self-center">2 bulan 27 hari</span>
                            </div>

                            <div class="flex">
                                <h3 class="font-semibold">Lokasi:</h3>
                                <span class="ms-3 font-normal text-sm self-center">Batam Lubuk Baja</span>
                            </div>

                            <div class="flex">
                                <h3 class="font-semibold">Harga:</h3>
                                <span class="ms-3 font-normal text-sm self-center">Rp. 6.000.000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="jadwal" class="hidden">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-400 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Sesi</th>
                                    <th scope="col" class="px-6 py-3">Tanggal</th>
                                    <th scope="col" class="px-6 py-3">Waktu</th>
                                    <th scope="col" class="px-6 py-3">Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <th scope="row" class="px-6 py-4">Sesi ke-1</th>
                                    <td class="px-6 py-4 ">15 Agustus 2023</td>
                                    <td class="px-6 py-4 ">15.00 WIB</td>
                                    <td class="px-6 py-4 ">Gedung A, Lantai 3</td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <th scope="row" class="px-6 py-4">Sesi ke-2</th>
                                    <td class="px-6 py-4 ">15 Agustus 2023</td>
                                    <td class="px-6 py-4 ">15.00 WIB</td>
                                    <td class="px-6 py-4 ">Gedung A, Lantai 3</td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <th scope="row" class="px-6 py-4">Sesi ke-3</th>
                                    <td class="px-6 py-4 ">15 Agustus 2023</td>
                                    <td class="px-6 py-4 ">15.00 WIB</td>
                                    <td class="px-6 py-4 ">Gedung A, Lantai 3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="peserta" class="hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 bg-white shadow-md rounded-lg">
                            <thead class="bg-gray-100 text-gray-700 text-sm font-semibold">
                                <tr>
                                    <th class="py-3 px-4 text-left">No</th>
                                    <th class="py-3 px-4 text-left">Nama Peserta</th>
                                    <th class="py-3 px-4 text-left">Nomor Telepon</th>
                                    <th class="py-3 px-4 text-left">Alamat</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-sm">
                                <tr class="border-t">
                                    <td class="py-3 px-4">1</td>
                                    <td class="py-3 px-4">Ilsa Rahayu</td>
                                    <td class="py-3 px-4">0809 8899 859</td>
                                    <td class="py-3 px-4">Ds. Gading No. 807, Balikpapan 93514, Gorontalo</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="py-3 px-4">2</td>
                                    <td class="py-3 px-4">Wani Indah Kusmawati</td>
                                    <td class="py-3 px-4">0677 1121 695</td>
                                    <td class="py-3 px-4">Ds. Pelajar Pejuang 45 No. 63, Langsa 62466, Jambi</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="py-3 px-4">3</td>
                                    <td class="py-3 px-4">Ophelia Yance Wastuti S.E.I</td>
                                    <td class="py-3 px-4">(+62) 944 0291 6952</td>
                                    <td class="py-3 px-4">Dk. Baiduri No. 682, Sukabumi 74805, Sultra</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function showTab(tabId) {
        const tabs = ['info', 'jadwal', 'peserta'];
        tabs.forEach(id => {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(`tab-${id}`).classList.remove('border-b-2', 'border-blue-600', 'font-semibold');
        });
        document.getElementById(tabId).classList.remove('hidden');
        document.getElementById(`tab-${tabId}`).classList.add('border-b-2', 'border-blue-600', 'font-semibold');
    }
</script>

@endsection