@extends('layouts.main')

@section('Main')
<main class="mt-24 mb-10 mx-10 text-center">
    <div class="bg-white shadow rounded-lg p-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Maaf, data perusahaan ini belum ada.</h1>
        <p class="text-gray-600">Silakan kembali nanti atau hubungi admin untuk informasi lebih lanjut.</p>
        <a href="{{ url('/') }}" class="inline-block mt-6 px-4 py-2 bg-primary hover:bg-primary/90 text-white rounded">
            Kembali ke Beranda
        </a>
    </div>
</main>
@endsection
