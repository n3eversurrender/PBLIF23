@extends('layouts.NavAndFoot')

@section('NavAndFoot')

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif


<div class="container mx-auto sm:px-4 mt-20">
    <form action="{{ route('processPayment') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->pendaftaran_id }}">
        
        <div class="bg-white p-2 sm:p-6 shadow-lg rounded-lg">
            <h3 class="text-lg sm:text-2xl font-bold mb-2 sm:mb-4">Pesanan anda</h3>
            <ul class="space-y-4">
                <li class="flex justify-between items-center text-sm sm:text-base">
                    <div class="flex items-center">
                        <img src="{{ asset('image/12.webp') }}" alt="Welding Beginner" class="w-12 sm:w-20 h-12 sm:h-20 mr-4 object-cover rounded-md">
                        <span>{{ $kursus->judul }}</span>
                    </div>
                    <span>{{ number_format($kursus->harga, 0, ',', '.') }}</span>
                </li>
            </ul>
            <hr class="my-4">
            <div class="flex justify-between text-sm sm:text-base">
                <span>Total Pembayaran</span>
                <span>Rp. {{ number_format($kursus->harga, 0, ',', '.') }}</span>
            </div>

            <!-- Separator -->
            <hr class="my-6 border-t-2">
        </div>

        <div class="flex justify-center">
            <button
                id="pay-button"
                class="bg-blue-500 text-white px-8 py-3 rounded-lg text-sm sm:text-base hover:bg-blue-800 duration-700">
                Dapatkan Sekarang
            </button>
        </div>
    </form>

    <!-- Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    
    <script>
        document.getElementById('pay-button').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah submit form

            // Request Snap Token dari server
            fetch('{{ route("processPayment") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    pendaftaran_id: '{{ $pendaftaran->pendaftaran_id }}',
                    harga: {{ $kursus->harga }}
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.snapToken) {
                    // Menampilkan popup Snap Midtrans
                    snap.pay(data.snapToken, {
                        onSuccess: function(result) {
                            console.log('Success:', result);
                            alert('Pembayaran berhasil!');

                            // Update status ke server
                            updatePaymentStatus(result.order_id, 'Berhasil');
                        },
                        onPending: function(result) {
                            console.log('Pending:', result);
                            alert('Menunggu pembayaran.');

                            // Update status ke server
                            updatePaymentStatus(result.order_id, 'Pending');
                        },
                        onError: function(result) {
                            console.error('Error:', result);
                            alert('Pembayaran gagal!');

                            // Update status ke server
                            updatePaymentStatus(result.order_id, 'Gagal');
                        },
                        onClose: function() {
                            alert('Anda menutup popup tanpa menyelesaikan pembayaran.');
                        }
                    });
                } else {
                    alert(data.error || 'Gagal mendapatkan Snap Token.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan.');
            });
        });

        // Fungsi untuk update status ke server
        function updatePaymentStatus(orderId, status) {
            fetch('{{ route("updatePaymentStatus") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    order_id: orderId,
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => console.log('Status updated:', data.message))
            .catch(error => console.error('Error updating status:', error));
        }
    </script>
</div>

@endsection
