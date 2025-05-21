@extends('layouts.mainPelatih')

@section('MainPelatih')

<form action="{{ route('PengelolaanKursus.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-5">
        <label for="judul" class="block mb-2 text-base lg:text-xl font-bold text-gray-900 dark:text-white">Judul Kursus</label>
        <input type="text" name="judul" id="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"" >
        @error('judul')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>
    <div class=" mb-5">
        <label for="deskripsi" class="block mb-2 text-base lg:text-xl font-bold text-gray-900 dark:text-white">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"" ></textarea>
        @error('deskripsi')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>
    <div class=" sm:flex gap-3 mb-5">
        <div class="sm:w-1/2">
            <label for="tingkat_kesulitan" class="block mb-2 text-base lg:text-xl font-bold text-gray-900 dark:text-white">Tingkat Kesulitan</label>
            <select name="tingkat_kesulitan" id="tingkat_kesulitan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                <option value="-" disabled selected>Pilih Tingkat Kesulitan</option>
                <option value="Pemula">Pemula</option>
                <option value="Menengah">Menengah</option>
                <option value="Lanjutan">Lanjutan</option>
            </select>
            @error('tingkat_kesulitan')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="sm:w-1/2 sm:mt-0 mt-5">
            <label for="kategori_id" class="block mb-2 text-base lg:text-xl font-bold text-gray-900 dark:text-white">Kategori</label>
            <select name="kategori_id" id="kategori_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="-" disabled selected>Pilih Kategori</option>
                @foreach ($kategori as $item)
                <option value="{{ $item->kategori_id }}">{{ $item->nama_kategori }}</option>
                 @endforeach
            </select>
            @error('kategori_id')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="sm:flex gap-3 mb-5">
        <div class="sm:w-1/2">
            <label for="harga" class="block mb-2 text-base lg:text-xl font-bold text-gray-900 dark:text-white">Harga</label>
            <input type="number" name="harga" id="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            @error('harga')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="sm:w-1/2 sm:mt-0 mt-5">
            <label for="kapasitas" class="block mb-2 text-base lg:text-xl font-bold text-gray-900 dark:text-white">Kapasitas</label>
            <input type="number" name="kapasitas" id="kapasitas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            @error('kapasitas')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="sm:flex gap-3 mb-5">
        <div class="sm:w-1/2">
            <label for="tgl_mulai" class="block mb-2 text-base lg:text-xl font-bold text-gray-900 dark:text-white">Tanggal Mulai</label>
            <input type="date" name="tgl_mulai" id="tgl_mulai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            @error('tgl_mulai')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="sm:w-1/2 sm:mt-0 mt-5">
            <label for="tgl_selesai" class="block mb-2 text-base lg:text-xl font-bold text-gray-900 dark:text-white">Tanggal Selesai</label>
            <input type="date" name="tgl_selesai" id="tgl_selesai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            @error('tgl_selesai')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="sm:flex gap-3 mb-5">
    <div class="sm:w-1/2">
            <label for="lokasi" class="block mb-2 text-base lg:text-xl font-bold text-gray-900 dark:text-white">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"" >
            @error('lokasi')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="sm:w-1/2 sm:mt-0 mt-5">
            <label for="foto_kursus" class="block mb-2 text-base lg:text-xl font-bold text-gray-900 dark:text-white">Unggah Foto Kursus</label>
            <input type="file" name="foto_kursus" id="foto_kursus" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept=".jpg,.jpeg,.png,.gif">
            @error('foto_kursus')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button type="submit" class="px-3 py-2 mt-5 text-sm w-30 font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <i class="fas fa-paper-plane mr-2"></i>Simpan
    </button>
</form>

@endsection