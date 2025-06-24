@extends('layouts.mainPerusahaan')

@section('MainPerusahaan')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<main>
    <!-- Stats Grid -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat Card 1 -->
        <div class="bg-white rounded-xl shadow-xl p-6 border-t-4 border-blue-500 card-hover">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Kursus Aktif</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $jumlahKursusAktif }}</h3>
                </div>
                <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                    <i class="fas fa-book-open text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white rounded-xl shadow-xl p-6 border-t-4 border-blue-500 card-hover">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Peserta</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($totalPeserta) }}</h3>
                </div>
                <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white rounded-xl shadow-xl p-6 border-t-4 border-blue-500 card-hover">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Rating Rata-rata Kursus</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($ratingRataRata, 1) }}</h3>
                </div>
                <div class="p-3 rounded-lg bg-amber-50 text-amber-600">
                    <i class="fas fa-star text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-xl p-6 border-t-4 border-blue-500 card-hover">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Rating Rata-rata Perusahaan</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($ratingRataRataPerusahaan, 1) }}</h3>
                </div>
                <div class="p-3 rounded-lg bg-amber-50 text-amber-600">
                    <i class="fas fa-star text-xl"></i>
                </div>
            </div>
        </div>
    </section>
    <!-- Pendapatan Bulan Ini -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center gap-4">
                <div class="bg-blue-100 p-2 rounded-full text-blue-600">
                    <i class="fas fa-wallet text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Pendapatan Bulan Ini</p>
                    <h3 class="text-2xl font-bold mt-1">
                        Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center gap-4">
                <div class="bg-green-100 p-2 rounded-full text-green-600">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pendapatan Tahun Ini</p>
                    <h3 class="text-2xl font-bold mt-1">
                        Rp {{ number_format($pendapatanTahunIni, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center gap-4">
                <div class="bg-amber-100 p-2 rounded-full text-amber-600">
                    <i class="fas fa-arrow-up text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Pertumbuhan Bulanan</p>
                    <h3 class="text-2xl font-bold mt-1">
                        {{ number_format($growth, 1) }}%
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <button onclick="prosesAnalisis()" class="bg-blue-500 text-white px-4 py-2 rounded mt-5">Proses Analisis</button>
    <div id="loading" class="text-sm text-gray-500 mt-2 hidden">
        <div class="inline-block w-4 h-4 border-2 border-gray-300 border-t-blue-500 rounded-full animate-spin"></div>
        Memproses analisis...
    </div>
    <canvas id="temaChart" class="bg-white p-4 rounded shadow mt-6 hidden">
    </canvas>

    <section class="mt-4">
        <h1 class="text-xl font-semibold mb-4">Kursus Terbaru</h1>

        @forelse ($kursusTerbaru as $kursus)
        <div class="bg-white shadow-lg flex items-center space-x-6 p-2 mb-4">
            <!-- Course Image -->
            <div class="relative flex-shrink-0 w-48 h-36 cursor-default rounded-lg overflow-hidden">
                @if ($kursus->foto_kursus)
                <img class="w-full h-full object-cover"
                    src="{{ asset('storage/' . $kursus->foto_kursus) }}"
                    alt="Course thumbnail">
                @else
                <img class="w-full h-full object-cover"
                    src="{{ asset('image/Thumnnail.jpg') }}"
                    alt="Course thumbnail">
                @endif
                <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                    {{ $kursus->tingkat_kesulitan }}
                </div>
            </div>

            <!-- Course Content -->
            <div class="flex flex-col justify-between flex-grow h-full">
                <div>
                    <div class="flex justify-between items-start mb-2 cursor-default">
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                            {{ $kursus->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                        </span>
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                            <span class="text-gray-700 text-sm font-medium ml-1">
                                {{ number_format($kursus->ratingKursus()->avg('rating') ?? 0, 1) }}
                            </span>
                            <span class="text-gray-400 text-sm ml-1">
                                ({{ $kursus->ratingKursus()->count() }})
                            </span>
                        </div>
                    </div>

                    <a href="#" class="text-lg font-bold text-gray-800 mb-1 line-clamp-2 hover:text-HoverGlow active:text-ButtonBase">
                        {{ $kursus->judul }}
                    </a>
                    <p class="text-gray-500 text-xs mb-4 line-clamp-2 cursor-default">
                        {{ Str::limit(strip_tags($kursus->deskripsi), 100) }}
                    </p>
                </div>

                <div class="flex items-center justify-between cursor-default">
                    <div class="flex items-center">
                        <img class="w-8 h-8 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Instructor">
                        <div class="ml-2">
                            <p class="text-sm font-medium text-gray-700">
                                {{ auth()->user()->nama ?? 'Admin' }}
                            </p>
                            <p class="text-xs text-gray-500">Pemilik Kursus</p>
                        </div>
                    </div>

                    <p class="text-ButtonBase font-bold text-base">Rp. {{ number_format($kursus->harga, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        @empty
        <p class="text-gray-500 text-sm">Belum ada kursus yang ditambahkan.</p>
        @endforelse

        <div class="px-6 py-4 border-t border-gray-200 text-center">
            <a href="{{ route('KursusPerusahaan') }}" class="text-primary hover:underline font-medium">Lihat Semua Kursus</a>
        </div>
    </section>


    <section class="mt-7">
        <!-- Recent Transactions and Notifications -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Riwayat Transaksi Terkini -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Transaksi Terakhir</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse ($transaksiTerakhir as $trx)
                    <div class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-lg mr-4">
                                    <i class="fas fa-check-circle text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium">{{ $trx->kursus->judul ?? 'Tanpa Judul' }}</p>
                                    <p class="text-sm text-gray-500">ID: TRX-{{ $trx->pendaftaran_id }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-green-600">
                                    Rp {{ number_format($trx->kursus->harga ?? 0, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($trx->created_at)->format('d M Y • H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="px-6 py-4 text-gray-500 text-sm">Belum ada transaksi.</p>
                    @endforelse
                </div>
                <div class="px-6 py-4 border-t border-gray-200 text-center">
                    <a href="#" class="text-primary hover:underline font-medium">
                        Lihat Semua Transaksi
                    </a>
                </div>
            </div>


            <!-- Notifikasi Terbaru -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Notifikasi Terbaru</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex items-start">
                            <div class="bg-blue-100 p-2 rounded-lg mr-4">
                                <i class="fas fa-user-plus text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Pendaftaran Baru</p>
                                <p class="text-sm text-gray-500">Budi Santoso mendaftar kursus Web Development</p>
                                <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex items-start">
                            <div class="bg-yellow-100 p-2 rounded-lg mr-4">
                                <i class="fas fa-star text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Ulasan Baru</p>
                                <p class="text-sm text-gray-500">Ani Wijaya memberikan rating 5 untuk kursus Data Science</p>
                                <p class="text-xs text-gray-400 mt-1">5 jam yang lalu</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex items-start">
                            <div class="bg-red-100 p-2 rounded-lg mr-4">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Pembayaran Gagal</p>
                                <p class="text-sm text-gray-500">Pembayaran untuk TRX-20230612 gagal diproses</p>
                                <p class="text-xs text-gray-400 mt-1">1 hari yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 text-center">
                    <a href="#" class="text-primary hover:underline font-medium">Lihat Semua Notifikasi</a>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let chartInstance = null;

    async function prosesAnalisis() {
        const loading = document.getElementById('loading');
        const canvas = document.getElementById('temaChart');

        loading.classList.remove('hidden');
        canvas.classList.add('hidden'); // Sembunyikan canvas saat proses mulai

        try {
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

            const res = await fetch('{{ url("/statistik/api/hasil-analisis") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({})
            });

            const data = await res.json();
            console.log("API Response:", data);

            if (data.tema_sentimen_count && Object.keys(data.tema_sentimen_count).length > 0) {
                const temaLabels = Object.keys(data.tema_sentimen_count);

                const positif = temaLabels.map(t => data.tema_sentimen_count[t]['positif'] || 0);
                const negatif = temaLabels.map(t => data.tema_sentimen_count[t]['negatif'] || 0);
                const netral = temaLabels.map(t => data.tema_sentimen_count[t]['netral'] || 0);

                if (chartInstance) chartInstance.destroy();

                chartInstance = new Chart(canvas.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: temaLabels,
                        datasets: [{
                                label: 'Positif',
                                data: positif,
                            },
                            {
                                label: 'Negatif',
                                data: negatif,
                            },
                            {
                                label: 'Netral',
                                data: netral,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                canvas.classList.remove('hidden'); // Tampilkan canvas kalau ada datanya
                canvas.style.width = '100%';
                canvas.style.height = 'auto';

            } else {
                alert("Data kosong atau tema_sentimen_count tidak tersedia.");
            }

        } catch (err) {
            console.error(err);
            alert("Terjadi kesalahan saat memproses: " + err.message);
        } finally {
            loading.classList.add('hidden');
        }
    }
</script>

@endsection