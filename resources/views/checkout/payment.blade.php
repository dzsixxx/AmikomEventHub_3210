@extends('layouts.app')

@section('title', 'Pembayaran - ' . $transaction->event->title)

@section('content')
<main class="max-w-3xl mx-auto px-6 py-20 text-center">
    <div class="bg-white rounded-3xl border border-slate-200 p-12 shadow-sm inline-block w-full max-w-md relative overflow-hidden">
        
        <!-- Ornamen Latar Belakang -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-50 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-blue-50 rounded-full blur-2xl"></div>

        <div class="relative z-10">
            <div class="w-20 h-20 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner ring-4 ring-white">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>

            <h2 class="text-2xl font-black text-slate-800 mb-2">Selesaikan Pembayaran</h2>
            <p class="text-slate-500 mb-8">Mohon selesaikan pembayaran tiket Anda untuk event <strong class="text-slate-700">{{ $transaction->event->title }}</strong>.</p>

            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 mb-8">
                <p class="text-sm text-slate-400 font-bold uppercase tracking-wider mb-1">Total Tagihan</p>
                <h3 class="text-4xl font-extrabold text-indigo-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</h3>
                <p class="text-xs text-slate-400 mt-3 bg-white inline-block px-3 py-1 rounded-lg border border-slate-200">Order ID: <span class="font-mono font-bold text-slate-600">{{ $transaction->order_id }}</span></p>
            </div>

            <button id="pay-button" class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-black text-lg shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:scale-[1.02] active:scale-95 transition-all animate-bounce-in">
                Bayar Sekarang
            </button>
        </div>
    </div>
</main>

<!-- LIBRARY MIDTRANS SNAP -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<!-- SCRIPT PEMICU JENDELA BAYAR -->
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        // SnapToken acquired from previous step
        snap.pay('{{ $transaction->snap_token }}', {
            // Optional
            onSuccess: function(result) {
                window.location.href = "{{ route('checkout.success', $transaction->order_id) }}";
            },
            // Optional
            onPending: function(result) {
                window.location.href = "{{ route('checkout.success', $transaction->order_id) }}";
            },
            // Optional
            onError: function(result) {
                alert("Pembayaran Gagal! Silakan coba lagi.");
            },
            onClose: function() {
                // Do nothing if user closes the popup
            }
        });
    };

    // Auto trigger saat halaman dimuat
    window.onload = function() {
        // Beri delay sedikit agar animasi UI selesai sebelum popup midtrans menutupi layar
        setTimeout(function() {
            document.getElementById('pay-button').click();
        }, 800);
    }
</script>

<style>
    @keyframes bounce-in {
        0% { transform: scale(0.9); opacity: 0; }
        70% { transform: scale(1.05); opacity: 1; }
        100% { transform: scale(1); }
    }
    .animate-bounce-in { animation: bounce-in 0.4s ease-out forwards; }
</style>
@endsection