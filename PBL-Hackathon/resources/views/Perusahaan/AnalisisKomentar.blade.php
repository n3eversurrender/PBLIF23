@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')
<main class="container mx-auto mt-6">
    <h1 class="text-2xl font-bold mb-4">Analisis Komentar</h1>

    @if (!empty($message))
    <div class="p-4 bg-yellow-100 text-yellow-700 rounded">
        {{ $message }}
    </div>
    @endif

    @if (!empty($hasilAnalisis))
    <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Komentar</th>
                <th class="border p-2">Sentimen</th>
                <th class="border p-2">Tema IndoBERT v2</th>
                <th class="border p-2">Topik BERTopic</th>
                <th class="border p-2">Topik Otomatis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasilAnalisis as $row)
            <tr>
                <td class="border p-2">{{ $row['komentar'] }}</td>
                <td class="border p-2">{{ $row['sentimen'] }}</td>
                <td class="border p-2">{{ $row['tema_v2'] }}</td>
                <td class="border p-2">{{ $row['topic_bertopic'] }}</td>
                <td class="border p-2">{{ $row['tema_bertopic_auto'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="mt-4">
        <a href="{{ route('statistikPerusahaan') }}" class="text-blue-600 hover:underline">← Kembali ke Statistik</a>
    </div>
</main>
@endsection