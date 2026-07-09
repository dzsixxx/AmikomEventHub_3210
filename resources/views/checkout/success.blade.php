@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')
<main class="max-w-3xl mx-auto px-6 py-20 text-center">
    <div class="bg-white rounded-3xl border border-slate-200 p-12 shadow-sm inline-block w-full max-w-md relative overflow-hidden">
        
        <!-- Confetti/Ornamen Background -->
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-green-400 to-emerald-500"></div>

        <div class="w-24 h-24 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 ring-4 ring-green-50 shadow-inner">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h2 class="text-3xl font-black text-slate-800 mb-4">Terima Kasih!</h2>
        
        <p class="text-slate-500 mb-8 leading-relaxed">
            Pembayaran untuk pesanan <strong class="text-slate-700 bg-slate-100 px-2 py-0.5 rounded font-mono">{{ $transaction->order_id }}</strong> sedang diproses atau telah berhasil.
            <br><br>
            E-Ticket akan segera dikirim ke email Anda (<strong class="text-slate-700">{{ $transaction->customer_email }}</strong>) setelah pembayaran terkonfirmasi lunas oleh sistem.
        </p>

        <a href="{{ route('home') }}" class="inline-block w-full px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 hover:scale-[1.02] shadow-lg shadow-indigo-200 transition-all">
            Kembali ke Beranda
        </a>
    </div>
</main>
@endsection