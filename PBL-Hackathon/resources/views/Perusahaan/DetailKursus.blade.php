@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')

<main>
    <div class="">
        <div class="">
            <div class="text-sm text-gray-500 mb-2">
                <a href="/kursus" class="hover:underline">Kelola Kursus</a> &gt; <span class="hover:underline text-blue-600">Detail Kursus</span>
            </div>
            <h2 class="text-xl font-bold">{{ $kursus->judul }}</h2>
            <p class="text-gray-600">
                Level: {{ $kursus->tingkat_kesulitan }} |
                Total Peserta: {{ $kursus->pendaftaran->count() }}
            </p>


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
                        <div class="max-w-md w-full">
                            @if ($kursus->foto_kursus)
                            <img src="{{ asset('storage/' . $kursus->foto_kursus) }}"
                                class="w-full h-auto aspect-video rounded-lg object-cover mt-2">
                            @else
                            <img src="{{ asset('image/Thumnnail.jpg') }}"
                                class="w-full h-auto aspect-video rounded-lg object-cover mt-2">
                            @endif
                        </div>


                        <div>
                            <h3 class="font-semibold text-base text-gray-700">Deskripsi Kursus</h3>
                            <div class="text-gray-600 text-sm">{!! $kursus->deskripsi !!}</div>
                        </div>
                    </div>

                    <div class="mt-6 pb-10">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6 text-gray-700 mt-4">
                            <!-- <div class="flex">
                                <h3 class="font-semibold">Mentor:</h3>
                                <span class="ms-3 font-normal text-sm self-center">{{ $kursus->mentor ?? '-' }}</span>
                            </div> -->

                            <div class="flex">
                                <h3 class="font-semibold">Jadwal:</h3>
                                <span class="ms-3 font-normal text-sm self-center">
                                    {{ \Carbon\Carbon::parse($kursus->tgl_mulai)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($kursus->tgl_selesai)->format('d M Y') }}
                                </span>
                            </div>

                            <div class="flex">
                                <h3 class="font-semibold">Durasi:</h3>
                                <span class="ms-3 font-normal text-sm self-center">
                                    {{ \Carbon\Carbon::parse($kursus->tgl_mulai)->diffForHumans($kursus->tgl_selesai, true) }}
                                </span>
                            </div>

                            <div class="flex">
                                <h3 class="font-semibold">Lokasi:</h3>
                                <span class="ms-3 font-normal text-sm self-center">{{ $kursus->lokasi }}</span>
                            </div>

                            <div class="flex">
                                <h3 class="font-semibold">Harga:</h3>
                                <span class="ms-3 font-normal text-sm self-center">Rp {{ number_format($kursus->harga, 0, ',', '.') }}</span>
                            </div>
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
                            @forelse ($kursus->jadwalKursus as $jadwal)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <th scope="row" class="px-6 py-4">{{ $jadwal->sesi }}</th>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }} WIB</td>
                                <td class="px-6 py-4">{{ $jadwal->lokasi }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 py-4">Belum ada jadwal</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>

            <div id="peserta" class="hidden">
                <div class="overflow-x-auto">
                    <div class="flex justify-end mb-4">
                        <button onclick="copyNomorWA()" class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded">
                            📋 Salin Semua Nomor WhatsApp
                        </button>
                    </div>
                    <textarea id="wa-nomor-list" class="hidden">
                    @foreach ($kursus->pendaftaran as $daftar)
                    @php
                        $nomor = preg_replace('/[^0-9]/', '', $daftar->pengguna->no_telepon ?? '');
                        $nomorWa = preg_replace('/^0/', '62', $nomor);
                    @endphp
                    {{ $nomorWa }}
                    @endforeach
                    </textarea>

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
                            @forelse ($kursus->pendaftaran as $index => $daftar)
                            <tr class="border-t">
                                <td class="py-3 px-4">{{ $index + 1 }}</td>
                                <td class="py-3 px-4">{{ $daftar->pengguna->nama ?? '-' }}</td>
                                <td class="py-3 px-4">
                                    @if($daftar->pengguna && $daftar->pengguna->no_telepon)
                                    @php
                                    $nomor = preg_replace('/[^0-9]/', '', $daftar->pengguna->no_telepon);
                                    $nomorWa = preg_replace('/^0/', '62', $nomor);
                                    @endphp
                                    <a href="https://wa.me/{{ $nomorWa }}" target="_blank" class="text-green-600 hover:underline">
                                        {{ $daftar->pengguna->no_telepon }}
                                    </a>
                                    @else
                                    -
                                    @endif
                                </td>

                                <td class="py-3 px-4">{{ $daftar->pengguna->alamat ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr class="border-t">
                                <td colspan="4" class="py-3 px-4 text-center text-gray-500">Belum ada peserta yang mendaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>

<script>
    function copyNomorWA() {
        const textArea = document.getElementById('wa-nomor-list');
        const cleaned = textArea.value.trim().split('\n').filter(n => n).join(', ');

        navigator.clipboard.writeText(cleaned).then(() => {
            alert("Nomor berhasil disalin! Tinggal paste di WhatsApp.");
        }, () => {
            alert("Gagal menyalin nomor.");
        });
    }
</script>


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