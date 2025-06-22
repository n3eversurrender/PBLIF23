@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')

<main>
    <div class="flex items-center space-x-2 text-sm text-gray-500 pb-6">
        <a href="{{ route('UlasanPerusahaan') }}" class="hover:text-blue-600 transition">Ulasan</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-blue-600 font-medium">Detail Ulasan</span>
    </div>

    <div class="mb-4">
        <h2 class="text-xl font-bold">{{ $kursus->judul }}</h2>
        <p class="text-gray-600">
            Rata-Rata Ulasan:
            <i class="fas fa-star text-yellow-400 text-sm me-1"></i>
            {{ round($ulasan->avg('rating'), 1) }}
            | Total Ulasan:
            {{ $ulasan->count() }}
        </p>
    </div>

    <button id="btn-analisa"
        class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition mb-4 inline-flex items-center">
        <svg id="spinner" class="hidden animate-spin mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
        <span id="btn-text">Analisa Kursus Ini</span>
    </button>


    <div id="hasil-analisa" class="hidden">
        <div class="bg-white shadow rounded p-4 mb-4">
            <h3 class="font-semibold text-lg mb-2">Distribusi Sentimen</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                <div>
                    <p id="positif">Positif: 0%</p>
                </div>
                <div>
                    <p id="negatif">Negatif: 0%</p>
                </div>
                <div>
                    <p id="netral">Netral: 0%</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-100 p-3 rounded mb-3">
            <p id="batasAman"><strong>Batas Aman:</strong> N/A</p>
            <p id="predNegatif"><strong>Prediksi Negatif Saat Ini:</strong> N/A</p>
        </div>

        <div class="bg-green-100 p-3 rounded mb-3">
            <p id="rekomendasiDSS"><strong>Rekomendasi DSS:</strong> -</p>
        </div>
    </div>

    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Pengulas</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Ulasan</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-600">Rating</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($ulasan as $index => $review)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">{{ $index + 1 }}</td>
                <td class="px-4 py-3 font-medium text-gray-800">
                    {{ $review->pengguna->nama ?? 'Pengguna Anonim' }}
                </td>
                <td class="px-4 py-3 text-gray-600">
                    {{ $review->komentar ?? 'Tidak ada komentar.' }}
                </td>
                <td class="px-4 py-3 text-gray-600">
                    <i class="fas fa-star text-yellow-400 text-sm me-2"></i>
                    {{ $review->rating }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-4 py-3 text-center text-gray-600">Belum ada ulasan untuk kursus ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6">
        <a href="{{ route('UlasanPerusahaan') }}"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Ulasan
        </a>
    </div>
</main>

<button id="btn-analisa"
    class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition mb-4 inline-flex items-center">
    <svg id="spinner" class="hidden animate-spin mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
    </svg>
    <span id="btn-text">Analisa Kursus Ini</span>
</button>

<script>
    const btn = document.getElementById('btn-analisa');
    const spinner = document.getElementById('spinner');
    const btnText = document.getElementById('btn-text');

    btn.addEventListener('click', function() {
        btn.disabled = true;
        spinner.classList.remove('hidden');
        btnText.innerText = "Sedang menganalisis...";

        fetch("{{ route('ulasan.analisa', $kursus->kursus_id) }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('hasil-analisa').classList.remove('hidden');
                document.getElementById('positif').innerText = `Positif: ${((data.distribusi?.positif || 0) * 100).toFixed(1)}%`;
                document.getElementById('negatif').innerText = `Negatif: ${((data.distribusi?.negatif || 0) * 100).toFixed(1)}%`;
                document.getElementById('netral').innerText = `Netral: ${((data.distribusi?.netral || 0) * 100).toFixed(1)}%`;
                document.getElementById('batasAman').innerHTML = `<strong>Batas Aman:</strong> ${data.batas_aman !== null ? data.batas_aman.toFixed(1) + '%' : 'N/A'}`;
                document.getElementById('predNegatif').innerHTML = `<strong>Prediksi Negatif Saat Ini:</strong> ${data.pred_negatif !== null ? data.pred_negatif.toFixed(1) + '%' : 'N/A'}`;
                document.getElementById('rekomendasiDSS').innerHTML = `<strong>Rekomendasi DSS:</strong> ${data.rekomendasi}`;
            })
            .catch(() => {
                alert("Gagal mengambil data analisa. Silakan coba lagi.");
            })
            .finally(() => {
                btn.disabled = false;
                spinner.classList.add('hidden');
                btnText.innerText = "Analisa Kursus Ini";
            });
    });
</script>


@endsection