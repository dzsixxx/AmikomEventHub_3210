@extends('layouts.app')

@section('title', 'Checkout - ' . $event->title)

@section('content')
<main class="max-w-3xl mx-auto px-6 py-20">
    <div class="mb-12">
        <a href="{{ route('events.show', $event->id) }}" class="text-indigo-600 font-bold flex items-center gap-2 mb-6 hover:text-indigo-800 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Event
        </a>
        <h1 class="text-4xl font-extrabold text-slate-900">Checkout</h1>
        <p class="text-slate-500 mt-2 text-lg">Lengkapi data Anda untuk mendapatkan tiket.</p>
    </div>

    <!-- Alert Error Jika Tiket Habis -->
    @if(session('error'))
    <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl font-bold border border-red-200">
        {{ session('error') }}
    </div>
    @endif

    <div class="grid grid-cols-1 gap-8">
        <!-- Summary Card (Rincian Pesanan) -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
            <h3 class="text-xl font-bold mb-6 border-b pb-4 text-slate-800">Pesanan Anda</h3>
            <div class="flex flex-col sm:flex-row gap-6 items-start">
                
                @php
                    $posterUrl = 'https://placehold.co/200x200';
                    if ($event->poster_path) {
                        if (str_starts_with($event->poster_path, 'http')) {
                            $posterUrl = $event->poster_path;
                        } else {
                            $posterUrl = asset('storage/' . $event->poster_path);
                        }
                    }
                @endphp
                
                <img src="{{ $posterUrl }}" alt="Event" class="w-24 h-24 rounded-2xl object-cover shadow-md shrink-0">
                
                <div class="w-full">
                    <h4 class="font-extrabold text-lg text-slate-900">{{ $event->title }}</h4>
                    <p class="text-slate-500 mt-1 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                    </p>
                    <p class="text-slate-500 mt-1 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $event->location }}
                    </p>
                    <p class="text-indigo-600 font-black mt-3 text-lg">1 x Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 space-y-3">
                <div class="flex justify-between text-slate-500 font-medium">
                    <span>Harga Tiket</span>
                    <span>Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-slate-500 font-medium">
                    <span>Biaya Layanan Admin</span>
                    <span>Rp 5.000</span>
                </div>
                <div class="flex justify-between text-2xl font-black mt-4 pt-4 border-t border-slate-100 text-slate-900">
                    <span>Total Bayar</span>
                    <span class="text-indigo-600">Rp {{ number_format($event->price + 5000, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Form Card (Data Pemesan) -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
            <h3 class="text-xl font-bold mb-6 italic text-indigo-600 underline underline-offset-8">Data Pemesan (Tanpa Login)</h3>
            
            <form action="{{ route('checkout.store', $event->id) }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Lengkap</label>
                    <input type="text" name="customer_name" placeholder="Masukkan nama sesuai KTP/Identitas"
                           class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium text-slate-900"
                           required value="{{ old('customer_name') }}">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Email Aktif</label>
                        <input type="email" name="customer_email" placeholder="contoh@gmail.com"
                               class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium text-slate-900"
                               required value="{{ old('customer_email') }}">
                        <p class="text-[10px] text-slate-400 mt-2 font-bold uppercase tracking-tighter">
                            *E-Ticket akan dikirim ke email ini
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">No. WhatsApp</label>
                        <input type="tel" name="customer_phone" placeholder="08xxxxxxxxxx"
                               class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium text-slate-900"
                               required value="{{ old('customer_phone') }}">
                    </div>
                </div>

                <button type="submit" class="w-full mt-4 py-5 bg-indigo-600 text-white rounded-2xl font-black text-xl shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:scale-[1.02] active:scale-95 transition-all">
                    Lanjut Pembayaran
                </button>
                <p class="text-center text-xs text-slate-400 font-medium">Dengan menekan tombol di atas, Anda menyetujui Syarat & Ketentuan kami.</p>
            </form>
        </div>
    </div>
</main>
@endsection