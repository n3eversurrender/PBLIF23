@extends('layouts.mainAdmin')

@section('MainAdmin')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Tambah Admin</h2>

    <form action="{{ route('admin.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama</label>
            <input type="text" name="nama" id="nama" class="block w-full px-3 py-2 mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan nama" required>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
            <input type="email" name="email" id="email" class="block w-full px-3 py-2 mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan email" required>
        </div>
        <div>
            <label for="no_telepon" class="block text-sm font-medium text-gray-700 dark:text-gray-200">No Telepon</label>
            <input type="text" name="no_telepon" id="no_telepon" class="block w-full px-3 py-2 mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan no telepon" required>
        </div>
        <div>
            <label for="kata_sandi" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Kata Sandi</label>
            <input type="password" name="kata_sandi" id="kata_sandi" class="block w-full px-3 py-2 mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan kata sandi" required>
        </div>

        <!-- Mengatur posisi Admin -->
        <input type="hidden" name="posisi" value="admin">

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                <i class="fas fa-save mr-2"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection