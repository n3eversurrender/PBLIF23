@extends('layouts.main')

@section('Main')

<main class="mt-24">
    <form action="">
        <div class="flex justify-center">
            <div class="text-center">
                <img src="{{ asset('image/SKILLB.png') }}" alt="" class="w-44 h-44 rounded-full mb-4">
                <p class="font-bold text-lg">William James Moriarty</p>
                <p class="text-gray-600 text-xs">williamjamesmoriarty@gmail.com</p>
            </div>
        </div>
        <div class="sm:flex gap-6 m-10">
            <div class="w-full">
                <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Nama</label>
                <input type="text"
                    aria-label=" input"
                    class="  border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Nama Anda" >

                <label class="block mb-2 mt-6 text-sm font-bold text-gray-900 dark:text-white">No Telepon</label>
                <input type="number"
                    class="  border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="nomor telepon Anda" >


                <label class="block mb-2 mt-6 text-sm font-bold text-gray-900 dark:text-white">Alamat</label>
                <textarea
                    class=" border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Alamat Anda" ></textarea>
            </div>

            <div class="w-full sm:mt-0 mt-5">
                <label for="kata_sandi" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Kata Sandi</label>
                <input type="password"
                    class="  border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Kata Sandi" >

                <label for="jenis_kelamin" class="block mb-2 mt-6 text-sm font-bold text-gray-900 dark:text-white">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin"
                    class="  border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                    <option selected >Pilih Jenis Kelamin</option>
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>
                <div class="w-full">
                    <label class="block mb-2 mt-6 text-sm font-bold text-gray-900 dark:text-white">Foto Profil</label>
                    <input type="file"
                        class="bg-gray-50 border border-Border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" accept="image/jpeg, image/png, image/gif, image/svg+xml" >
                </div>
            </div>
        </div>

        <!-- pengalaman diri -->
        <div class="m-10">
            <div class="sm:flex gap-6">
                <div class="w-full">
                    <p class="text-base font-bold mb-5 mt-7">Pengalaman Diri</p>
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Status</label>
                    <input type="text"
                        aria-label=" input"
                        class="  border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Status anda cth.Mahasiswa" >
                </div>

                <div class="w-full sm:mt-[72px] mt-5">
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Pendidikan</label>
                    <input type="text"
                        aria-label=" input"
                        class="  border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Sarjana" >

                </div>
            </div>

            <div>
                <label class="block mb-2 mt-6 text-sm font-bold text-gray-900 dark:text-white">Minat Bidang</label>
                <textarea
                    class=" border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="contohh. welding" ></textarea>
            </div>
        </div>

        <!-- pengalaman diri opsional -->
        <div class="m-10">
            <div class="sm:flex gap-6">
                <div class="w-full">
                    <p class="text-base font-bold mb-5 mt-7">Pengalaman Diri (Opsional) </p>
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Bidang saat ini</label>
                    <input type="text"
                        aria-label=" input"
                        class="  border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="cth. QA/QC inpector" >
                </div>

                <div class="w-full sm:mt-[72px] mt-5">
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Pengalaman (Tahun)</label>
                    <input type="number"
                        aria-label=" input"
                        class="  border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Sarjana" >

                </div>
            </div>

            <div>
                <label class="block mb-2 mt-6 text-sm font-bold text-gray-900 dark:text-white">Kemampuan (Opsional)</label>
                <textarea
                    class=" border border-Border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Visual inpection, NOT" ></textarea>
            </div>
        </div>
        <div class="flex justify-end w-full mt-5 mb-10">
            <button type="submit" class="text-white bg-ButtonBase hover:bg-HoverGlow focus:ring-4 focus:ring-HoverGlow font-medium rounded-md text-sm px-10 py-1.5 me-2 mb-2  focus:outline-none duration-700 transition">
                Simpan
            </button>
        </div>
    </form>
</main>

@endsection