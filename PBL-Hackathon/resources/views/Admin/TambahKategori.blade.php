@extends('layouts.mainAdmin')

@section('MainAdmin')

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Tambah Kategori</h2>

    <form action="{{ route('kategori.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="nama_kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" class="block w-full px-3 py-2 mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukan Nama" required>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                <i class="fas fa-save mr-2"></i> Simpan
            </button>
        </div>
    </form>
</div>

@endsection