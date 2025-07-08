@extends('layouts.main')

@section('Main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Tagify CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">


<main class="mt-24 lg:mx-32">
    <div class="flex justify-center">
        <div class="text-center">
            <img src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('image/SKILLB.png') }}" alt="Foto Profil" class="w-44 h-44 rounded-full mb-4">
            <p class="font-bold text-lg flex items-center justify-center space-x-2">
                <span>{{ Auth::user()->nama }}</span>

                @if(Auth::user()->status_verifikasi == 'Sudah Diverifikasi')
                <!-- Ikon centang biru dengan border lingkaran -->
                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full border-2 border-blue-500 text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L9 14.414l-3.707-3.707a1 1 0 011.414-1.414L9 11.586l6.293-6.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                @else
                <!-- Ikon silang merah dengan border lingkaran -->
                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full border-2 border-red-500 text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 8.586l4.95-4.95a1 1 0 111.414 1.414L11.414 10l4.95 4.95a1 1 0 01-1.414 1.414L10 11.414l-4.95 4.95a1 1 0 01-1.414-1.414L8.586 10l-4.95-4.95a1 1 0 011.414-1.414L10 8.586z" clip-rule="evenodd" />
                    </svg>
                </span>
                @endif
            </p>
            <p class="text-gray-600 text-xs">{{ Auth::user()->email }}</p>
        </div>
    </div>

    <form id="profilForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Informasi Dasar -->
        <div class="sm:flex gap-6 m-10">
            <div class="w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $user->nama) }}"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:opacity-70">

                <label class="block mb-2 mt-6 text-sm font-medium text-gray-900">No Telepon</label>
                <input type="number" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:opacity-70">

                <label class="block mb-2 mt-6 text-sm font-medium text-gray-900">Alamat</label>
                <textarea name="alamat"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:opacity-70">{{ old('alamat', $user->alamat) }}</textarea>
            </div>

            <div class="w-full sm:mt-0 mt-5">
                <label class="block mb-2 text-sm font-medium text-gray-900">Foto Profil</label>
                <input type="file" name="foto_profil"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full h-[42px] file:bg-gray-50 file:border-none file:rounded file:px-3 file:py-0 file:text-sm disabled:cursor-not-allowed disabled:bg-gray-100 disabled:opacity-70"
                    accept="image/*">
            </div>
        </div>

        <!-- Pengalaman Diri -->
        <div class="m-10">
            <div class="sm:flex gap-6">
                <div class="w-full">
                    <p class="text-base font-bold mb-5 mt-7">Pengalaman Diri</p>

                    <label class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                    <select name="status"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:opacity-70">
                        @php
                        $statuses = ['Mahasiswa', 'Pekerja', 'Dosen', 'Lainnya'];
                        $selectedStatus = old('status', $user->peserta->status ?? '');
                        @endphp
                        @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ $selectedStatus === $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full sm:mt-[72px] mt-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Pendidikan</label>
                    <select name="pendidikan"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:opacity-70">
                        @php
                        $pendidikans = ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'];
                        $selectedPendidikan = old('pendidikan', $user->peserta->pendidikan ?? '');
                        @endphp
                        @foreach ($pendidikans as $p)
                        <option value="{{ $p }}" {{ $selectedPendidikan === $p ? 'selected' : '' }}>{{ $p }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="sm:flex gap-6 mt-5">
                <!-- Bidang Saat Ini -->
                <div class="w-full sm:w-1/3">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Bidang saat ini</label>
                    <input type="text" name="bidang_saat_ini"
                        value="{{ old('bidang_saat_ini', isset($user->peserta->bidang_saat_ini) && is_array(json_decode($user->peserta->bidang_saat_ini, true)) ? implode(', ', array_column(json_decode($user->peserta->bidang_saat_ini, true), 'bidang')) : '') }}"
                        placeholder="{{ isset($user->peserta->bidang_saat_ini) && is_array(json_decode($user->peserta->bidang_saat_ini, true)) ? implode(', ', array_column(json_decode($user->peserta->bidang_saat_ini, true), 'bidang')) : 'Data masih kosong' }}"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:opacity-70"
                        disabled>
                </div>

                <!-- Pengalaman Tahun -->
                <div class="w-full sm:w-1/3 mt-5 sm:mt-0">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Pengalaman (Tahun)</label>
                    <input type="number" name="tahun_pengalaman"
                        value="{{ old('tahun_pengalaman', $user->peserta->tahun_pengalaman ?? '') }}"
                        placeholder="{{ $user->peserta->tahun_pengalaman ?? 'Data masih kosong' }}"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:opacity-70"
                        disabled>
                </div>

                <!-- Pengalaman Bulan -->
                <div class="w-full sm:w-1/3 mt-5 sm:mt-0">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Pengalaman (Bulan)</label>
                    <input type="number" name="bulan_pengalaman"
                        value="{{ old('bulan_pengalaman', $user->peserta->bulan_pengalaman ?? '') }}"
                        placeholder="{{ $user->peserta->bulan_pengalaman ?? 'Data masih kosong' }}"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:opacity-70"
                        disabled>
                </div>
            </div>

            @php
            $minatBidang = isset($user->peserta) ? $user->peserta->minat_bidang : [];
            $kemampuan = isset($user->peserta) ? $user->peserta->kemampuan : [];

            // Handle kalau masih dalam bentuk string JSON
            if (is_string($minatBidang)) {
            $minatBidang = json_decode($minatBidang, true);
            }

            if (is_string($kemampuan)) {
            $kemampuan = json_decode($kemampuan, true);
            }

            // Kalau array dalam format [{"bidang": "xxx"}], ambil hanya value-nya
            if (is_array($minatBidang) && isset($minatBidang[0]['bidang'])) {
            $minatBidang = array_column($minatBidang, 'bidang');
            }

            if (is_array($kemampuan) && isset($kemampuan[0]['value'])) {
            $kemampuan = array_column($kemampuan, 'value');
            }
            @endphp


            <div class="sm:flex gap-6 mt-5">
                <!-- Minat Bidang -->
                <div class="w-full sm:w-1/2">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Minat Bidang</label>
                    <input name="minat_bidang" id="minat_bidang"
                        value="{{ old('minat_bidang', isset($peserta->minat_bidang) ? $peserta->minat_bidang : '') }}"
                        placeholder="{{ isset($peserta->minat_bidang) && $peserta->minat_bidang !== '' ? $peserta->minat_bidang : 'Data masih kosong' }}"
                        class="border border-gray-300 text-sm rounded-lg block w-full p-2.5 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:opacity-70">
                </div>

                <!-- Kemampuan -->
                <div class="w-full sm:w-1/2 mt-5 sm:mt-0">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Kemampuan (Opsional)</label>
                    <input name="kemampuan" id="kemampuan"
                        value="{{ old('kemampuan', $peserta->kemampuan ? implode(', ', json_decode($peserta->kemampuan, true)) : '') }}"
                        placeholder="{{ $peserta->kemampuan ? implode(', ', json_decode($peserta->kemampuan, true)) : 'Data masih kosong' }}"
                        class="border border-gray-300 text-sm rounded-lg block w-full p-2.5 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:opacity-70">
                </div>
            </div>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end w-full mb-5 gap-4 me-10">
            <button type="button" id="editBtn"
                class="text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-lg text-sm px-10 py-2">
                Edit
            </button>

            <button type="submit"
                class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-10 py-2">
                Simpan
            </button>
        </div>
    </form>


    <form action="" class="mb-20">
        <div class="sm:mt-6 mt-4">
            <a href="#"
                id="togglePasswordForm"
                class="text-ButtonBase text-sm font-semibold hover:text-HoverGlow active:text-HoverGlow transition duration-500 text-center block w-full">
                Ingin mengubah kata sandi anda?
            </a>


            <div class="flex justify-center">
                <div id="passwordForm" class="mt-5 bg-gray-100 rounded-lg shadow-md px-6 pt-6 hidden w-2/3">
                    <label for="kata_sandi" id="kata_sandi" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Kata Sandi Lama</label>
                    <input type="password"
                        class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="********">

                    <label for="kata_sandi" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white mt-4">Kata Sandi Baru</label>
                    <input type="password"
                        class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="********">

                    <label for="konfirmasi_kata_sandi" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white mt-4">Konfirmasi Kata Sandi Baru</label>
                    <input type="password"
                        class="border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="********">
                    <div class="flex justify-end w-full my-5">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-HoverGlow focus:ring-4 focus:ring-HoverGlow font-medium rounded-md text-sm px-10 py-1.5 me-5 focus:outline-none duration-700 transition">
                            Simpan Kata Sandi
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <script>
            document.getElementById('togglePasswordForm').addEventListener('click', function(e) {
                e.preventDefault(); // Mencegah link reload halaman
                const passwordForm = document.getElementById('passwordForm');
                passwordForm.classList.toggle('hidden'); // Menyembunyikan atau menampilkan form
            });
        </script>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>


<!-- ========== SCRIPT SECTION ========== -->
<!-- SCRIPT: Toggle Edit -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('profilForm');
        const editBtn = document.getElementById('editBtn');
        const inputs = form.querySelectorAll('input, textarea, select');

        // Nonaktifkan semua input di awal
        inputs.forEach(input => {
            if (!['minat_bidang', 'kemampuan'].includes(input.name)) {
                input.disabled = true;
            }
        });

        editBtn.addEventListener('click', () => {
            inputs.forEach(input => input.disabled = false);
            tagifyMinat.DOM.input.removeAttribute('disabled');
            tagifyKemampuan.DOM.input.removeAttribute('disabled');
        });

        // Tagify - Minat Bidang
        const inputMinat = document.querySelector('#minat_bidang');
        let initialTags = [];
        try {
            initialTags = JSON.parse(inputMinat.value);
        } catch (e) {}
        const tagifyMinat = new Tagify(inputMinat, {
            whitelist: initialTags,
            enforceWhitelist: false,
            dropdown: {
                enabled: 1,
                fuzzySearch: true,
                position: 'text',
                caseSensitive: false
            }
        });
        tagifyMinat.addTags(initialTags);

        // Tagify - Kemampuan
        const inputKemampuan = document.querySelector('#kemampuan');

        let initialSkillsRaw = inputKemampuan.value;
        let initialSkills = [];

        try {
            // parse string to array
            const parsed = JSON.parse(initialSkillsRaw);

            // jika isinya [{value: '...'}], ambil nilai 'value' aja
            if (Array.isArray(parsed) && parsed.length && parsed[0].value) {
                initialSkills = parsed.map(item => item.value);
            } else {
                initialSkills = parsed;
            }
        } catch (e) {
            console.warn('Gagal parse kemampuan:', e);
            initialSkills = [];
        }

        const tagifyKemampuan = new Tagify(inputKemampuan, {
            whitelist: initialSkills,
            enforceWhitelist: false,
            dropdown: {
                enabled: 1,
                fuzzySearch: true,
                position: 'text',
                caseSensitive: false,
            }
        });

        tagifyKemampuan.addTags(initialSkills);

    });
</script>

@endsection