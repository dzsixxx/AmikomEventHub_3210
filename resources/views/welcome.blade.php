@extends('layouts.app')

@section('content')
    <!-- Hero Section (Original) -->
    <section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
        <div class="flex-1 space-y-8">
            <span
                class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">#1
                Event Platform</span>
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
                Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
            </h1>
            <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
                Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan
                Midtrans.
            </p>
            <div class="flex gap-4">
                <a href="#events"
                    class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform">
                    Mulai Jelajah
                </a>
                <a href="#"
                    class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
                    Cara Pesan
                </a>
            </div>
        </div>
        
        <div class="flex-1 relative flex justify-center md:justify-end">
            <!-- Membungkus poster dalam container agar ukurannya lebih kecil (max-w-md) -->
            <div class="relative w-4/5 max-w-sm lg:max-w-md mt-10 md:mt-0">
                <div
                    class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
                </div>
                <div
                    class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
                </div>
                
                <img src="{{ asset('assets/concert.png') }}" alt="Concert"
                    class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

                <div class="absolute -bottom-6 -left-4 md:-left-8 bg-white/90 backdrop-blur-md p-4 md:p-6 rounded-2xl shadow-xl z-20 border border-white">
                    <div class="flex items-center gap-3 md:gap-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 shrink-0">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] md:text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                            <p class="text-sm md:text-base font-bold text-slate-800">Pembayaran Aman via Midtrans</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Grid (Modul 6 Dynamic Data) -->
    <main id="events" class="max-w-7xl mx-auto px-6 py-20">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
                <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
            </div>
        </div>

        <!-- Tab Filter Kategori Modul 6 -->
        <div class="flex flex-wrap gap-3 mb-12">
            <!-- Tombol "Semua Kategori" -->
            <a href="{{ url('/#events') }}" 
               class="px-5 py-2 rounded-xl text-sm font-bold transition-all duration-200 
               {{ !request('category') ? 'bg-indigo-600 text-white shadow-md' : 'border border-slate-200 text-slate-600 hover:border-indigo-600 hover:text-indigo-600' }}">
               Semua Kategori
            </a>

            <!-- Looping Kategori dari Database -->
            @foreach($categories as $cat)
            <a href="{{ url('/?category=' . $cat->slug . '#events') }}" 
               class="px-5 py-2 rounded-xl text-sm font-bold transition-all duration-200 
               {{ request('category') == $cat->slug ? 'bg-indigo-100 text-indigo-700 border border-indigo-200 shadow-sm' : 'border border-slate-200 text-slate-600 hover:border-indigo-600 hover:text-indigo-600' }}">
               {{ $cat->name }}
            </a>
            @endforeach
        </div>

        <!-- Grid Daftar Event Dinamis -->
        @if($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col">
                    
                    <div class="relative overflow-hidden aspect-[3/4] bg-slate-100 shrink-0">
                        @php
                            // PERUBAHAN DI SINI: Logika pintar pengecekan URL vs Upload Local
                            $posterUrl = asset('assets/concert.png'); // Default fallback
                            
                            if ($event->poster_path) {
                                // Jika berawalan http (berarti dari seeder Unsplash/Placehold)
                                if (str_starts_with($event->poster_path, 'http')) {
                                    $posterUrl = $event->poster_path;
                                } else {
                                    // Jika tidak berawalan http (berarti file upload dari laptop ke storage)
                                    $posterUrl = asset('storage/' . $event->poster_path);
                                }
                            }
                        @endphp
                        
                        <img src="{{ $posterUrl }}" alt="{{ $event->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">
                            {{ $event->category->name ?? 'Umum' }}
                        </div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition line-clamp-2" title="{{ $event->title }}">
                            {{ $event->title }}
                        </h3>
                        
                        <div class="flex flex-col gap-2 text-slate-500 text-sm mb-6 flex-grow">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="line-clamp-1">{{ $event->location ?? '-' }}</span>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center pt-4 border-t border-slate-100 mt-auto">
                            <span class="text-2xl font-black text-indigo-600">
                                Rp {{ number_format($event->price, 0, ',', '.') }}
                            </span>
                            <a href="{{ route('events.show', $event->id ?? 1) }}"
                                class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- State Jika Event Kosong -->
            <div class="text-center py-20 bg-slate-50 rounded-3xl border border-slate-200 border-dashed max-w-3xl mx-auto">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="text-xl font-bold text-slate-700 mb-2">Event Tidak Ditemukan</h3>
                <p class="text-slate-500 mb-6">Belum ada event yang tersedia untuk kategori ini.</p>
                <a href="{{ url('/') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition">Lihat Semua Event</a>
            </div>
        @endif
    </main>

    <!-- JAWABAN SOAL 4: Render Data Partner ke Layar Publik -->
    <section class="max-w-7xl mx-auto px-6 py-16 mb-10 border-t border-slate-200">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-extrabold text-slate-800 mb-2">Didukung Oleh Mitra Kami</h2>
            <p class="text-slate-500">Platform AmikomEventHub dipercaya oleh berbagai perusahaan hebat.</p>
        </div>
        
        <div class="flex flex-wrap justify-center gap-8 items-center opacity-70 grayscale hover:grayscale-0 transition-all duration-500">
            @foreach($partners as $partner)
                <div class="flex flex-col items-center gap-2 w-24 md:w-32 hover:scale-110 transition-transform">
                    <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-full shadow-md border-2 border-white">
                    <span class="text-xs font-bold text-slate-600 text-center">{{ $partner->name }}</span>
                </div>
            @endforeach
        </div>
    </section>

@endsection